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
@section("css")
<link rel="stylesheet" href="{{ asset('home/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('home/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheaderactive')
عرض التفاصيل
@endsection
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header">

            <h3 class="card-title card_title_center"> تفاصيل  الصلاحيات الخاص بالمستخدم  </h3>
            <input type="hidden" id="token_search" value="{{csrf_token() }}">
    
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
               <tr>
                  <td class="width30">اسم المستخدم</td>
                  <td > {{ $data['name'] }}</td>
               </tr>
               <tr>
               <tr>
                  <td class="width30">نوع صلاحية دور المستخدم</td>
                  <td > {{ $data['permission_rol_name'] }}</td>
               </tr>
               <tr>
       
                  <td class="width30">  حالة تفعيل المستخدم</td>
                  <td > @if($data['active']==1) مفعل  @else معطل @endif</td>
               </tr>
               <tr>
                  <td class="width30">  تاريخ  الاضافة</td>
                  <td > 
                     @php
                     $dt=new DateTime($data['created_at']);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($time));
                     $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}
                     {{ $time }}
                     {{ $newDateTimeType }}
                     بواسطة 
                     {{ $data['added_by_admin'] }}
                  </td>
               </tr>
               <tr>
                  <td class="width30">  تاريخ اخر تحديث</td>
                  <td > 
                     @if($data['updated_by']>0 and $data['updated_by']!=null )
                     @php
                     $dt=new DateTime($data['updated_at']);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($time));
                     $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}
                     {{ $time }}
                     {{ $newDateTimeType }}
                     بواسطة 
                     {{ $data['updated_by_admin'] }}
                     @else
                     لايوجد تحديث
                     @endif
                     @if(check_permeission_sub_menues_action(54)==true)
                     <a href="{{  route('admin.admins_accounts.Edit',$data['id']) }}" class="btn btn-sm btn-success">تعديل</a>
                         @endif
                     <a href="{{ route('admin.admins_accounts.index') }}" class="btn btn-sm btn-info">عودة</a>
                  </td>
               </tr>
            </table>
            <!--  treasuries_delivery   -->
            <div class="card-header">
               <h3 class="card-title card_title_center">الخزن المضافة     لصلاحية المستخدم  ( {{ $data['name'] }} )  
               @if(check_permeission_sub_menues_action(58)==true)
               <Button  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#load_add_Treasuriesmodal">اضافة خزنة</a>
                         @endif
               </h3>
            </div>
            <div id="ajax_responce_serarchDiv">
               @if (@isset($admins_treasuries) && !@empty($admins_treasuries) && count($admins_treasuries) >0)
               @php
               $i=1;   
               @endphp
               <table id="example2" class="table table-bordered table-hover">
                  <thead class="custom_thead">
                     <th>الرقم</th>
                     <th>اسم الخزنة</th>
                     <th>تاريخ الاضافة</th>
                     <th >الاضافة بواسطة </th>
                     <th></th>
                  </thead>
                     @foreach ($admins_treasuries as $inf )
                 
                  <tbody>
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $inf->treasuries_name }}</td>
                        <td > 
                           @php
                           $dt=new DateTime($inf->created_at);
                           $date=$dt->format("Y-m-d");
                           $time=$dt->format("h:i");
                           $newDateTime=date("A",strtotime($time));
                           $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                           @endphp
                           {{ $date }}
                           {{ $time }}
                           {{ $newDateTimeType }}

                        </td>
                        
                        <td>
                        {{ $inf->added_by_admin}}
                        </td>

                        <td>
                        @if(check_permeission_sub_menues_action(54)==true)
                        <a href="{{ route('admin.admins_accounts.treasuries_delete',$inf->id) }}" class="btn btn-sm btn-danger are_you_shue">حذف</a>
                         @endif
                        </td>

                     </tr>
   
                     @php
                     $i++; 
                     @endphp
                     @endforeach
                  </tbody>
               </table>
               @else
               <div class="alert alert-danger">
                  عفوا لاتوجد بيانات لعرضها !!
               </div>
               @endif
            </div>
            <!--  End treasuries_delivery   -->
         
            
         <div class="card-header">
               <h3 class="card-title card_title_center">المخازن المضافة     لصلاحية المستخدم  ( {{ $data['name'] }} )  
               @if(check_permeission_sub_menues_action(57)==true)
               <Button  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#load_add_Storesmodal">اضافة مخازن</a>
                @endif
               </h3>
            </div>
            <div id="ajax_responce_serarchDiv">
               @if (@isset($admins_stores) && !@empty($admins_stores) && count($admins_stores) >0)
               @php
               $i=1;   
               @endphp
               <table id="example2" class="table table-bordered table-hover">
                  <thead class="custom_thead">
                     <th>الرقم</th>
                     <th>اسم الخزنة</th>
                     <th>تاريخ الاضافة</th>
                     <th >الاضافة بواسطة </th>
                     <th></th>
                  </thead>
                     @foreach ($admins_stores as $info )
                 
                  <tbody>
                     <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $info->stores_name }}</td>
                        <td > 
                           @php
                           $dt=new DateTime($info->created_at);
                           $date=$dt->format("Y-m-d");
                           $time=$dt->format("h:i");
                           $newDateTime=date("A",strtotime($time));
                           $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                           @endphp
                           {{ $date }}
                           {{ $time }}
                           {{ $newDateTimeType }}

                        </td>
                        
                        <td>
                        {{ $info->added_by_admin}}
                        </td>

                        <td>
                        @if(check_permeission_sub_menues_action(54)==true)
                        <a href="{{ route('admin.admins_accounts.admins_store_delete',$info->id) }}" class="btn btn-sm btn-danger are_you_shue">حذف</a>
                         @endif
                        </td>

                     </tr>            
                     @php
                     $i++; 
                     @endphp
                     @endforeach
                  </tbody>
               </table>
               @else
               <div class="alert alert-danger">
                  عفوا لاتوجد بيانات لعرضها !!
               </div>
               @endif
            </div>
            <!--  End Add_Stores   -->
            @else
            <div class="alert alert-danger">
               عفوا لاتوجد بيانات لعرضها !!
            </div>

            @endif
         </div>
      </div>
   </div>
