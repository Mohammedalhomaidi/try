
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
    @if(check_for_user_login(auth()->user()->id)==true)
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
         <a href="{{route('admin.homepage')}}" class="nav-link">{{__('words.HomePage')}}</a>
      </li>
     
     
      <li class="nav-item d-none d-sm-inline-block">
      
      <a href="{{route('admin.logout')}}" class="nav-link"> {{__('words.Sing out')}}</a>
      @else
      <div class="col-auto d-flex align-items-center">

                        <div class="header-event">
                                <button class="main-menu-event dropdown-toggle" data-bs-toggle="dropdown">
                              
                                    <i class="fas fa-user fa-lg "></i> </button>
                           
                                <ul class="mainmenu-nav dropdown-menu">
                                    <li class="menu-items">
                                    <a    class="load_order_update_modal" href="{{ route('admin.count_customer') }}" >
                                    <span class="float-left text-muted text-center">{{__('words.MyAccount')}} </span>

                                    <i class="fas fa-user mr-2"></i>
                                            </a>
                                    </li>
                                    <li class="menu-items">
                                        <a href="#">{{__('words.Help')}}   
                                        </a>
                                      
                                    </li>
                                   
                                    <li class="menu-items">
                                  
                                    </li>
                                    <li class="menu-items">
                                        <a href="{{route('admin.logout')}}">{{__('words.Sing out')}}
                                            
                                        </a>
                                       
                                    </li>
                                   

                                </ul>


                            <!-- menu ends  -->
                        </div>
                        {{auth()->user()->name}}
                </div>
      <a href="{{route('web.homepage')}}" class="nav-link">{{__('words.HomePage')}}</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      @if(auth()->user()->id==1)
          <a href="{{route('admin.for_change_page')}}" class="nav-link">الرجوع لنظام</a>
      @else                                   
          <a href="{{route('web.logout')}}" class="nav-link"> {{__('words.Sing out')}}</a>
      @endif
      @endif
      </li>
      
    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
      <a  data-autoserial="{{(auth()->user()->id)}}"  class="nav-link load_order_details_modal">
      <i class="fas fa-cart-plus fa-lg mr-2">

          </i>
        <!--  <span class="badge badge-danger navbar-badge"></span> -->
         </a> 

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
          
          </a>
          
          
      </li>
      <!-- Notifications Dropdown Menu -->
      @if(check_for_user_login(auth()->user()->id)==true)
      <li class="nav-item dropdown" >
        <a class="nav-link" data-toggle="dropdown"  >
          <i class="fas fa-bell fa-lg mr2"></i>
          @php $i=count(check_for_show_order())@endphp

          <span class="badge badge-warning navbar-badge" >  {{$i}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"style="overflow:auto;  height: 1500%;" >
        @php $i=0; @endphp
          @foreach(check_for_show_order() as $info )
          @php $i++; @endphp
       
          <div class="dropdown-divider"></div>
          <a  data-autoserial="{{ $info->id }}"  class="load_order_update_modal">
            <i class="fas fa-envelope mr-2"></i>{{$i}}
            <input type="hidden" value="{{$info->age_order}}" class="date">
            <span class="float-right text-muted text-sm"id="mm">{{$info->age_order}} </span>
          </a>
           <span class="dropdown-header">{{$info->name_Customer}}</span>
          
          @endforeach 
          <div class="dropdown-divider"></div>
      </li>
      @endif
      <li class="nav-item">  
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="far fa-comments"></i>
          </a>
      </li>
      
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
      <form action="#" method="post" >
    @csrf
   
      <input type="hidden" class="form-control" name="UserName" value="admin"  >
 
   
      <input type="hidden" class="form-control"  name="password" value="adminuser123456789">
     
    @error('password')
    <span class="text-danger">{{$message}}</span>
    @enderror


      <!-- /.col -->
      @if(check_for_user_login(auth()->user()->id)==true)
        <button  style="border:0px;background: transparent;font-size:18px;   font-weight: 600;"> صفحة الويب</button>
      <!-- /.col -->
    @endif

</form>      </li>
    </ul>

  </nav>
  @section("script")

<script  >

   

  $(document).on('click', '.badge', function (e) {

var date = $(".date").val();
    date.getHours();
    alert(date + "حدث خطاما");
    $("#mm").text(mmmmmm);}); </script>

@endsection
 
