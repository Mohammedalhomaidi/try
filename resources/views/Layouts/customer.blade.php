
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('css')
    <title>
        @yield('title')
    </title>

    <!-- external links -->
    <link rel="stylesheet" href="{{asset('home/Admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">

    <!-- for animation  -->
    <link rel="stylesheet" href="{{asset('home/Admin/css/bootstrap_rtl-v4.2.1/animate.css')}}">
    <!-- for slider  -->
    <link rel="stylesheet" href="{{asset('home/Admin/css/bootstrap_rtl-v4.2.1/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('home/Admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('home/Admin/css/mycustomstyle.css')}}">

    <!-- Font Awesome Icons  -->
    <link rel="stylesheet" href=" {{asset('home/Admin/plugins/fontawesome-free/all.min.css')}}">
    <link rel="stylesheet" href=" {{asset('home/Admin/plugins/fontawesome-free/material-icons.css')}}">
    <!-- Theme style -->
  <!-- Google Font: Source Sans Pro -->
  
    <!-- Theme style -->
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper ">
    <input type="hidden" id="token_search" value="{{csrf_token() }}">

    <input type="hidden" id="ajax_load_order_details_modal" value="{{ route('admin.itemcard_for_web.load_orders_modal') }}">
    <input type="hidden" id="ajax_get_load_order_update_modal" value="{{ route('admin.itemcard_for_web.load_order_update_modal') }}">
    <input type="hidden" id="ajax_get_load_order_update" value="{{ route('admin.itemcard_for_web.update_order') }}">
    <input type="hidden" id="ajax_get_remove_active_row_item" value="{{ route('admin.itemcard_for_web.remove_active_row_item') }}">
    <input type="hidden" id="ajax_get_load_invoice_update_modal" value="{{ route('admin.SalesInvoices.load_invoice_update_modal') }}">
    <input type="hidden" id="ajax_get_load_modal_addActiveInvoice" value="{{ route('admin.itemcard_for_web.load_modal_addoroder') }}">
    <input type="hidden" id="addActiveorder" value="{{ route('admin.itemcard_for_web.Add_custmoer_order') }}">
    <input type="hidden" id="ajax_get_send_order" value="{{ route('admin.itemcard_for_web.send_order') }}">
    <input type="hidden" id="ajax_url_ajax_check_name" value="{{ route('admin.itemcard.ajax_check_order') }}" >
         <!--start navbar-->
         <div dir="rtl">
 @include('admin.includes.header ')
 <!--<marquee scrolldelay=100 scrollamount=100 loop=-1  height=100PX WIDTH=100%>
          <span class="badge badge-warning navbar-badge" style="width:100% "> </span>
    </marquee >-->
<!-- /.navbar -->
  <!-- Main Sidebar Container -->
  </div>
 <!--  End  Main Sidebar Container -->
        <!-- Content Wrapper. Contains page content -->
        @include('Admin.includes.content_website')
        <!-- /.content-wrapper -->
        <div class="modal fade  "   id="InvoiceModalActiveDetails" dir="rtl">
      <div class="modal-dialog modal-xl"  >
         <div class="modal-content bg-info">
            <div class="modal-header">
               <h4 class="modal-title text-center">  تفاصيل اخر  طلب  </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="InvoiceModalActiveDetailsBody" style="background-color: white !important; color:black;">
            </div>
            <div class="modal-footer justify-content-between">
        
               <button type="button" class="btn mmmmmm btn-outline-light" data-dismiss="modal">اغلاق</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>

   <div class="modal fade  "   id="AddNewInvoiceModalActiveInvoice" dir="rtl">
      <div class="modal-dialog modal-xl"  >
         <div class="modal-content bg-info">
            <div class="modal-header">
            <h4 class="modal-title text-center">          اضافة لسلة  المشتريات  </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="AddNewInvoiceModalActiveInvoiceBody" style="background-color: white !important; color:black;">
            </div>
            <div class="modal-footer justify-content-between">
        
               <button type="button" class="btn close btn-outline-light" data-dismiss="modal">اغلاق</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>

