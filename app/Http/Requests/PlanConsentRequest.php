<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanConsentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'owner_full_name' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'mobile_number' => 'required',
            'sub_city' => 'required',
            'new_woreda' => 'required',
            'street_address' => 'required',
            'house_number' => 'required',
            'ownership_authentication_number' => 'required',
            'ownership_authentication_type' => 'required',
            'ownership_authentication_issued_date' => 'required',
            'name_stated_on_ownership_authentication' => 'required',
            'previous_service' => 'required',
            'type_of_construction' => 'required',
            'ground_floor_number' => 'required',
        ];
    }
}
