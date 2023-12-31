@extends(check_for_pagehome())
@section('title')
العملاء
@endsection

@section('contentheader')
الحسابات  
@endsection

@section('contentheaderlink')
<a href="{{ route('admin.Customer.index') }}">    العملاء </a>
@endsection

@section('contentheaderactive')
عرض
@endsection



@section('content')


  
      <div class="card">

        <div class="card-header">
          <h3 class="card-title card_title_center">بيانات   العملاء  </h3>
          <input type="hidden" id="token_search" value="{{csrf_token() }}">
          <input type="hidden" id="ajax_search_url" value="{{ route('admin.Customer.ajax_search') }}">
         @if(check_permeission_sub_menues_action(29)==true)
          <a href="{{ route('admin.Customer.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
          @endif
        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">

          <div class="col-md-4">
          <div class="form-group"> 
            <input  type="radio" checked name="searchbyradio" id="searchbyradio" value="account_number"> برقم الحساب
            <input  type="radio"  name="searchbyradio" id="searchbyradio" value="account">  بالهاتف 
            <input  type="radio" name="searchbyradio" id="searchbyradio" value="name"> بالاسم
            <input autofocus style="margin-top: 6px !important;" type="text" id="search_by_text" placeholder=" اسم  - رقم الحساب  - هاتف العميل" class="form-control"> <br>
                      </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group"> 
                          <label>  بحث بحالة الرصيد</label>
                          <select name="searchByBalanceStatus" id="searchByBalanceStatus" class="form-control">
                            <option   value="all"> بحث بالكل</option>
                            <option   value="1"> دائن</option>
                            <option  value="2"> مدين</option>
                            <option    value="3"> متزن</option>
                          </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group"> 
                            <label>  بحث بحالة التفعيل</label>
                            <select name="searchByactiveStatus" id="searchByactiveStatus" class="form-control">
                              <option   value="all"> بحث بالكل</option> 
                              <option   value="1"> مفعل</option>
                              <option  value="0"> معطل</option>
                            </select>
                            </div>
                          </div>
               <div class="clearfix"></div>
     
        <div id="ajax_responce_serarchDiv" class="col-md-12">
        <div class="form-group"> 
          @if (@isset($data) && !@empty($data) && count($data)>0)

          <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
            <th>  الرقم </th>
           <th>الاسم </th>
           <th> الاسم العميل لدخول  </th>
           <th> رقم الحساب </th>
           <th>  الرصيد </th>
           <th>  العنوان </th>
           <th>  الهاتف </th>

           <th>  ملاحظات </th>

           <th> التفعيل</th>
          <th></th>

            </thead>
            <tbody>
         @foreach ($data as $info )
         @if($info->id>1)
            <tr>
            <td>{{ $info->customer_code }}</td> 
            <td>{{ $info->name }}</td> 
                <td>{{ $info->Name_enter_system }}</td>  

             <td>{{ $info->account_number }}</td>  
             <td> 
           
            @if($info->current_balance >0)
            مدين ب ({{ $info->current_balance*1 }}) ريال   
            @elseif ($info->current_balance <0)
            دائن ب ({{ $info->current_balance*1*(-1) }})   ريال 

          @else
      متزن
          @endif
          
            </td> 
            
            <td>{{ $info->address }}</td>  
            <td>{{ $info->phones }}</td>  

            <td>{{ $info->notes }}</td>  

             <td>@if($info->active==1) مفعل @else معطل @endif</td> 
      
         <td>
         @if(check_permeission_sub_menues_action(32)==true)
        <a href="{{ route('admin.Customer.edit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>   
        @endif
         </td>
        
           </tr> 
           @endif
         @endforeach

            </tbody>
     </table>
      <br>
  
           {{ $data->links() }}
       
           @else
           <div class="alert alert-danger">
             عفوا لاتوجد بيانات لعرضها !!
           </div>
                 @endif

   
                 </div> 
  </div>
      
     </div>


@endsection

@section('script')
<script src="{{ asset('home/admin/js/customers.js') }}"></script>
@endsection


