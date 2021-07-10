<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Plan_Consent;
use App\Role;
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'owner_full_name'=>'required',
            'city'=>'required',
            'phone_number'=>'required',
            'mobile_number'=>'required',
            'sub_city'=>'required',
            'new_woreda'=>'required',
            'street_address'=>'required',
            'house_number'=>'required',
            'ownership_authentication_number'=>'required',
            'ownership_authentication_type'=>'required',
            'ownership_authentication_issued_date'=>'required',
            'name_stated_on_ownership_authentication'=>'required',
            'previous_service'=>'required',
            'type_of_construction'=>'required',
            'ground_floor_number'=>'required',
        ]);
        $id = auth()->user()->id;
        // $nof = $request['ground_floor_number'];
        
        // $number_of_floors = (int)$nof;
        // if($number_of_floors>=7){
        //     $bureau_for_application = $request['city'];
        //     $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
        //         ->where('name', '=', 'BO')->min('active_applications');
        //     $user_id = Role::where('active_applications', '=', $Building_officer_selector)->where('name', '=', 'BO')->first();
        //         // return $user_id;
        //     $uid = $user_id->user_id;
            $plan_Consent=Plan_Consent::create([
                'applicant_id' => $id,
                'city'=>$request['city'],
                'sub_city'=>$request['sub_city'],
                'new_woreda'=>$request['new_woreda'],
                'street_address'=>$request['street_address'],
                'house_number'=>$request['house_number'],
                'ownership_authentication_number'=>$request['ownership_authentication_number'],
                'ownership_authentication_type'=>$request['ownership_authentication_type'],
                'ownership_authentication_issued_date'=>$request['ownership_authentication_issued_date'],
                'name_stated_on_ownership_authentication'=>$request['name_stated_on_ownership_authentication'],
                'previous_service'=>$request['previous_service'],
                'type_of_construction'=>$request['type_of_construction'],
                'application_id'=>$request['application_id'],
                'application_issued_date'=>$request['application_issued_date'],
                'ground_floor_number'=>$request['ground_floor_number'],
                'owner_full_name'=>$request['owner_full_name'],
                'reperesentative_full_name'=>$request['reperesentative_full_name'],
                'phone_number'=>$request['phone_number'],
                'mobile_number'=>$request['mobile_number'],
                'TIN_number'=>$request['TIN_number'],


            ]);
            return $plan_Consent;
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
