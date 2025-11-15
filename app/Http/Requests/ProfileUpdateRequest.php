<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidUAEPhone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'about' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string', new ValidUAEPhone],
            'whatsapp_number' => ['nullable', 'string', new ValidUAEPhone],
            'address' => ['nullable', 'string'],
            'job_title' => ['nullable', 'string'],
            'department' => ['nullable', 'string'],
            'join_date' => ['nullable', 'date'],
            'employee_id' => ['nullable', 'string', 'unique:users,employee_id,' . $this->user()->id . 'id'],
            'availability_status' => ['nullable', 'string'],
            'languages_spoken' => ['nullable', 'string'],
        ];
    }
}
