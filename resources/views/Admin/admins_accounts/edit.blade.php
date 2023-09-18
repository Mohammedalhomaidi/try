@extends('Layouts.admin')

@section('title')
الصلاحيات 
@endsection
المستخدمين
@section('contentheader')
   
@endsection

@section('contentheaderlink')
<a href="{{ route('admin.admins_accounts.index') }}">    المستخدمين </a>
@endsection

@section('contentheaderactive')
تعديل
@endsection



@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title card_title_center">تعديل بيانات   المستخدمين </h3>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if (@isset($data) && !@empty($data))
      <form action="{{ route('admin.admins_accounts.update',$data['id']) }}" method="post" >
        @csrf
        
        <div class="form-group">
<label>اسم    المستخدم </label>

<input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"   >
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
</div>

<div class="form-group">
<label>اسم    المستخدم للدخول به للنظام </label>
<input name="username" id="username" class="form-control" value="{{ old('username',$data['username']) }}" placeholder="ادخل اسم المستخدم" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('username')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

<div class="form-group"> 
        <label>   هل تريد تحديث كلمة المرور</label>
        <select name="checkforupdatepassword" id="checkforupdatepassword" class="form-control">
         <option {{  old('checkforupdatepassword',$data['checkforupdatepassword'])==1 ? 'selected' : ''}}   value="1"> نعم</option>
               <option {{ old('checkforupdatepassword',$data['checkforupdatepassword'])==0 ? 'selected' : ''}}  value="0"> لا </option>
        </select>
      
        @error('checkforupdatepassword')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

<div class="form-group" id="passwordDiv" style="display:none;">
<label>كلمة المرور      </label>
<input name="password" id="password" type="password" class="form-control" value="" placeholder="ادخل كلمة المرور " oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('password')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

<div class="form-group"> 
    <label>     اختر الدور </label>
    <select name="permission_rols_id" id="permission_rols_id" class="form-control ">
      <option value="">اختر القائمة الرئيسية</option>
      @if (@isset($permission_rols) && !@empty($permission_rols))
     @foreach ($permission_rols as $info )
     <option {{  old('permission_rols_id',$data['permission_rols_id'])==$info->id ? 'selected' : ''}} value="{{ $info->id }}"> {{ $info->name }} </option>
     @endforeach
      @endif
    </select>
    @error('permission_rols_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>

    <div class="form-group"> 
        <label>  حالة التفعيل</label>
        <select name="active" id="active" class="form-control">
         <option value="">اختر الحالة</option>
         <option {{  old('active',$data['active'])==1 ? 'selected' : ''}}   value="1"> مفعل</option>
               <option {{ old('active',$data['active'])==0 ? 'selected' : ''}}  value="0"> غير مفعل</option>
        </select>
      
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
    

      <div class="form-group text-center">
      <button type="submit" class="btn btn-primary btn-sm" id="m">حفظ التعديلات</button>
        <a href="{{ route('admin.admins_accounts.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
        
      </div>
    
    </form>  

        @else
  <div class="alert alert-danger">
    عفوا لاتوجد بيانات لعرضها !!
  </div>
        @endif
      


        </div>
      </div>
    </div>
</div>





@endsection

@section('script')
@section('script')
<script src="{{ asset('home/admin/js/admin.js') }}"></script>

@endsection
@endsection



