<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreasuriesRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {     

        return [
         'name'=>'required',
         'is_mester'=>'required',
         'last_isal_exchange'=>'required|integer|min:0',
         'last_isal_collect'=>'required|integer|min:0',
         'active'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'name.required'=>'اسم الخزنة مطلوب',
        'is_mester.required'=>'نوع الخزنة مطلوب',
        ' active.required'=>'حالة تفعيل الخزنة مطلوب',
        'last_isal_exchange.required'=>'اخر رقم ايصال صرف نقدية لهذة الخزنة',
        'last_isal_exchange.integer'=>'قيمة رقم الايصال تكون قيمة صحيحه',
        'last_isal_collect.required'=>'اخر رقم ايصال صرف نقدية لهذة الخزنة',
        'last_isal_collect.integer'=>'قيمة رقم الايصال تكون قيمة صحيحه'


        ];
    }

}
