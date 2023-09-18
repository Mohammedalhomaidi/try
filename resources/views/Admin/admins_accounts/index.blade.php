@extends('layouts.admin')
@section('title')
 الصلاحيات
@endsection

@section('contentheader')
المستخدمين
@endsection

@section('contentheaderlink')
<a href="{{ route('admin.admins_accounts.index') }}"> المستخدمين </a>
@endsection

@section('contentheaderactive')
عرض
@endsection



@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center">بيانات  المستخدمين</h3>
          <input type="hidden" id="token_search" value="{{csrf_token() }}">
          <input type="hidden" id="ajax_search_url" value="{{ route('admin.admins_accounts.ajax_search') }}">
          @if(check_permeission_sub_menues_action(53)==true)
          <a href="{{ route('admin.admins_accounts.create') }}" class="btn btn-sm btn-success" >اضافة جديد</a>
          @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <div class="row">
        <div class="col-md-4">
            <label> بحث بالاسم </label> 
            <input style="margin-top: 6px !important;" type="text" id="search_by_text" placeholder=" اسم " class="form-control"> <br>
                      </div>
                       
                      <div class="col-md-4"> 
                          <div class="form-group"> 
                            <label>   بحث بادوار  الصلاحيات</label>

                            <select name="permission_rols_id_search" id="permission_rols_id_search" class="form-control ">
                           <option value="all"> بحث بالكل</option>
                              @if (@isset($permission_rols) && !@empty($permission_rols))
                             @foreach ($permission_rols as $info )
                               <option value="{{ $info->id }}"> {{ $info->name }} </option>
                             @endforeach
                              @endif
                            </select>
                            @error('inv_itemcard_categories_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                          </div>
                        
                  
                          </div>
       
        <div id="ajax_responce_serarchDiv">
          @if (@isset($data) && !@empty($data))
          @php
           $i=1;   
          @endphp
          <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
           <th>مسلسل</th>
           <th>اسم المستخدم</th> 
              <th>دور المستخدم</th>
           <th>حالة التفعيل</th>
           <th></th>
          
            </thead>
            <tbody>
         @foreach ($data as $info )
            <tr>
             <td>{{ $i }}</td>  
             <td>{{ $info->name }}</td>  
             <td>{{ $info->permission_rols_name }}</td>  
             <td>@if($info->active==1) مفعل @else معطل @endif</td>  
         <td>
         @if(check_permeission_sub_menues_action(54)==true)
         <a href="{{ route('admin.admins_accounts.Edit',$info->id) }}" class="btn btn-sm mmm btn-primary">تعديل</a>   
          @endif
          @if(check_permeission_sub_menues_action(55)==true)
          <a href="{{ route('admin.admins_accounts.Details',$info->id) }}" class="btn btn-sm  btn-info">صلاحيات خاصة</a>   
          @endif
       
         </td>
           
   
           </tr> 
      @php
         $i++; 
      @endphp
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
    </div>
</div>





@endsection

@section('script')
<script src="{{ asset('home/admin/js/admin.js') }}"></script>

@endsection


