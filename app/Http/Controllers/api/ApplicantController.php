<?php

namespace App\Http\Controllers\api;


use App\ConstructionLocation;
use App\bureau;
use App\User;
use App\Role;
use Laravel\Passport;
use Illuminate\Support\Facades\Validator;
use App\Application;
use App\ConstructionType;
use App\ConsultingFirm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;

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
        if ($number_of_floors >= 7) {
            $bureau_for_application = $request['city'];
            //selecting building officers from the chosen buraue
            $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
                ->where('name', '=', 'BO')->min('active_applications');
            $buildingOfficer = $Building_officer_selector->user_id;
            $application = Application::create([
                'applicant_id' => $id,
                'bureau' => $bureau_for_application,
                'buildingOfficer_id' => $buildingOfficer,
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
            // $changed = $Building_officer_selector->map(function ($value, $key) {
            //     //$ap=1000;               
            //     //echo $value;

            //     $ap[]=$value['active_applications'];
            //     $minValue = $ap[0];
            //     foreach($ap as $key => $val){
            //         if($minValue > $val){
            //             $minValue = $val;
            //         }
            //     } 
            //     return $ap ;


            // });

            //  return $changed->all();



            //$rr=$Building_officer_selector->user_id;
            return $Building_officer_selector;
            // return $rr;


            //return new ApplicationResource($application);
        } else {
            $application = Application::create([
                'applicant_id' => $id,
                'bureau' => $request['sub_city'],
            ]);
            $constructionLocation = ConstructionLocation::create([
                'city' => $request['city'],
                'sub_city' => $request['sub_city'],
                'wereda/kebele' => $request['wereda'],
                'special_name' => $request['special_name'],
                'house_number' => $request['house_number'],
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
            $consultingFirm = ConsultingFirm::create([
                'name' => $request['consultingFirmName'],
                'phone_number' => $request['consultingFirmPhone'],
                'level' => $request['consultingFirmLevel'],
                'address' => $request['consultingFirmAddress'],
                'application_id' => $application->id,
            ]);

            //selecting building officers from the chosen buraue

            return new ApplicationResource($application);
        }


        //  return redirect('/applicant/viewApplication/.$id');
    }
    public function viewApplication($id)
    {
        $applications = Application::where('applicant_id', $id)->get();
        // $consultingFirm=ConsultingFirm::where('application_id',$id)->get();
        return response()->json([
            'applications' => $applications
        ]);
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
}
