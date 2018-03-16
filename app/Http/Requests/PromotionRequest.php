<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Lang;

class PromotionRequest extends FormRequest
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
            case config('custom.form_type.create'):
                $rules = [
                    'name' => 'required|unique:promotions',
                    'promotionRage' => 'required',
                    'products' => 'required',
                    'percent' => 'required|numeric|min:1|max:100',
                    'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:2000',
                ];

                return $rules;

            case config('custom.form_type.edit'):
                $rules = [
                    'name' => 'required',
                    'promotionRage' => 'required',
                    'products' => 'required',
                    'percent' => 'required|numeric|min:1|max:100',
                    'image' => 'image|mimes:jpg,jpeg,bmp,png|max:2000',
                ];

                return $rules;
        }
    }

    public function messages()
    {
        return [
            'name.required' => Lang::get('validation.required', ['attribute' => 'promotion']),
            'name.unique' => Lang::get('validation.unique', ['attribute' => 'promotion']),
            'promotionRage.required' => Lang::get('validation.required', ['attribute' => 'promotion date']),
            'products.required' => Lang::get('validation.required'),
            'percent.required' => Lang::get('validation.required'),
            'percent.numeric' => Lang::get('validation.numeric'),
            'percent.min' => Lang::get('validation.min.numeric', ['min' => 1]),
            'percent.max' => Lang::get('validation.max.numeric', ['max' => 100]),
            'image.required' => Lang::get('validation.required'),
            'image.image' => Lang::get('validation.image'),
            'image.mimes' => Lang::get('validation.mimes', ['value' => 'jpg,jpeg,bmp,png']),
            'image.max' => Lang::get('validation.max.file', ['max' => 2000]),
        ];
    }
}
