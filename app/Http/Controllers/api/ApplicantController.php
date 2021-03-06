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
use App\Mail\ApplicationAccept;
use App\Mail\ApplicationReject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    public function storeApplication(Request $request)
    {
        
        $path = "";
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
            'revitFile' => 'required',
        ]);
        $id = auth()->user()->id;

        //one part of the scheduler to send it the appropurate office 
        $nof = $request['floorNumber'];
        $number_of_floors = (int)$nof;
        if ($number_of_floors >= 7) {
            $bureau_for_application = $request['city'];
            //selecting building officers from the chosen buraue
            $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
                ->where('name', '=', 'BO')->min('active_applications');
            $user_id = Role::where('active_applications', '=', $Building_officer_selector)->where('name', '=', 'BO')->first();
            // return $user_id;
            $uid = $user_id->user_id;
            if ($request->file("revitFile")) {
              
                $filenameWithExt = $request->file("revitFile")->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file("revitFile")->getClientOriginalExtension();
                $fileNameToStore = $filename . "_" . time() . "." . $extension;
                $path = $request->file("revitFile")->storeAs("public/revit", $fileNameToStore);
            };
            $application = Application::create([
                'applicant_id' => $id,
                'bureau' => $bureau_for_application,
                'buildingOfficer_id' => $uid,
                'revit_file' => $path,
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
            $updater = Role::where('user_id', '=', $uid)->first();
            $updater->active_applications = $updater->active_applications + 1;
            $updater->save();
            $updater = Role::where('user_id', '=', $id)->first();
            $updater->active_applications = $updater->active_applications + 1;
            $updater->save();


            return new ApplicationResource($application);
        } else {
            $bureau_for_application = $request['sub_city'];

            //selecting building officers from the chosen buraue
            $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
                ->where('name', '=', 'BO')->min('active_applications');
            $user_id = Role::where('active_applications', '=', $Building_officer_selector)->where('name', '=', 'BO')->first();

            $uid = $user_id->user_id;
            if ($request->file("revitFile")) {
                $filenameWithExt = $request->file("revitFile")->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file("revitFile")->getClientOriginalExtension();
                $fileNameToStore = $filename . "_" . time() . "." . $extension;
                $path = $request->file("revitFile")->storeAs("public/revit", $fileNameToStore);
            };
            $application = Application::create([
                'applicant_id' => $id,
                'bureau' => $bureau_for_application,
                'buildingOfficer_id' => $uid,
                'revit_file' => $path,
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

            $last_appointment_of_the_day = appointment::select('appointment_time')->max('appointment_time');
            $last_working_time = date("H:i:s", strtotime($last_appointment_of_the_day));
            if ($last_working_time >= '17:00:00') {
                $last_appointment_of_the_day = Carbon::parse($last_appointment_of_the_day);
                $last_appointment_of_the_day->addHours(15);
                $appointment = appointment::create([
                    'application_id' => $application->id,
                    'appointment_time' => $last_appointment_of_the_day,
                ]);
            } else {
                $last_appointment_of_the_day = Carbon::parse($last_appointment_of_the_day);
                $last_appointment_of_the_day->addMinutes(30);
                $appointment = appointment::create([
                    'application_id' => $application->id,
                    'appointment_time' => $last_appointment_of_the_day,
                ]);
            }
            //end
            $updater = Role::where('user_id', '=', $uid)->first();
            $updater->active_applications = $updater->active_applications + 1;
            $updater->save();
            $updater = Role::where('user_id', '=', $id)->first();
            $updater->active_applications = $updater->active_applications + 1;
            $updater->save();

            return new ApplicationResource($application);
        }
    }



    public function viewApplication()
    {
        $id = auth()->user()->id;
        $applications = Application::where('applicant_id', $id)->get();

        return ApplicationResource::collection($applications);
    }
    public function viewMyApplication()
    {
        $id = auth()->user()->id;
        //bo's viewing application assigned to them
        $my_applications = Application::where('buildingOfficer_id', $id)->get();

        //$applicants_id =$my_applications->applicant_id;

        return ApplicationResource::collection($my_applications);

        //on the forntend it will be viewed as table 
        //with details button option it where the value pass applicant_id
        //new Route and functions will be defined for details


    }
    public function acceptApplication($id)
    {
        $uid = auth()->user()->id;
        $application = Application::findOrFail($id);
        if ($application->application_stutus == 0) {
            $application->application_stutus = 1;
        }
        if ($application->application_stutus == 2) {
            $application->application_stutus = 1;
        }
        $application->save();
        $user=$application->applicant;
        Mail::to($application->applicant->email)->send(new ApplicationAccept($user));
        $planConsents = Application::where('buildingOfficer_id', $uid)->get();
        return ApplicationResource::collection($planConsents);
    }
    public function rejectApplication($id)
    {
        $uid = auth()->user()->id;
        $application = Application::findOrFail($id);
        if ($application->application_stutus == 1) {
            $application->application_stutus = 2;
        }
        if ($application->application_stutus == 0) {
            $application->application_stutus = 2;
        }
        $application->save();
        $user=$application->applicant;
        Mail::to($application->applicant->email)->send(new ApplicationReject($user));
        $planConsents = Application::where('buildingOfficer_id', $uid)->get();
        return ApplicationResource::collection($planConsents);
    }
    public function commentApplication(Request $request,$id){
        $application=Application::findOrFail($id);
        $application->comment_BO=$request['comment'];
        $application->save();
        return response()->json([
            'success'=>'comment is added successfully',
        ]);
    }
    public function deleteApplication()
    {
        $id = auth()->user()->id;
        //it is deleting the application 
        $applications = Application::findOrFail($id)->delete();
        // return redirect('/applicant/viewApplication/'.auth()->user()->id);
        $deleted = 'your application id ' . $id . 'successfully deleted ';
        return response()->json([
            'Success' => $deleted,
            'applications' => $applications

        ]);
    }
    public function updateApplication($applicationId)
    {
        $this->validate(request(), [
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
        $id = auth()->user()->id;
        $application = Application::findOrFail($applicationId);
        if (request('floorNumber') >= 7) {
            $application->bureau = request('city');
        } else {
            $application->bureau = request('sub_city');
        }

        $application->location->city = request('city');
        $application->location->sub_city = request('sub_city');
        $application->location->special_name = request('special_name');
        $application->location->house_number = request('house_number');
        $application->constructionType->construction_condition = request('construction_condition');
        $application->constructionType->construction_type = request('construction_type');
        $application->constructionType->estimated_cost = request('estimated_cost');
        $application->constructionType->number_of_floor = request('number_of_floor');
        $application->constructionType->ground_floor_number = request('ground_floor_number');
        $application->constructionType->building_height = request('building_height');
        $application->constructionType->ground_building_height = request('ground_building_height');

        $application->consultingFirm->name = request('consultingFirmName');
        $application->consultingFirm->phone_number = request('consultingFirmPhone');
        $application->consultingFirm->level = request('consultingFirmLevel');
        $application->consultingFirm->address = request('consultingFirmAddress');
        $application->save();
        return response()->json([
            'Success' => 'application successfully updated'
        ]);
    }
}
