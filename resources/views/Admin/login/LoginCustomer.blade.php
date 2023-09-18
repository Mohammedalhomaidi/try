<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>تسجيل الدخول </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{asset('home/Admin/plugins/fontawesome-free/all.min.css')}}">

  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('home/admin/fonts/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('home/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('home/admin/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('home/Admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/Admin/css/bootstrap_rtl-v4.2.1/custom_rtl.css')}}">
  <link href="{{asset('home/admin/fonts/SansPro/SansPro.min.css')}}" rel="stylesheet">
</head>

<body class="hold-transition login-page">
<div class="row" style="padding:30px;background-image:url({{ asset('home/Admin/imgs/lo.jpg')}});background-size:cover;background-repeate:ni-repeate; min-height:600px;">
 <div class="login-box">
   <!-- /.login-logo -->
   <div class="card">
     <div class="card-body login-card-body">
      @if(Session::has('error'))
      <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
      </div>
      @endif
      <p class="login-box-msg">تسجيل الدخول </p>
      <form action="{{route('web.login')}}" method="post" >
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="UserName" placeholder="الاسم المستخدم"  dir="rtl">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('UserName')
        <span class="text-danger">{{$message}}</span>
        @enderror

        <div class="input-group mb-3">
          <input type="password" class="form-control"  name="password" placeholder="كلمة السر" dir="rtl">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror

        <div class="row">

          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat"> دخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     </div>
     </div>
     <!-- /.login-card-body -->
  
 </div>
<!-- /.login-box -->
</div>
<!-- jQuery -->
<script src="{{asset('home/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('home/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>


