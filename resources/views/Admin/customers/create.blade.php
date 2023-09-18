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
اضافة
@endsection
@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> اضافة حساب عميل جديد</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
       
      
      <form action="{{ route('admin.Customer.store') }}" method="post" >
        <div class="row">
        @csrf
    
<div class="col-md-6">   
<div class="form-group">
  <label>اسم   العميل</label>
  <input name="name" id="name" class="form-control" value="{{ old('name') }}"    >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
</div>

<div class="col-md-6">  
<div class="form-group">
<label>اسم    العميل للدخول به للنظام </label>
<input name="Name_enter_system" id="Name_enter_system" class="form-control" value="{{ old('Name_enter_system') }}" placeholder="ادخل اسم المستخدم" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('Name_enter_system')
<span class="text-danger">{{ $message }}</span>
@enderror
</div></div>

<div class="col-md-6">  
<div class="form-group">
<label>كلمة المرور      </label>
<input name="password" id="password" type="password" class="form-control" value="{{ old('password') }}" placeholder="ادخل اسم المستخدم" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('password')
<span class="text-danger">{{ $message }}</span>
@enderror
</div></div>

      <div class="col-md-6">   
        <div class="form-group">
          <label>   حالة رصيد اول المدة</label>
          <select name="start_balance_status" id="start_balance_status" class="form-control">
            <option value="">اختر الحالة</option>
           <option   @if(old('start_balance_status')==1) selected="selected"  @endif value="1"> دائن</option>
           <option   @if(old('start_balance_status')==2) selected="selected"  @endif value="2"> مدين</option>
           <option   @if(old('start_balance_status')==3) selected="selected"  @endif value="3"> متزن</option>
           </select>
          @error('start_balance_status')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        </div>

        <div class="col-md-6">   
          <div class="form-group">
            <label>   رصيد أول المدة للحساب</label>
            <input  name="start_balance" id="start_balance" class="form-control"  oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="{{ old('start_balance') }}"    >
            @error('start_balance')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          </div>

          <div class="col-md-6">   
            <div class="form-group">
              <label>   العنوان </label>
              <input name="address" id="name" class="form-control" value="{{ old('address') }}"    >
              @error('address')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>
            <div class="col-md-6">   
              <div class="form-group">
                <label>   الهاتف</label>
                <input name="phones" id="phones" class="form-control" value="{{ old('phones') }}"    >
                @error('phones')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              </div>

              <div class="col-md-6">
      <div class="form-group"> 
        <label>  حالة التفعيل</label>
        <select name="active" id="active" class="form-control">
         <option value="">اختر الحالة</option>
        <option   @if(old('active')==1  || old('active')=="" ) selected="selected"  @endif value="1"> نعم</option>
         <option @if( (old('active')==0 and old('active')!="")) selected="selected"  @endif   value="0"> لا</option>
        </select>
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>

          <div class="col-md-12">   
            <div class="form-group">
              <label>   ملاحظات</label>
              <input name="notes" id="notes" class="form-control" value="{{ old('notes') }}"    >
              @error('notes')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>
         

     
      
      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> اضافة</button>
        <a href="{{ route('admin.Customer.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
      </div>
    </div>
  
    
  </div>  
  </form> 
  
  
             </div> 
        </div>
  

@endsection


@section('script')
<script src="{{ asset('home/admin/js/customers.js') }}"></script>
@endsection






