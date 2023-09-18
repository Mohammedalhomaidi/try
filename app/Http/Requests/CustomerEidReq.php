<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerEidReq  extends FormRequest
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
            'Name_enter_system' => 'required',
            'active' => 'required',
            'password'=>'required_if:checkforupdatepassword,1',
        
        ];
    }

    public function messages(){

        return[
            'name.required' => 'اسم  مطلوب',
            'active.required' => '   حالة تفعيل  مطلوب',
            'Name_enter_system.required' => 'اسم المستخدم   لدخول للنظام مطلوب',
            'password.required_if' => 'كلمة المرور  مطلوبة',
        ];
    }
}
