<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'avatar' => ['nullable', 'file'],
            'job_title' => ['nullable'],
            'last_campaign' => ['nullable'],
            'status' => [new Enum(Status::class)]
        ];
    }
}
