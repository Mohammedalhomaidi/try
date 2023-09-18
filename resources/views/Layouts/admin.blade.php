<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  @yield('css')
  <title>
    @yield('title')
  </title>
  <!-- Font Awesome Icons-->
  <link rel="stylesheet" href=" {{asset('home/Admin/plugins/fontawesome-free/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{asset('home/Admin/dist/css/adminlte.min.css')}}">  
  <!-- Google Font: Source Sans Pro  -->
  <link rel="stylesheet" href="{{asset('home/Admin/fonts/SansPro/SansPro.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/Admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/Admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css')}}">
  <link rel="stylesheet" href="{{asset('home/Admin/css/mycustomstyle.css')}}">
 
</head>
<body class="hold-transition sidebar-mini  ">
<div class="wrapper">

<input type="hidden" id="token_search" value="{{csrf_token() }}">
<input type="hidden" id="ajax_get_load_order_update_modal" value="{{ route('admin.SalesInvoices.load_modal_order_modal') }}">
<input type="hidden" id="ajax_url_ajax_check_name" value="{{ route('admin.itemcard.ajax_check_order') }}" >
<input type="hidden" id="get_item_batches_order" value="{{ route('admin.SalesInvoices.get_item_batches_order') }}">
<input type="hidden" id="ajax_DoApproveInvoiceFinally_order" value="{{ route('admin.SalesInvoices.DoApproveInvoiceFinally_order') }}">
<input type="hidden" id="ajax_show_index_sales" value="{{ route('admin.SalesInvoices.index') }}">

<!--start navbar-->
 @include('admin.includes.header')

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('Admin.includes.List')
 <!--  End  Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  @include('Admin.includes.content')
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
   @include('Admin.includes.footer')
</div>
<!-- ./wrapper -->

<!-- modal for the load order_customer at the employees SCRIPTS.................................................................. -->
<div class="modal fade  "   id="updateInvoiceModalActiveorder">
      <div class="modal-dialog modal-xl" >
         <div class="modal-content bg-info">
            <div class="modal-header">
               <h4 class="modal-title text-center">           فاتورة مبيعات عبر الويب </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="updateInvoiceModalActiveorderBody" style="background-color: white !important; color:black;">
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   <!--end modal for the load order_customer at the employees SCRIPTS.................................................................. -->

   </div> 
<!-- jQuery-->
<script src="{{asset('home/Admin/plugins/jquery/jquery.min.js')}}"></script> 
<!-- Bootstrap 4-->
<script src="{{asset('home/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> 
<!-- AdminLTE App -->
<script src="{{asset('home/Admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('home/Admin/js/js.js')}}"></script>

@yield('script')
@yield('css')
</body>
</html>
<!--

https://www.w3schools.com/icons/fontawesome5_icons_files.asp
https://fontawesome.com/v4/icons/#chart


-->