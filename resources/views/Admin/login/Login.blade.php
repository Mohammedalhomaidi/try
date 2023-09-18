


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

    <style>
        body {
            text-align: center;
            align-content: center;
            padding-top: 20%;

            font-family: Arial, Helvetica, sans-serif;
        }

        /* Full-width input fields */
       

        /* Set a style for all buttons */
        .b {
            background: linear-gradient(to right, #062952, #062952, #062952);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
           
            border-radius: 50%;

        }
        body h2{
          padding-top: 18%;
        }

        .b:hover {
            opacity: 1.8;
            width: 90%;
            
            border-radius: 10%;
            z-index: 2;
            -webkit-tranistion: width 5s;
        }

        /* Extra styles for the cancel button */
      
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            padding-top: 60px;
            border-radius: 5%;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto;
            padding: 5% 5% 5% 5%;
            /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 50%;
            border-radius: 15%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
          
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body style="padding:30px;background-image:url({{ asset('home/Admin/imgs/lo.jpg')}});background-size:cover;background-repeate:ni-repeate; min-height:600px;">

    <h2>مرحبا بكم في المتميز سوفت</h2>

    <button class='b' onclick="document.getElementById('id01').style.display='block'" style="width:auto;">تسجيل الدخول</button>

    <div id="id01" style="padding:30px;background-image:url({{ asset('home/Admin/upload/1676267370926.png')}}))
     ;background-size:cover;background-repeate:ni-repeate; min-height:600px;" class="modal">
    
        <form class="modal-content animate" action="{{route('admin.login')}}" method="post">
        <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
               
            </div>
        @if(Session::has('error'))
      <div class="alert alert-danger" role="alert">
        {{Session::get('error')}}
    </div>
       @endif
       
       <p class="login-box-msg">تسجيل الدخول </p>
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

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>




    <form  method="post" >
      

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>
<!-- jQuery -->
<script src="{{asset('home/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('home/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>
