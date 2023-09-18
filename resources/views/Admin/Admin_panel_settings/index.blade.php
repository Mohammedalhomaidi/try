@extends('Layouts.admin')

@section('title')
{{__('words.setting')}} 
@endsection

@section('contentheader')
{{__('words.set')}} 

@endsection

@section('contentheaderlink')
<a href="{{route('admin.adminsettings')}}">{{__('words.set')}} </a>
@endsection

@section('contentheaderactive')
عرض
@endsection



@section('content')
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header"dir="ltr">
              <h3 class="card_title_center"  > {{__('words.data')}} {{__('words.setting')}}  </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(@isset($data)&& !@empty($data))
                <table id="example2" class="table table-bordered table-hover">
    
                    <tr>
                    <td class="width30"> {{__('words.name')}} {{__('words.company')}} </td>
                    <td>{{$data['system_name']}}</td>
        
                    </tr>
                    <tr>
                        <td class="width30"> {{__('words.code')}} {{__('words.company')}}</td>
                        <td>{{$data['com_code']}}</td>
    
                        </tr>
                        <tr>
                            <td class="width30"> {{__('words.state')}} {{__('words.active')}}</td>
                            <td> @if ($data['active']==1)  {{__('words.actives')}}

                                @else   {{__('words.Notactive')}}
                            
                            @endif</td>
                            </tr>

                            <tr>
                                <td class="width30"> {{__('words.Address')}} {{__('words.company')}}</td>
                                <td>{{$data['address']}}</td>
                    
                                </tr>

                                <tr>
                                    <td class="width30">  {{__('words.phone')}} {{__('words.company')}}</td>
                                    <td>{{$data['phone']}}</td>
                        
                                    </tr>
                                    
                                <tr>
                                    <td class="width30"> {{__('words.Type_batch_in_system')}}</td>
                                    <td>
                                      @if($data['is_set_batches_setting']==1)
                                      @if($data['batches_setting_type']==1)
                                      {{__('words.batch_System_worke')}}
                                      @else
                                      {{__('words.batch_System_not_work')}}
                                      @endif
                                      @else
                                      {{__('words.not_select_batch')}}

                                      @endif
                                  
                        
                                    </tr>
                                    <tr>
                                    <td class="width30"> {{__('words.Type_unit_sales')}} </td>
                                    <td>
                                      @if($data['defualt_unit']==1)
                                      {{__('words.sale_unit_parent')}}    
                                      @else
                                      {{__('words.sale_unit_part')}}    
                                      @endif
                                 </tr>
                                      
                                    <tr>
                                        <td class="width30"> {{__('words.Massage')}} {{__('words.company')}}  </td>
                                        <td>{{$data['general_alert']}}</td>
                            
                                        </tr>

                                        <tr>
                                            <td class="width30">  {{__('words.logo')}} {{__('words.company')}}  </td>

                                            <td>
                                                <div class="image">
                                                
                                              
                                              <img   class="custom_img" src="{{asset('home/Admin/imgs').'/'.$data['photo']}}" alt="  الشركة شعار"  >  
                                               
                                      
                                                </div>
                                             </td>
                                        </tr>
                   <tr>                     
                                          
                      <td class="width30"> {{__('words.Edit_date')}}     </td>  
                                                     
                     <td>
                        @if ($data['updated_by']>0 and $data['updated_by']!=null)
                         @php  
                        $dt= new DateTime($data['update_at']);
                        $date=$dt->format("Y-m-d");
                        $time=$dt->format("h:i");
                        $newdate=date("A",strtotime($time));
                        $newdateType=(($newdate=='AM')?' صباحاَ ':' مساءَ  ');
                        @endphp 
               {{$date}}
               {{$time}}
               {{$newdateType}}
               {{__('words.Add_by')}} 
               {{$data['updated_by_admin']}}
                        @else
                        {{__('words.not_update')}} 
                                                     @endif
                       @if(check_permeission_sub_menues_action(34)==true)
                          <a href="{{route('admin.adminsettings.edit')}}" class="btn btn-sm btn-success"> {{__('words.Edit')}} </a>
                          @endif
                            </td>            
                                          
                 </tr>
                  </table>
                    
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