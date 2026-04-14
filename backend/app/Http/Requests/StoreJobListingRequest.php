<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreJobListingRequest extends FormRequest
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
            'title' =>'required|string|max:255',
            'description' => 'required|string',
            'location'=>'nullable|string',
            'type' =>'required|in"fulltime-part-time,contract,remote,internship',
            'salary_range'=>'nullable|string',
            'deadline' =>'nullable|date|after:today'
        ];
    }
}
