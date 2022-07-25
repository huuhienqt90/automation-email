<?php

namespace App\Http\Requests;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateCampaignRequest extends FormRequest
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
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'unique:campaigns,slug,'.$this->route('campaign')->id],
            'status' => ['nullable', new Enum(Status::class)],
            'is_private' => ['nullable'],
            'sent_count' => ['nullable'],
            'fail_count' => ['nullable'],
            'open_count' => ['nullable'],
            'reply_count' => ['nullable']
        ];
    }
}
