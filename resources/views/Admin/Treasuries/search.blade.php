
          @if (@isset($data) && !@empty($data) && count($data) >0 )
          @php
           $i=1;   
          @endphp
          <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
           <th>الرقم</th>
           <th>اسم الخزنة</th>
           <th>هل رئيسية</th>
           <th>اخر ايصال صرف</th>
           <th>اخر ايصال تحصيل</th>
           <th>حالة التفعيل</th>
           <th></th>
           
            </thead>
            <tbody>
         @foreach ($data as $info )
            <tr>
             <td>{{ $i }}</td>  
             <td>{{ $info->name }}</td>  
             <td>@if($info->is_mester==1) رئيسية @else فرعية @endif</td>  
             <td>{{ $info->last_isal_exchange }}</td>  
             <td>{{ $info->last_isal_collect }}</td>  
             <td>@if($info->active==1) مفعل @else معطل @endif</td>  
         <td>
        <a href="{{ route('admin.TreasuriesEdit',$info->id) }}" class="btn btn-sm  btn-primary">تعديل</a>   
        <button data-id="{{ $info->id }}" class="btn btn-sm  btn-info">المذيد</button>   
   
         </td>
           
   
           </tr> 
      @php
         $i++; 
      @endphp
         @endforeach
   
   
   
            </tbody>
             </table>
      <br>
 <div class="col-md-12" id="ajax_pagination_in_search">
    {{ $data->links() }}
 </div>

         
       
           @else
           <div class="alert alert-danger">
             عفوا لاتوجد بيانات لعرضها !!
           </div>
                 @endif
 @section('script')


 < script>
    
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

</script>
@endsection