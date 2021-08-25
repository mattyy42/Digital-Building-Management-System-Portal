<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanConsentRequest;
use App\Plan_Consent;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\PlanConsentResource;
use App\Mail\PlaningConsentAccept;
use App\Mail\PlaningConsentReject;
use Illuminate\Support\Facades\Mail;

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
    public function store(PlanConsentRequest $request)
    {
        //

        $id = auth()->user()->id;
        $nof = $request['ground_floor_number'];
        $number_of_floors = (int)$nof;
        if ($number_of_floors >= 7) {
            $bureau_for_application = $request['city'];
            $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
                ->where('name', '=', 'BO')->min('planing_consent');
            $user_id = Role::where('planing_consent', '=', $Building_officer_selector)->where('name', '=', 'BO')->first();
            $uid = $user_id->user_id;
            $plan_Consent = Plan_Consent::create([
                'applicant_id' => $id,
                'city' => $request['city'],
                'sub_city' => $request['sub_city'],
                'new_woreda' => $request['new_woreda'],
                'street_address' => $request['street_address'],
                'house_number' => $request['house_number'],
                'ownership_authentication_number' => $request['ownership_authentication_number'],
                'ownership_authentication_type' => $request['ownership_authentication_type'],
                'ownership_authentication_issued_date' => $request['ownership_authentication_issued_date'],
                'name_stated_on_ownership_authentication' => $request['name_stated_on_ownership_authentication'],
                'previous_service' => $request['previous_service'],
                'type_of_construction' => $request['type_of_construction'],
                'ground_floor_number' => $request['ground_floor_number'],
                'owner_full_name' => $request['owner_full_name'],
                'reperesentative_full_name' => $request['reperesentative_full_name'],
                'phone_number' => $request['phone_number'],
                'mobile_number' => $request['mobile_number'],
                'TIN_number' => $request['TIN_number'],
                'buildingOfficer_id' => $uid,
            ]);

            $updater = Role::where('user_id', '=', $uid)->first();
            $updater->planing_consent = $updater->planing_consent + 1;
            $updater->save();
            $updater = Role::where('user_id', '=', $id)->first();
            $updater->planing_consent = $updater->planing_consent + 1;
            $updater->save();
            return new PlanConsentResource($plan_Consent);
        } else {
            $bureau_for_application = $request['sub_city'];
            $Building_officer_selector = Role::where('bureau', '=', $bureau_for_application)
                ->where('name', '=', 'BO')->min('planing_consent');
            // return $bureau_for_application;
            $user_id = Role::where('planing_consent', '=', $Building_officer_selector)->where('name', '=', 'BO')->first();
            // return $user_id;
            $uid = $user_id->user_id;
            $plan_Consent = Plan_Consent::create([
                'applicant_id' => $id,
                'city' => $request['city'],
                'sub_city' => $request['sub_city'],
                'new_woreda' => $request['new_woreda'],
                'street_address' => $request['street_address'],
                'house_number' => $request['house_number'],
                'ownership_authentication_number' => $request['ownership_authentication_number'],
                'ownership_authentication_type' => $request['ownership_authentication_type'],
                'ownership_authentication_issued_date' => $request['ownership_authentication_issued_date'],
                'name_stated_on_ownership_authentication' => $request['name_stated_on_ownership_authentication'],
                'previous_service' => $request['previous_service'],
                'type_of_construction' => $request['type_of_construction'],
                'application_id' => $request['application_id'],
                'application_issued_date' => $request['application_issued_date'],
                'ground_floor_number' => $request['ground_floor_number'],
                'owner_full_name' => $request['owner_full_name'],
                'reperesentative_full_name' => $request['reperesentative_full_name'],
                'phone_number' => $request['phone_number'],
                'mobile_number' => $request['mobile_number'],
                'TIN_number' => $request['TIN_number'],
                'bureau' => $bureau_for_application,
                'buildingOfficer_id' => $uid,
            ]);
            $updater = Role::where('user_id', '=', $uid)->first();
            $updater->planing_consent = $updater->planing_consent + 1;
            $updater->save();
            $updater = Role::where('user_id', '=', $id)->first();
            $updater->planing_consent = $updater->planing_consent + 1;
            $updater->save();
            return new PlanConsentResource($plan_Consent);
        }
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
    public function applicantViewPlanConsent()
    {
        $id = auth()->user()->id;
        $planConsent = Plan_Consent::where('applicant_id', $id)->get();
        return PlanConsentResource::collection($planConsent);
    }
    public function bOViewPlanConsent()
    {
        $id = auth()->user()->id;
        $planConsent = Plan_Consent::where('buildingOfficer_id', $id)->get();
        return PlanConsentResource::collection($planConsent);
    }
    public function acceptPlanConsent($id)
    {
        $uid = auth()->user()->id;
        $planConsent = Plan_Consent::findOrFail($id);
        if ($planConsent->status == 0) {
            $planConsent->status = 1;
        }
        if ($planConsent->status == 2) {
            $planConsent->status = 1;
        }
        $planConsent->save();
        $user=$planConsent->applicant;
        Mail::to($planConsent->applicant->email)->send(new PlaningConsentAccept($user));
        $planConsents = Plan_Consent::where('buildingOfficer_id', $uid)->get();
        return PlanConsentResource::collection($planConsents);
    }
    public function rejectPlanConsent($id)
    {
        $uid = auth()->user()->id;
        $planConsent = Plan_Consent::findOrFail($id);
        if ($planConsent->status == 1) {
            $planConsent->status = 2;
        }
        if ($planConsent->status == 0) {
            $planConsent->status = 2;
        }
        $planConsent->save();
        $user=$planConsent->applicant;
        Mail::to($planConsent->applicant->email)->send(new PlaningConsentReject($user));
        $planConsents = Plan_Consent::where('buildingOfficer_id', $uid)->get();
        return PlanConsentResource::collection($planConsents);
    }
    public function commentAdd(Request $request,$id){
        $planingConsent=Plan_Consent::findOrFail($id);
        $planingConsent->comment_BO=$request['comment'];
        $planingConsent->save();
        return response()->json([
            'success'=>'comment is added successfully',
        ]);
    }
    public function updatePlanConsent(PlanConsentRequest $request, $id)
    {
        // $planConsent = Plan_Consent::findOrFail($id);
        // $planConsent->update(
        //     $request->only(
        //         'owner_full_name',
        //         'city',
        //         'phone_number',
        //         'mobile_number',
        //         'sub_city',
        //         'new_woreda',
        //         'street_address',
        //         'house_number',
        //         'ownership_authentication_number',
        //         'ownership_authentication_type',
        //         'ownership_authentication_issued_date',
        //         'name_stated_on_ownership_authentication',
        //         'previous_service',
        //         'type_of_construction',
        //         'ground_floor_number',
        //     ),
        // );
        // return new PlanConsentResource($planConsent);
    }
}
