<?php

namespace App\Http\Controllers;

use App\ConstructionLocation;

use App\Application;
use App\ConstructionType;
use App\ConsultingFirm;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function storeApplication(Request $request,$id){
        $request->validate([
            'city' => 'required|max:255',
            'sub_city' => 'required',
            'special_name' => 'required',
            'wereda'=>'required',
            'house_number'=>'required',
            'constructionType'=>'required',
            'constructionCondition'=>'required',
            'estimatedCost'=>'required',
            'floorNumber'=>'required',
            'groundFloorNumber'=>'required',
            'buildingHeight'=>'required',
            'groundBuildingHeight'=>'required',
            'consultingFirmName'=>'required',
            'consultingFirmLevel'=>'required',
            'consultingFirmPhone'=>'required',
            'consultingFirmAddress'=>'required',
        ]);
        $application=Application::create([
            'applicant_id'=>$id
        ]);
        $constructionLocation=ConstructionLocation::create([
            'city'=>$request['city'],
            'sub_city'=>$request['sub_city'],
            'wereda/kebele'=>$request['wereda'],
            'special_name'=>$request['special_name'],
            'house_number'=>$request['house_number'],
            'application_id'=>$application->id,
        ]);
        $constructionType=ConstructionType::create([
            'construction_condition'=>$request['constructionCondition'],
            'construction_type'=>$request['constructionType'],
            'estimated_cost'=>$request['estimatedCost'],
            'number_of_floor'=>$request['floorNumber'],
            'ground_floor_number'=>$request['groundFloorNumber'],
            'building_height'=>$request['buildingHeight'],
            'ground_building_height'=>$request['groundBuildingHeight'],
            'application_id'=>$application->id,
        ]);
        $consultingFirm=ConsultingFirm::create([
            'name'=>$request['consultingFirmName'],
            'phone_number'=>$request['consultingFirmPhone'],
            'level'=>$request['consultingFirmLevel'],
            'address'=>$request['consultingFirmAddress'],
            'application_id'=>$application->id,
        ]);
        session()->flash('message', 'The Application Form is successfully applied');
        return redirect('/applicant/viewApplication/.$id');
    }
    public function viewApplication($id){
        $applications =Application::where('applicant_id',$id)->get();
        return view('applicantPages.viewApplication',compact('applications'));
    }
    public function deleteApplication($id){
        $applications=Application::findOrFail($id)->delete();
        return redirect('/applicant/viewApplication/.auth()->user()->id');
    }
}
