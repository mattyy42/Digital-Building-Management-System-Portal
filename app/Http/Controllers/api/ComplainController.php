<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\complain;
use App\Application;
use App\ConsultingFirm;
use App\constructionLocation;
use App\constructionType;

use App\Http\Resources\ComplainResource;
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
        $complains=Complain::all();
        return response()->json([
            'complains'=>$complains
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
    public function store(Request $request,$id)
    {
        //when the person views his application in tabular form 
        //complain should be button  where there route passes
        //$id is application id 
        $request->validate([
            'complain'=>'required',
        ]);
        $applicant_id=Application::where('id',$id)->pluck('applicant_id')->first();
        $buildingOfficer_id=Application::where('id',$id)->pluck('buildingOfficer_id')->first();
        $complain_check=Complain::where('application_id','=',$id)->first();
        //return $applicant_id;
        if ($complain_check ===null) {
            # code...
            $complain=Complain::create([
                'applicant_id'=>$applicant_id,
                'application_id'=>$id,
                'buildingOfficer_id'=>$buildingOfficer_id,
                'complain'=>$request['complain'],
                'status'=>$request['status'],
            ]);
        }
        else {
            return response()->json([ 
                'complain' => 'Complain already Submitted'
            ]);
        }
        
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
        //
        $complains =Complain::where('id','=',$id)->get();
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
        $complains =Complain::where('id','=',$id)->get();
        $applicationid=$complains->pluck('application_id');
        $application=Application::where('id',$applicationid)->get();
        $ConsultingFirm=ConsultingFirm::where('application_id',$applicationid)->get();
        $constructionType=constructionType::where('application_id',$applicationid)->get();
        $constructionLocation=constructionLocation::where('application_id',$applicationid)->get();
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
}
