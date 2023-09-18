@extends('layouts.admin')
@section('title')
تعديل بيانات عميل
@endsection

@section('contentheader')
الحسابات

@endsection

@section('contentheaderlink')
<a href="{{ route('admin.Customer.index') }}">    العملاء </a>
@endsection

@section('contentheaderactive')
تعديل
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> تعديل بيانات عميل  </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
       
      
      <form action="{{ route('admin.Customer.update',$data['id']) }}" method="post" >
        <div class="row">
        @csrf
    
<div class="col-md-6">   
<div class="form-group">
  <label>اسم  العميل </label>
  <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"    >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
</div>

<div class="col-md-6">  

<div class="form-group">
<label>اسم    العميل للدخول به للنظام </label>
<input name="Name_enter_system" id="Name_enter_system" class="form-control" value="{{ old('Name_enter_system',$data['Name_enter_system']) }}" placeholder="ادخل اسم المستخدم" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('Name_enter_system')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-md-6">  
<div class="form-group"> 
        <label>   هل تريد تحديث كلمة المرور</label>
        <select name="checkforupdatepassword" id="checkforupdatepassword" class="form-control">
         <option {{  old('checkforupdatepassword',$data['checkforupdatepassword'])==1 ? 'selected' : ''}}   value="1"> نعم</option>
               <option {{ old('checkforupdatepassword',$data['checkforupdatepassword'])==0 ? 'selected' : ''}}  value="0"> لا </option>
        </select>
      
        @error('checkforupdatepassword')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>  </div>

        <div class="col-md-6" id="passwordDiv" style="display:none;">  
<div class="form-group">
<label>كلمة المرور      </label>
<input name="password" id="password" type="password" class="form-control" value="" placeholder="ادخل كلمة المرور " oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('password')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
</div>
  
    
<div class="col-md-6">   
  <div class="form-group">
    <label>   العنوان</label>
    <input name="address" id="address" class="form-control" value="{{ old('address',$data['address']) }}"    >
    @error('address')
    <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>
  </div> 
  <div class="col-md-6">   
    <div class="form-group">
      <label>   الهاتف</label>
      <input name="phones" id="phones" class="form-control" value="{{ old('phones',$data['phones']) }}"    >
      @error('phones')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    </div>
          <div class="col-md-6">   
            <div class="form-group">
              <label>   ملاحظات</label>
              <input name="notes" id="notes" class="form-control" value="{{ old('notes',$data['notes']) }}"    >
              @error('notes')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>

<div class="col-md-6">
      <div class="form-group"> 
        <label>  حالة التفعيل</label>
        <select name="active" id="active" class="form-control">
         <option value="">اختر الحالة</option>
        <option {{  old('active',$data['active'])==1 ? 'selected' : ''}}  value="1"> نعم</option>
         <option {{  old('active',$data['active'])==0 ? 'selected' : ''}}   value="0"> لا</option>
        </select>
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>
     
      
      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> تعديل</button>
        <a href="{{ route('admin.Customer.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
      
      </div>
    </div>
    
  </div>  
            </form>       
            

            </div>  

        </div>
      </div>
  
@endsection


@section('script')
<script src="{{ asset('home/admin/js/customers.js') }}"></script>
<script>
  function change() {
    if ($('#checkforupdatepassword').val() == 1) {
      $("#passwordDiv").show();
    } else {
      $("#passwordDiv").hide();}
  }
  $(document).on('change', '#checkforupdatepassword', function (e) {
    change();
  });
</script>
@endsection






