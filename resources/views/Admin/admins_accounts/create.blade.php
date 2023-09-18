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
اضافة
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title card_title_center"> اضافة مستخدم    جديد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
    
      <form action="{{ route('admin.admins_accounts.store') }}" method="post" >
        @csrf
        
      <div class="form-group">
<label>اسم    المستخدم </label>
<input name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="ادخل اسم المستخدم" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('name')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

<div class="form-group">
<label>اسم    المستخدم للدخول به للنظام </label>
<input name="username" id="username" class="form-control" value="{{ old('username') }}" placeholder="ادخل اسم المستخدم" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('username')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>


<div class="form-group">
<label>كلمة المرور      </label>
<input name="password" id="password" type="password" class="form-control" value="{{ old('password') }}" placeholder="ادخل اسم المستخدم" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
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
       <option @if(old('permission_rols_id')==$info->id) selected="selected" @endif value="{{ $info->id }}" > {{ $info->name }}</option>
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
        <option   @if(old('active')==1) selected="selected"  @endif value="1"> مفعل</option>
         <option @if(old('active')==0 and old('active')!="" ) selected="selected"   @endif value="0"> غير مفعل</option>
        </select>
      
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
    
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-sm"> اضافة</button>
        <a href="{{ route('admin.admins_accounts.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
        
      </div>
        
            
            </form>  
        
            

            </div>  

      


        </div>
      </div>
    </div>
</div>





@endsection



