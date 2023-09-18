
@if (@isset($checkExistsOpenShift) && !@empty($checkExistsOpenShift))
@if (@isset($Admins_Shifts_will_reviewed) && !@empty($Admins_Shifts_will_reviewed))
          
<form action="{{ route('admin.admin_shift.do_review_now',$Admins_Shifts_will_reviewed['id']) }}" method="post" >
        @csrf
        
      <div class="form-group">
<label>اجمالي النقدية لهذا الشفت  على النظام</label>
<input readonly  name="money_should_deviled" id="money_should_deviled" value="{{$Admins_Shifts_will_reviewed['money_should_deviled']}}" class="form-control" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" required oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('name')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

<div class="form-group">
<label>اجمالي النقدية الفعلية المستلمة يدوياً بهذا الشفت   </label>
<input  name="what_realy_delivered" id="what_realy_delivered" value="{{$Admins_Shifts_will_reviewed['money_should_deviled']}}" class="form-control" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" required oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('what_realy_delivered')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

      <div class="form-group"> 
        <label>  حالة الاستلام</label>
        <select name="money_state" id="money_state" class="form-control">
         <option  selected   value="0"> متزن</option>
         <option    value="1"> يوجد عجز بالنقدية </option>
         <option    value="2"> يوجد زيادة بالنقدية</option>
        </select>
      
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>

        <div class="form-group style='display:none'" id="money_state_valueDiv">
<label id="money_state_valuelabel">اجمالي النقدية الفعلية المستلمة يدوياً بهذا الشفت   </label>
<input readonly name="money_state_value" id="money_state_value" value="0" class="form-control" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" required oninvalid="setCustomValidity('من فضلك ادخل هذا الحقل')" onchange="try{setCustomValidity('')}catch(e){}"  >
@error('what_realy_delivered')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary btn-sm"> استلام النقدية الان </button>
        <a href="{{ route('admin.admin_shift.index') }}" class="btn btn-sm btn-danger">الغاء</a>    
        
      </div>
        
            
            </form>  
       
            @else
           <div class="alert alert-danger">
             عفوا غير قادر للوصول  الي هذا   الشفت !!
           </div>
                 @endif   @else
           <div class="alert alert-danger">
             عفوا لا يوجد شفت مفتوح لك حلياً !!
           </div>
                 @endif
