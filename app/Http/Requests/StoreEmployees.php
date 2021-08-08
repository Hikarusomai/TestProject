<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployees extends FormRequest
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
            'first_name' => 'alpha|required|max:255',
            'last_name' => 'alpha|required|max:255',
            'company_id' => 'required|max:20',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email'
        ];
    }
}