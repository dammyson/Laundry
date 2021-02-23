<?php

namespace App\Http\Requests\Activities;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'first_name' => 'required|String|',
            'last_name' => 'required|String|',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|in:EXPRESS,REGULAR',
            'pickup_time'=> 'required|string',
            'details' => 'sometimes|required|array',
            'details.*.service_id' => 'required_with:details|string',
            'details.*.service_category' => 'required_with:details|in:WASH,IRON,CLEAN',
            'details.*.quantity' => 'required_with:details|int',
        ];
    }
}
