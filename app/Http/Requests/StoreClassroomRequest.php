<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
            'List_Classes.*.Name_class_ar' => 'required|unique:classrooms,Name->ar,'.$this->id,
            'List_Classes.*.Name_class_en' => 'required|unique:classrooms,Name->en,'.$this->id,
            'List_Classes.*.Grade_id' => 'required',

        ];
    }
    public function messages(): array
    {
        return [
            'List_Classes.*.Name_class_ar.required' => trans("validation.required"),
            'List_Classes.*.Name_class_en.required' => trans("validation.required"),
            'List_Classes.*.Name_class_en.unique' => trans("validation.unique"),
            'List_Classes.*.Name_class_en.unique' => trans("validation.unique"),
            'List_Classes.*.Grade_id.required' => trans("validation.required"),
        ];
    
    }

}
