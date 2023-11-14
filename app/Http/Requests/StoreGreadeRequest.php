<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGreadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|unique:grades,Name->en,'.$this->id,
            'name_ar' => 'required|unique:grades,Name->ar,'.$this->id,
            'notes' => 'required',
        ];
    
    }
    public function messages(): array
    {
        return [
            'name_ar.required' => trans("validation.required"),
            'name_en.required' => trans("validation.required"),
            'name_ar.unique' => trans("validation.unique"),
            'name_en.unique' => trans("validation.unique"),
            'notes.required' => trans("validation.required"),
        ];
    
    }


}
