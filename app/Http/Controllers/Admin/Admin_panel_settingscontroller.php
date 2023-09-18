<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin_panel_settings;
use App\Http\Requests\Admin_panel_settings_Request;


class Admin_panel_settingscontroller extends Controller
{    public function show(){
          check_permeission_Redirection(35);
   
        $data=Admin_panel_settings::where('com_code',auth()->user()->com_code)->first();
        if(!empty($data)){
            if($data['updated_by']>0 and $data['updated_by']!=null){
                $data['updated_by_admin']=Admin::where('id',$data['updated_by'])->value('name');
        }}
        return view('Admin.Admin_panel_settings.index',['data'=>$data]);
    }

    public function edit(){
        $data=Admin_panel_settings::where('com_code',auth()->user()->com_code)->first();
        return view ('Admin.Admin_panel_settings.edit',['data'=>$data]);
    }


    public function updated(Admin_panel_settings_Request $request){
        try{  $admin_panel_setting=Admin_panel_settings::where('com_code',auth()->user()->com_code)->first();
            $admin_panel_setting->system_name = $request->system_name;
            $admin_panel_setting->address = $request->address;
            $admin_panel_setting->phone = $request->phone;
            $admin_panel_setting->general_alert = $request->general_alert;   
            $admin_panel_setting->defualt_unit = $request->defualt_unit;   


          
            if($admin_panel_setting['is_set_batches_setting']==0){
                if(isset($request->batches_setting_type))
                $admin_panel_setting->is_set_batches_setting=1;
                $admin_panel_setting->batches_setting_type=$request->batches_setting_type;
            } 
            
            $admin_panel_setting->updated_by = auth()->user()->id;
            $admin_panel_setting->updated_at =date("Y-m-d H:i:s");
           $oldphotoPath = $admin_panel_setting->photo;
            if ($request->has('photo')) {
            $request->validate([
            'photo'=>'required|mimes:png,jpg,jpeg|max:2000',
            ]);
            $the_file_path = uploade('home/Admin/imgs', $request->photo);
            $admin_panel_setting->photo = $the_file_path;
            if (file_exists('home/Admin/imgs/' . $oldphotoPath) and !empty($oldphotoPath)) {
            unlink('home/Admin/imgs/' . $oldphotoPath);
            }
            }
        $admin_panel_setting->save();
       // return redirect()->route('admin.adminsettings')->with(['success'=>'تم التحديث البيانات بنجاح ']);
        return redirect()->route('admin.adminsettings')->with(['success'=>'تم التحديث البيانات بنجاح ']);
        
        } catch( \Exception $ex){
            return redirect()->route('admin.adminsettings')->with(['error'=>'عفوا حدث خطاء'.$ex->getMessage()]);
        }

        
    }
  
}

