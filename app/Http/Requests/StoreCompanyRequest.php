<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreCompanyRequest extends FormRequest
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
            'name' => ['required'],
            'slug' => ['required', 'unique:companies,slug'],
            'logo' => ['nullable', 'file'],
            'phone' => ['nullable'],
            'email' => ['required', 'email'],
            'address' => ['nullable'],
            'website' => ['nullable', 'url'],
            'fax' => ['nullable'],
            'status' => ['nullable', new Enum(Status::class)]
        ];
    }
}
