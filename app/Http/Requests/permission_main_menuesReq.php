<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class permission_main_menuesReq extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'active'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم القائمة مطلوب',
    
            'active.required'=>'حالة القائمة مطلوبة',
     
        ];
    }
}
