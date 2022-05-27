<?php

namespace Tracket\Admin\Http\Requests\Themes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Tracket\Job\Enums\JobType;

class StoreThemeRequest extends FormRequest
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
            'theme' => ['required', 'file'],
        ];
    }
}
