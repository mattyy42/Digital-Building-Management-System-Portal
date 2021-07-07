<?php

namespace App\Http\Controllers\api;


use App\ConstructionLocation;
use App\bureau;
use App\User;
use App\Role;
use App\complain;
use Laravel\Passport;
use Illuminate\Support\Facades\Validator;
use App\Application;
use App\appointment;
use App\ConstructionType;
use App\ConsultingFirm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\ComplainResource;
use Carbon\Carbon;

class ApplicantController extends Controller
{
    public function storeApplication(Request $request, $id)
    {
        $request->validate([
            'city' => 'required|max:255',
            'sub_city' => 'required',
            'special_name' => 'required',
            'wereda' => 'required',
            'house_number' => 'required',
            'constructionType' => 'required',
            'constructionCondition' => 'required',
            'estimatedCost' => 'required',
            'floorNumber' => 'required',
            'groundFloorNumber' => 'required',
            'buildingHeight' => 'required',
            'groundBuildingHeight' => 'required',
            'consultingFirmName' => 'required',
            'consultingFirmLevel' => 'required',
            'consultingFirmPhone' => 'required',
            'consultingFirmAddress' => 'required',
        ]);


        //one part of the scheduler to send it the appropurate office 
        $nof = $request['floorNumber'];
        $number_of_floors = (int)$nof;
        if ($number_of_floors >= 7)
         {
            $bureau_for_application = $request['city'];
            //selecting building officers from the chosen buraue
            $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
                ->where('name', '=', 'BO')->min('active_applications');
            $user_id = Role::where('active_applications', '=', $Building_officer_selector)->where('name', '=', 'BO')->first();
            // return $user_id;
            $uid = $user_id->user_id;
           
            //$buildingOfficer = $Building_officer_selector->user_id;
            $application = Application::create([
                'applicant_id' => $id,
                'bureau' => $bureau_for_application,
                'buildingOfficer_id' => $uid,
            ]);
            $consultingFirm = ConsultingFirm::create([
                'name' => $request['consultingFirmName'],
                'phone_number' => $request['consultingFirmPhone'],
                'level' => $request['consultingFirmLevel'],
                'address' => $request['consultingFirmAddress'],
                'application_id' => $application->id,
            ]);
            $constructionType = ConstructionType::create([
                'construction_condition' => $request['constructionCondition'],
                'construction_type' => $request['constructionType'],
                'estimated_cost' => $request['estimatedCost'],
                'number_of_floor' => $request['floorNumber'],
                'ground_floor_number' => $request['groundFloorNumber'],
                'building_height' => $request['buildingHeight'],
                'ground_building_height' => $request['groundBuildingHeight'],
                'application_id' => $application->id,
            ]);
            $constructionLocation = ConstructionLocation::create([
                'city' => $request['city'],
                'sub_city' => $request['sub_city'],
                'wereda/kebele' => $request['wereda'],
                'special_name' => $request['special_name'],
                'house_number' => $request['house_number'],
                'application_id' => $application->id,
            ]);
             //Adds Active Application to the Applicant
             $updater=Role::where('user_id','=',$uid)->first();
             $updater->active_applications=$updater->active_applications+1;
             $updater->save();
             $updater=Role::where('user_id','=',$id)->first();
             $updater->active_applications=$updater->active_applications+1;
             $updater->save();


            return new ApplicationResource($application);
        }
         else {
            $bureau_for_application = $request['sub_city'];
            
            //selecting building officers from the chosen buraue
            $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
                ->where('name', '=', 'BO')->min('active_applications');
            $user_id = Role::where('active_applications', '=', $Building_officer_selector)->where('name', '=', 'BO')->first();
        
            $uid=$user_id->user_id;
           // return $bureau_for_application;
            //$buildingOfficer = $Building_officer_selector->user_id;
            $application = Application::create([
                'applicant_id' => $id,
                'bureau' => $bureau_for_application,
                'buildingOfficer_id' => $uid,
            ]);
            $consultingFirm = ConsultingFirm::create([
                'name' => $request['consultingFirmName'],
                'phone_number' => $request['consultingFirmPhone'],
                'level' => $request['consultingFirmLevel'],
                'address' => $request['consultingFirmAddress'],
                'application_id' => $application->id,
            ]);
            $constructionType = ConstructionType::create([
                'construction_condition' => $request['constructionCondition'],
                'construction_type' => $request['constructionType'],
                'estimated_cost' => $request['estimatedCost'],
                'number_of_floor' => $request['floorNumber'],
                'ground_floor_number' => $request['groundFloorNumber'],
                'building_height' => $request['buildingHeight'],
                'ground_building_height' => $request['groundBuildingHeight'],
                'application_id' => $application->id,
            ]);
            $constructionLocation = ConstructionLocation::create([
                'city' => $request['city'],
                'sub_city' => $request['sub_city'],
                'wereda/kebele' => $request['wereda'],
                'special_name' => $request['special_name'],
                'house_number' => $request['house_number'],
                'application_id' => $application->id,
            ]);
             // Time Scheduller

             $last_appointment_of_the_day=appointment::select('appointment_time')->max('appointment_time');
             $last_working_time= date("H:i:s",strtotime($last_appointment_of_the_day));
             if($last_working_time>= '17:00:00')
             {
                 $last_appointment_of_the_day=Carbon::parse($last_appointment_of_the_day);
                 $last_appointment_of_the_day->addHours(15);
                 $appointment=appointment::create([
                    'application_id' => $application->id,
                    'appointment_time'=>$last_appointment_of_the_day,
                 ]);
                }
             else
             {
                 $last_appointment_of_the_day=Carbon::parse($last_appointment_of_the_day);
                 $last_appointment_of_the_day->addMinutes(30);
                 $appointment=appointment::create([
                    'application_id' => $application->id,
                    'appointment_time'=>$last_appointment_of_the_day,
                 ]);
             }
             //end
             $updater=Role::where('user_id','=',$uid)->first();
             $updater->active_applications=$updater->active_applications+1;
             $updater->save();
             $updater=Role::where('user_id','=',$id)->first();
             $updater->active_applications=$updater->active_applications+1;
             $updater->save();
  
            return new ApplicationResource($application);
        }
    }
    public function viewApplication($id)
    {
        $applications = Application::where('applicant_id', $id)->get();

        return ApplicationResource::collection($applications);
      
    }
    public function viewMyApplication($id)
    {
        
        //bo's viewing application assigned to them
        $my_applications=Application::where('buildingOfficer_id',$id)->get(); 
        
        //$applicants_id =$my_applications->applicant_id;

        return ApplicationResource::collection($my_applications);

        //on the forntend it will be viewed as table 
        //with details button option it where the value pass applicant_id
        //new Route and functions will be defined for details
        

    }
    public function deleteApplication($id)
    {
        //it is deleting the application 
        $applications = Application::findOrFail($id)->delete();
        // return redirect('/applicant/viewApplication/'.auth()->user()->id);
        $deleted = 'your application id' . $id . 'successfully deleted ';
        return response()->json([
            'Success' => $deleted,
            'applications' => $applications

        ])->redirect('/applicant/viewApplication/' . auth()->user()->id);
    }
    public function deleteComplain($id)
    {
        //it is deleting the application 
        $complains = Complain::where('applicant_id',$id)->where('status','0')->delete();
        // return redirect('/applicant/viewApplication/'.auth()->user()->id);
        $deleted = 'your application id' . $id . 'successfully deleted ';
        return response()->json([
            'Success' => $deleted,
            'applications' => $complains

        ]);
    }
    public function ViewMyComplain($id)
    {
        //
        $complains =Complain::where('id','=',$id)->get();
        return ComplainResource::collection($complains);
    }
  
}
