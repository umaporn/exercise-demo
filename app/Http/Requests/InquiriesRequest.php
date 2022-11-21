<?php

/**
 * Inquiries request validation
 */

namespace App\Http\Requests;

use App\Models\Inquiries;
use Illuminate\Foundation\Http\FormRequest;

/**
 * This class validates inquiries request object.
 * @package App\Http\Requests
 */
class InquiriesRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array Rules
     */
    public function rules()
    {
        return [
            'name'       => 'required|max:50',
            'email'      => 'required|email|max:50',
            'phone'      => 'required|numeric|digits_between:9,20',
            'message'    => 'required|max:500',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'address' => 'required_if:need_on_site_service,true',
        ];
    }
}
