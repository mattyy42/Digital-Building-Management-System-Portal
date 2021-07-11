<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanConsentResource;
use App\Plan_Consent;
use App\Plan_Consent_BO;
use Illuminate\Http\Request;
use App\Http\Resources\PlanConsentBOResource;


class PlanConsentBOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = auth()->user()->id;
        $select_assigned_pc=Plan_Consent::where('buildingOfficer_id',$id)->get();
        return new PlanConsentBOResource($select_assigned_pc);
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'block_number'=>'required',
            'x_parcel_number'=>'required',
            'y_parcel_number'=>'required',
            'cadaster_number'=>'required',
            'area_category'=>'required',
            'building_height'=>'required',
            'floor_area_ratio'=>'required',
            'level'=>'required',
            'land_area'=>'required',
            'verified_land_area'=>'required',
            'air_space'=>'required',
            'Other'=>'required',
            'infrastacture_build_on_the_land'=>'required',
            'bureau'=>'required',
        ]);
        $id = auth()->user()->id;
        $select_assigned_pc=Plan_Consent::where('buildingOfficer_id',$id)->get();

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan_Consent_BO  $plan_Consent_BO
     * @return \Illuminate\Http\Response
     */
    public function show(Plan_Consent_BO $plan_Consent_BO)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan_Consent_BO  $plan_Consent_BO
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan_Consent_BO $plan_Consent_BO)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan_Consent_BO  $plan_Consent_BO
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan_Consent_BO $plan_Consent_BO)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan_Consent_BO  $plan_Consent_BO
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan_Consent_BO $plan_Consent_BO)
    {
        //
    }
}
