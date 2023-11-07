<?php

namespace App\Http\Requests;

use App\Enums\Urgency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequestRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            // Rule::in(Urgency::values())] => [0,1,2] (dynamic array)
            'importance' => ['required', Rule::in(Urgency::values())],
            'attachments.*' => ['nullable', 'mimes:png,mp4,mp3']
        ];
    }
}
