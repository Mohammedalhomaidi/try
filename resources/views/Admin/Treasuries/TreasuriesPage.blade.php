@extends('Layouts.admin')

@section('title')
الضبط العام 
@endsection

@section('contentheader')
الصندوق
@endsection

@section('contentheaderlink')
<a href="{{route('admin.TreasuriesPage')}}">الصندوق</a>
@endsection

@section('contentheaderactive')
عرض
@endsection



@section('content')
<div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header"dir="ltr">
              <h3 class="card_title_center"  >بيانات  الصندوق</h3>

              <input type="hidden" id="token_search" value="{{csrf_token() }}">
           <input type="hidden" id="ajax_search_url" value="{{ route('admin.Treasuries.search') }}">

              <a href="{{route('admin.Treasuriescreate') }}" class="btn btn-sm btn-success">اضافة جديد</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="col-md-4">
                <input typt='text' id="search_by_text"  placeholder="البحث هنا عن الحسابات  " class="form-control"><br>

              </div> 
              <div id="seach"> 
                @if(@isset($data)&& !@empty($data))
                @php
                $i=1;
                @endphp
               
                  <table id="example2" class="table table-bordered table-hover">
                    <thead class="thead  bg-primary">
                     <th>الرقم</th>
                     <th>الاسم</th>
                     <th>هل رئيسية</th>
                     <th>اخر ايصال صرف </th>
                     <th>اخرايصال تحصيل </th>
                     <!--<th>تاريخ الاضافة </th>-->
                     <th>حالة التفعيل </th>
                     <th>التحكم</th>
    
                    </thead>
                    <tbody id="search">
               <!--               <label>SEARCH:</label><input id="myInput" type="text" placeholder="Search..">
 <tbody id="myTable">  -->
              
                    @foreach ($data as $info )
                    <tr>
                      <td>{{$i}} </td>
                    <td> {{$info->name}}</td>
                      <td>@if($info->is_mester==1) الرئيسية @else فرعية  @endif</td>
                      <td> {{$info->last_isal_exchange}}</td>
                      <td>{{$info->last_isal_collect}} </td>
                      <td>@if($info->active==1) مفعل  @else معطل   @endif </td>
                    
                    <td>  <a href="{{route('admin.TreasuriesEdit',$info->id)}}" class="btn btn-sm btn-success">التعديل</a>
         <a href="{{route ('admin.Treasuries.Details',$info->id)}}"class="btn btn-sm btn-info">التفاصيل</a>
              
              </td>
                    </tr>
                      @php
                        $i++;
                      @endphp
                    @endforeach
                  </tbody>
                      </table>

                </div>
              
                  <br>
                  {{$data->links()}}
                    
              @else
           <div class="alert alert-danger">
               عفوا لا يوجد بيانات لعرضها  !
         

          </div>
          @endif
       </div>
    </div>
        </div>
      
        
</div>
@endsection
@section('script')
<script src="{{ asset('home/admin/js/treasuries.js') }}"></script>
<script>
    
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  
  </script>
@endsection