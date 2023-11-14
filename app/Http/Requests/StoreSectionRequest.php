<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
                'Name_Section_Ar' => 'required|unique:sections,Name->ar,'.$this->id,
                'Name_Section_En' => 'required|unique:sections,Name->en,'.$this->id,
                'Grade_id' => 'required',
                'Class_id' => 'required',
            ];

    }

    public function messages(): array
    {
        return [
            'Name_Section_Ar.required' => trans("validation.required"),
            'Name_Section_En.required' => trans("validation.required"),
            'Name_Section_Ar.unique' => trans("validation.unique"),
            'Name_Section_En.unique' => trans("validation.unique"),
            'Grade_id.required' => trans("validation.required"),
            'Class_id.required' => trans("validation.required"),
        ];
    
    }
}
