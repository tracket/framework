<?php

namespace Tracket\Admin\Http\Requests\Jobs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tracket\Job\Enums\JobType;

class UpdateJobRequest extends FormRequest
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
            'title'           => ['required', 'string', 'max:255'],
            'company'         => ['required', 'string', 'max:255'],
            'application_url' => ['required', 'string'],
            'type'            => ['required', 'string', Rule::in(collect(JobType::cases())->pluck('value')->toArray())],
            'location'        => ['required', 'string', 'max:255'],
            'remote_ok'       => ['nullable', 'boolean'],
            'description'     => ['required', 'string'],
        ];
    }
}
