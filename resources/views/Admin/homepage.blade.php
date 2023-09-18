@extends('Layouts.admin')

@section('title')
{{__('words.HomePage')}}
@endsection

@section('contentheader')
{{__('words.HomePage')}}

@endsection

@section('contentheaderlink')
<a href="{{route('admin.homepage')}}">{{__('words.HomePage')}}</a>
@endsection

@section('contentheaderactive')
عرض
@endsection



@section('content')
    <!-- Info boxes -->
   
  <div class="row" style="padding:20px 5px 3px 1px;background-image:url({{ asset('home/Admin/imgs/1.jpg')}});background-size:cover ;background-repeate:ni-repeate; min-height:600px;">
  <br> <br> <br>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">المبيعات  </span>
                  <span class="info-box-number">
                    {{$order_data['Sales_invoices']}}
                    
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">طلب جديد </span>
                  <span class="info-box-number">{{$order_data['new']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">كل طلبات الويب</span>
                  <span class="info-box-number">{{$order_data['all']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">العملاء</span>
                  <span class="info-box-number">{{$order_data['Customer']}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->          
 </div>
@endsection