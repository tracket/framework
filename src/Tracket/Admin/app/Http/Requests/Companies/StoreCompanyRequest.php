<?php

namespace Tracket\Admin\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name'         => ['required', 'string', 'max:255'],
            'tagline'      => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'website_url'  => ['required', 'string'],
            'linkedin_url' => ['nullable', 'string'],
            'twitter_url'  => ['nullable', 'string'],
            'blog_url'     => ['nullable', 'string'],
            'logo'         => ['nullable', 'file'],
        ];
    }
}
