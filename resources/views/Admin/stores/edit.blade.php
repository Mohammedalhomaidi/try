@extends('Layouts.admin')
@section('title')
تعديل المخازن
@endsection

@section('contentheader')
المخازن
@endsection

@section('contentheaderlink')
<a href="{{ route('admin.stores.index') }}">  المخازن </a>
@endsection

@section('contentheaderactive')
تعديل
@endsection



@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title card_title_center">تعديل بيانات   مخزن</h3>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @if (@isset($data) && !@empty($data))
      <form action="{{ route('admin.stores.update',$data['id']) }}" method="post" >
        @csrf
        
      <div class="form-group">
        <label>اسم  المخزن</label>
        <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"   >
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
          <label>هاتف  المخزن</label>
          <input name="phones" id="phones" class="form-control" value="{{ old('phones',$data['phones']) }}"   >
          @error('phones')
          <span class="text-danger">{{ $message }}</span>
          @enderror
          </div>
          <div class="form-group">
            <label>عنوان  المخزن</label>
            <input name="address" id="address" class="form-control" value="{{ old('address',$data['address']) }}"   >
            @error('address')
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
<button type="submit" class="btn btn-primary btn-sm">حفظ التعديلات</button>
<a href="{{ route('admin.stores.index') }}" class="btn btn-sm btn-danger">الغاء</a>    

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



