<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePerformance extends FormRequest
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
            'attend_date' => 'required',
            'punch_out' => 'after:punch_in',
        ];
    }

    public function attributes()
    {
       return [
        'attend_date' => '日付',
       ];
    }
}