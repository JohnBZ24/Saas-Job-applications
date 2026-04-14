<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
         return $this->user()->isOrg();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'company_name' => 'sometimes|string|max:255',
        'description'  => 'nullable|string',
        'website'      => 'nullable|url',
        'industry'     => 'sometimes|string',
        'phone'        => 'nullable|string',
        'email'        => 'nullable|email',
        'country'      => 'nullable|string',
        'city'         => 'nullable|string',
        'address'      => 'nullable|string',
    ];
}
}
