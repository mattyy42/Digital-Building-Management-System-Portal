<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Plan_Consent;
use Illuminate\Http\Request;

class PlanConsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $request->validate([
            'owner_full_name','required',
            'reperesentative_full_name','required',
            'phone_number','required',
            'mobile_number','required',
            'TIN_number','required',
            'sub_city','required',
            'new_woreda','required',
            'street_address','required',
            'house_number','required',
            'ownership_authentication_number','required',
            'ownership_authentication_type','required',
            'ownership_authentication_issued_date','required',
            'name_stated_on_ownership_authentication','required',
            'previous_service','required',
            'type_of_construction','required',
            'method_of_construction','required',
            'application_id','required',
            'application_issued_date','required',
            'ground_floor_number','required',
        ]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan_Consent  $plan_Consent
     * @return \Illuminate\Http\Response
     */
    public function show(Plan_Consent $plan_Consent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan_Consent  $plan_Consent
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan_Consent $plan_Consent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan_Consent  $plan_Consent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan_Consent $plan_Consent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan_Consent  $plan_Consent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan_Consent $plan_Consent)
    {
        //
    }
    public function applicantViewPlanConsent(){
        $id=auth()->user()->id;
        
    }
}