<!--................................................................................................-->

   
<div class="modal fade  "   id="updateInvoiceModalActiveInvoice" dir="rtl">
      <div class="modal-dialog modal-xl" >
         <div class="modal-content bg-info">
            <div class="modal-header">
               <h4 class="modal-title text-center">   تحديث الطلب   </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="updateInvoiceModalActiveInvoiceBody" style="background-color: white !important; color:black;">
            </div>
            <div class="modal-footer justify-content-between">

               <button type="button" class="btn btn-outline-light close" data-dismiss="modal">اغلاق</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
   
        <!-- Main Footer -->
        <footer class="footer-section footer-section-style-1 section-top-gap-120" >
            <div class="box-wrapper">
                <div class="footer-wrapper section-fluid-270">
                    <div class="container-fluid">

                        <div class="footer-top">
                            <div class="footer-top-left">
                                <div class="footer-contact-items">
                                    <a href="tel:+91-9898989898" class="icon-left">
                                        <img src="{{asset('home/Admin/imgs/icons/icon-ios-call-dark.svg')}}" alt=""
                                            class="icon-svg">
                                        715 142 922
                                    </a>
                                    <a href="mailto:shopping@gmail.com" class="icon-left">
                                        <img src="{{asset('home/Admin/imgs/icons/icon-mail-open-dark.svg')}}" alt=""
                                            class="icon-svg">
                                        shopping@gmail.com
                                    </a>
                                </div>
                            </div>
                            <div class="footer-top-right">
                                <div class="footer-social">
                                    <a href="#">
                                        <img src="{{asset('home/Admin/imgs/icons/icon-facebook-f-dark.svg')}}" alt=""
                                            class="icon-svg">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('home/Admin/imgs/icons/icon-dribbble-dark.svg')}}" alt=""
                                            class="icon-svg">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('home/Admin/imgs/icons/icon-pinterest-p-dark.svg')}}" alt=""
                                            class="icon-svg">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('home/Admin/imgs/icons/icon-twitter-dark.svg')}}" alt=""
                                            class="icon-svg">
                                    </a>
                                </div>
                            </div>
                        </div>



                        <div class="footer-bottom">
                            <p class="copyright-text copyright-text--light">&copy; 2021. Made with <span
                                    class="material-icons">favorite</span> by <a href="#">Techie Coder</a></p>
                            <a href="#" class="payment-logo">
                                <img src="{{asset('home/Admin/imgs/icons/icon-twitter-dark.svg')}} " alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll To button -->
        <div id="scroll-to-top" aria-label="Scroll to top" class="scroll-to-top"><span
     class="btn btn-primary back-to-top"> <i class="fas fa-chevron-up"></i></span></div>

        </a>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('home/Admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 
    <script src="{{asset('home/Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
    <script src="{{asset('home/Admin/dist/js/bootstrap.bundle.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{asset('home/Admin/dist/js/modernizr-3.11.2.min.js')}}"></script>
    <script src="{{asset('home/Admin/dist/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('home/Admin/dist/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('home/Admin/dist/js/jquery.nice-select.js')}}"></script>
    <script src="{{asset('home/Admin/dist/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('home/Admin/js/js.js')}}"></script>
      <script>
  //Initialize Select2 Elements
  $(document).on('click', '.mmmmmm', function(e) {
    
    
    $("#InvoiceModalActiveDetailsBody").html("");
       $("#InvoiceModalActiveDetails").modal("hide");

});
$(document).on('click', '.close', function(e) {
     
    
    $("#updateInvoiceModalActiveInvoiceBody").html("");
       $("#updateInvoiceModalActiveInvoice").modal("hide");
       
       $("#AddNewInvoiceModalActiveInvoiceBody").html("");
       $("#AddNewInvoiceModalActiveInvoice").modal("hide");
        
});
 
  </script> 

    @yield('script')
    @yield('css')
</body>

</html>