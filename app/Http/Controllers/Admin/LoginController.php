<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\Admin_panel_settings;
use App\Http\Requests\loginRequest;

class LoginController extends Controller
{
   public function show(){

    return view('Admin.Login.Login');
 }

 public function checklogin(loginRequest $request){
     if (auth()->guard('admin')->attempt(['username'=>$request->input('UserName'),
     'password'=>$request->input('password')])){
            return redirect()->route('admin.homepage');
       }else{
            return redirect()->route('admin.login')->with(['error'=>'عفواً بيانات تسجبل الدخول غير صحيحة']);
        }}

        
 public function logout(){
            auth()->logout();
            return redirect()->route('admin.login');
        }
// for customer login
    public function index(){

            return view('Admin.Login.LoginCustomer');
         }

    public function checklogin_for_customer(loginRequest $request){
            if (auth()->guard('web')->attempt(['Name_enter_system'=>$request->input('UserName'),
                'password'=>$request->input('password')])){
                 $Numbers_vist =  Admin_panel_settings::find(1);
                    if (!empty($Numbers_vist)) {
                        $Numbers_vist['Numbers_vist'] = $Numbers_vist['Numbers_vist'] + 1;
                    } else {
                      $Numbers_vist['Numbers_vist'] = 1;
                    }
                     $Numbers_vist->update();
                      //  update( new Admin_panel_settings ,$Numbers_vist,array('id'=>1));
                    
                    return redirect()->route('web.homepage');
                }else{
                    return redirect()->route('web.LoginCustomer')->with(['error'=>'عفواً بيانات تسجبل الدخول غير صحيحة']);
                }}    
    public function logoutCustomer(){
            auth()->logout();
            return redirect()->route('web.LoginCustomer');
        }
 

    }


/*
 function add_new_admin(){
     $admin=new App\Models\Admin();
      $admin->name='admin';
      $admin->email='admin';
      $admin->username='admin';
      $admin->password=bcrypt('admin');
      $admin->com_code=1;
      $admin->save();
 }*/