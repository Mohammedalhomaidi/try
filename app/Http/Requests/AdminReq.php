<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminReq extends FormRequest
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
            'password' => 'required',
            'username' => 'required',
            'permission_rols_id' => 'required|sometimes',
            'active' => 'required',


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'اسم المستخدم مطلوب',
            'username.required' => 'اسم المستخدم   لدخول للنظام مطلوب',
            'password.required' => 'كلمة المرور  مطلوبة',
            'permission_rols_id.required' => 'نوع المسخدم   مطلوب',
            'active.required' => '   حالة تفعيل المسخدم مطلوب',


        ];
    }
}
