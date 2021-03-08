<?php

namespace App\Http\Requests\ActivityDetails;

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
            'activity_id' => 'required|String|',
            'details' => 'sometimes|required|array',
            'details.*.service_id' => 'required_with:details|string',
            'details.*.service_category' => 'required_with:details|in:WASH,IRON,CLEAN',
            'details.*.quantity' => 'required_with:details|int',
        ];
    }
}
