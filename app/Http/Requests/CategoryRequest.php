<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $formType = $this->input('formType');

        switch ($formType) {
            case config('custom.form_type.create_main'):
            case config('custom.form_type.create_sub'):
                return [
                    'name' => 'required|unique:categories',
                ];

            case config('custom.form_type.edit_main'):
            case config('custom.form_type.edit_sub'):
                return [
                    'name' => 'required',
                ];
        }
        
    }

    public function messages()
    {
        return [
            'name.required' => Lang::get('validation.required', ['attribute' => 'category']),
            'name.unique' => Lang::get('validation.unique', ['attribute' => 'category']),
        ];
    }
}
