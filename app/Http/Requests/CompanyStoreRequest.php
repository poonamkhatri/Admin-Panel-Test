<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:6|max:255',
            'email' => 'required|email|max:255|unique:companies',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:100|dimensions:min_width=100,min_height=100',
            'website' => 'required|url',
        ];
    }
}