</div>

   <div class="modal fade  "   id="load_add_Treasuriesmodal">
      <div class="modal-dialog modal-xl"  >
         <div class="modal-content bg-info">
            <div class="modal-header">
               <h4 class="modal-title text-center">   اضافة خزنة لصلاحية  المستخدم </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"  style="background-color: white !important; color:black;">
           <Form action="{{route('admin.admins_accounts.Add_permission_main_menues',$data['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
               <div class="form-group"> 
               <label>  بيانات الخزن </label>
               <select required name="Treasuries_id[]" multiple id="Treasuries_id" class="form-control select2">
               <option  value=""> اختر الخزن </option>
        @if(@isset($Treasuries)&&!@empty($Treasuries))
      @foreach($Treasuries as $data)
          <option  value="{{ $data->id }}" > {{ $data->name }}</option>
     @endforeach
      @endif
    </select>
    @error('Treasuries_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

        <Div class="form-group text-center">
                  <button type="submit" class="btn btn-primary "> اضافة</button>
       </div>    
</form>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>

   <div class="modal fade  "   id="load_add_Storesmodal">
      <div class="modal-dialog modal-xl"  >
         <div class="modal-content bg-info">
            <div class="modal-header">
               <h4 class="modal-title text-center">   اضافة مخازن لصلاحية  المستخدم </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"  style="background-color: white !important; color:black;">
           <Form action="{{route('admin.admins_accounts.Add_Stores',$data['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
               <div class="form-group"> 
               <label>  بيانات المخازن </label>
               <select required name="Stores_id[]" multiple id="Stores_id" class="form-control select2">
               <option  value=""> اختر المخزن </option>
        @if(@isset($Stores)&&!@empty($Stores))
      @foreach($Stores as $data)
          <option  value="{{ $data->id }}" > {{ $data->name }}</option>
     @endforeach
      @endif
    </select>
    @error('Stores_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

        <Div class="form-group text-center">
                  <button type="submit" class="btn btn-primary "> اضافة</button>
       </div>    
</form>
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>

@endsection
@section('script')
<script  src="{{ asset('home/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script src="{{ asset('home/admin/js/admin.js') }}"></script>

<script>
   //Initialize Select2 Elements
   $('.select2').select2({
    theme: 'bootstrap4'
  });
</script>
@endsection