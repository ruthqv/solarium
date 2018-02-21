<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolrRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'field' =>'required',
            'value' => 'string',
            'values' =>'array',
            'shortBy' => 'string',
            //
        ];
    }
}
