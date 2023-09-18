@extends('Layouts.admin')

@section('title')
{{__('words.Edit')}}
 {{__('words.setting')}} 
   
@endsection

@section('contentheader')
{{__('words.Edit')}}
@endsection

@section('contentheaderlink')
<a href="{{route('admin.adminsettings')}}">{{__('words.set')}} 
</a>
@endsection




@section('content')
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header"dir="ltr">
              <h3 class="card_title_center"  >{{__('words.Edit')}}{{__('words.setting')}} {{__('words.data')}}   </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if (@isset($data) && !@empty($data))
              <form action="{{ route('admin.adminsettings.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="col-md-4">
              <div class="form-group">
        <label>{{__('words.name')}} {{__('words.company')}}  </label>
        <input name="system_name" id="system_name" class="form-control" value="{{ $data['system_name'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
        @error('system_name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        </div>
        <div class="col-md-4">
              <div class="form-group">
                <label>  {{__('words.Address')}} {{__('words.company')}}</label>
                <input name="address" id="address" class="form-control" value="{{ $data['address'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror  
              </div>
            </div>
            <div class="col-md-4">
                      <div class="form-group">
                        <label>  {{__('words.phone')}}{{__('words.company')}}</label>
                        <input name="phone" id="phone" class="form-control" value="{{ $data['phone'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror   
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>    {{__('words.Type_batch_in_system')}} </label>
                        <Select name="batches_setting_type" id="batches_setting_type" class="form-control" >
                          <option value=""> {{__('words.Select_type')}}     </option>
                          <option value="1">   {{__('words.batch_System_works')}}  </option>
                          <option value="2"> {{__('words.batch_System_not_work')}} </option>
                       </select>
                          @error('batches_setting_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror   
                      </div>
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label> {{__('words.not_select_batch')}}     </label>
                        <Select name="defualt_unit" id="defualt_unit" class="form-control">
                          <option   @if(old('defualt_unit',$data['defualt_unit'])==1) selected="selected" @endif  value="1">  {{__('words.sale_unit_parent')}} </option>
                          <option   @if(old('defualt_unit',$data['defualt_unit'])==2) selected="selected" @endif  value="2">   {{__('words.sale_unit_part')}} </option>
                </select>
                          @error('defualt_unit')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror   
                      </div>
                    </div>
                            <div class="col-md-12">
                      <div class="form-group">
                        <label>   {{__('words.Massage')}} {{__('words.company')}}  </label>
                        <input name="general_alert" id="general_alert" class="form-control" value="{{ $data['general_alert'] }}" placeholder="ادخل اسم الشركة" oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}" >
                    </div> 
                            </div>        
                            <div class="col-md-12">
                    <div class="form-group"  >
                        <label>  {{__('words.logo')}} {{__('words.company')}} </label>
                    <div class="image">
                <img class="custom_img" src="{{ asset('home/admin/imgs').'/'.$data['photo'] }}"  alt="لوجو الشركة">       
              <button type="button" class="btn btn-sm btn-danger" id="update_image">   {{__('words.Change_photo')}} </button>
              <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_update_image">   {{__('words.Cancel')}} </button>
  
            </div>
                    </div>
        <div id="oldimage">
            
        </div>
        
        
                    </div>  
                    <div class="col-md-12">
              <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-sm">   {{__('words.Save_Edit')}}  </button>
              </div>
            </div>
            </div>
            </form>  
               
                @else
          <div class="alert alert-danger">
               {{__('words.not_data')}}  
                   </div>
                @endif
       </div>
    </div>
        </div>
</div>
@endsection