<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\complain;
use App\Application;
use App\ConsultingFirm;
use App\constructionLocation;
use App\constructionType;

use App\Http\Resources\ComplainResource;
use App\Role;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $complains = Complain::all();
        return response()->json([
            'complains' => $complains
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //when the person views his application in tabular form 
        //complain should be button  where there route passes
        //$id is application id 
        $request->validate([
            'complain' => 'required',
        ]);
        $applicant_id = Application::where('id', $id)->pluck('applicant_id')->first();
        //$buildingOfficer_id=Application::where('id',$id)->pluck('buildingOfficer_id')->first();
        $complain_check = Complain::where('application_id', '=', $id)->first();
        if ($complain_check === null) {
            $bureau_type = Application::where('id', $id)->pluck('bureau')->first();
            $board_of_appliance_id = Role::where('bureau', $bureau_type)->where('name', '=', 'BA')->pluck('user_id')->first();

            $complain = Complain::create([
                'applicant_id' => $applicant_id,
                'application_id' => $id,
                'BOA_id' => $board_of_appliance_id,
                'complain' => $request['complain'],

            ]);
        } else {
            return response()->json([

                'complain' => 'Complain already Submitted'
            ]);
        }
        //Add Active application
        $updater = Role::where('user_id', '=', $applicant_id)->first();
        $updater->active_applications = $updater->active_applications + 1;
        $updater->save();
        $updater = Role::where('user_id', '=', $board_of_appliance_id)->first();
        $updater->active_applications = $updater->active_applications + 1;
        $updater->save();
        return new ComplainResource($complain);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $complains = Complain::where('id', '=', $id)->get();
        return response()->json([
            'complains' => $complains,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $complains = Complain::where('id', '=', $id)->get();
        $applicationid = $complains->pluck('application_id');
        $application = Application::where('id', $applicationid)->get();
        $ConsultingFirm = ConsultingFirm::where('application_id', $applicationid)->get();
        $constructionType = constructionType::where('application_id', $applicationid)->get();
        $constructionLocation = constructionLocation::where('application_id', $applicationid)->get();
        //here it should display all the nessary informations above on one page with non editable input
        //add editable Comments text in put to reason
        // then accept and reject button which modifes the status of complain 0 is pendig 1 is accepted and 2 is rejected

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, complain $complain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function destroy(complain $complain)
    {
        //
    }
    public function DecidedMyComplain(Request $request, $id)
    {
        //
        $complains = Complain::where('id', '=', $id)->where('status', '0')->get();
        $request->validate([
            'BOAcomment' => 'required',
        ]);

        // $BOAcomment=request['BOAcomment'];
        return ComplainResource::collection($complains);
        // Front end concept 
    }
    public function deleteComplain()
    {
        $id = auth()->user()->id;
        //it is deleting the application 
        $complains = Complain::where('applicant_id', $id)->where('status', '0')->delete();
        // return redirect('/applicant/viewApplication/'.auth()->user()->id);
        $deleted = 'your application id' . $id . 'successfully deleted ';
        return response()->json([
            'Success' => $deleted,
            'applications' => $complains

        ]);
    }
    public function showComplain()
    {
        $id = auth()->user()->id;
        $complains = Complain::where('applicant_id', '=', $id)->get();
        return ComplainResource::collection($complains);
    }
    public function complainDelete($complain_id)
    {
        $id = auth()->user()->id;
        $complain = Complain::where('id', '=', $complain_id)->get()->first();
        if ($id == $complain->applicant_id) {
            $complain->delete();
            return response()->json([
                'success' => "successfully deleted"
            ]);
        }
        return response()->json([
            'success' => "successfully deleted"
        ]);
    }
    public function ViewMyComplain()
    {
        //
        $id = auth()->user()->id;
        $complains = Complain::where('applicant_id', '=', $id)->get();
        return ComplainResource::collection($complains);
    }
    public function BoaViewComplain()
    {
        $id = auth()->user()->id;
        $complains = Complain::where('BOA_id', '=', $id)->get();
        return ComplainResource::collection($complains);
    }
    public function acceptComplain($id)
    {
        $uid = auth()->user()->id;
        $complain = Complain::findOrFail($id);
        if ($complain->status == 0) {
            $complain->status = 1;
        }
        if ($complain->status == 2) {
            $complain->status = 1;
        }
        $complain->save();
        $user=$complain->applicant;
        // Mail::to($complain->applicant->email)->send(new ComplainAccept($user));
        $complain = Complain::where('BOA_id', $uid)->get();
        return ComplainResource::collection($complain);
    }
    public function rejectComplain($id)
    {
        $uid = auth()->user()->id;
        $complain = Complain::findOrFail($id);
        if ($complain->status == 1) {
            $complain->status = 2;
        }
        if ($complain->status == 0) {
            $complain->status = 2;
        }
        $complain->save();
        // $user=$complain->applicant;
        // Mail::to($complain->applicant->email)->send(new ComplainReject($user));
        $complain = Complain::where('BOA_id', $uid)->get();
        return ComplainResource::collection($complain);
    }
    public function commentComplain(Request $request,$id){
        $complain=Complain::findOrFail($id);
        $complain->BoAcomment=$request['comment'];
        $complain->save();
        return response()->json([
            'success'=>'comment is added successfully',
        ]);
    }
}
