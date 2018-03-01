<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Auth;
use MyFunctions;
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
                break;

            case config('custom.form_type.edit_main'):
            case config('custom.form_type.edit_sub'):
                return [
                    'name' => 'required',
                ];
                break;
        }
        
    }

    public function messages()
    {
        MyFunctions::changeLanguage();

        return [
            'name.required' => Lang::get('custom.validation.category_required'),
            'name.unique' => Lang::get('custom.validation.category_unique'),
        ];
    }
}
