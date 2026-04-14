<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSeekerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isSeeker();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'first_name'    => 'sometimes|string|max:255',
        'last_name'     => 'sometimes|string|max:255',
        'headline'      => 'nullable|string|max:255',
        'bio'           => 'nullable|string',
        'phone'         => 'nullable|string',
        'country'       => 'nullable|string',
        'city'          => 'nullable|string',
        'open_to_remote'=> 'sometimes|boolean',
        'available'     => 'sometimes|boolean',
    ];
    }
}
