<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminReq;
use App\Http\Requests\AdminReqUpdate;
use App\Models\Treasuries;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Stores;
use App\Models\admins_stores;
use App\Models\permission_rols;
use App\Models\Admins_treasuries;
class AdminController extends Controller
{
public function index()
{ check_permeission_Redirection(56);
 $com_code = auth()->user()->com_code;
  $data = get_cols_where_p(new Admin(), array("*"), array("com_code" => $com_code), 'id', 'DESC', PAGINATION_count);
   if (!empty($data)) {
     foreach ($data as $info) {
       $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
       $info->permission_rols_name = permission_rols::where('id', $info->permission_rols_id)->value('name');
      if ($info->updated_by > 0 and $info->updated_by != null) {
       $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
}
}
}
$permission_rols=get_cols_where (new permission_rols(),array("id","name"),array("active"=>1,"com_code"=>$com_code ),'id',
  'ASC' );
return view('admin.admins_accounts.index', ['data' => $data,"permission_rols"=>$permission_rols]);
}
    
public function create(){
  $com_code = auth()->user()->com_code;
  $permission_rols=get_cols_where (new permission_rols(),array("id","name"),array("active"=>1,"com_code"=>$com_code ),'id',
  'ASC' );
  return view ('admin.admins_accounts.create',['permission_rols'=>$permission_rols]);

}

public function Store(AdminReq $request){
  try{
       $com_code=auth()->user()->com_code;
       
      $checkExist=Admin::where(['name'=>$request->name,'com_code'=>$com_code])->first();
      if($checkExist==null){
        $checkExist1=Admin::where(['username'=>$request->username,'com_code'=>$com_code])->first();
        if($checkExist1==null){
             $data['name']=$request->name;
             $data['username']=$request->username;
             $data['password']=bcrypt($request->password);
             $data['permission_rols_id']=$request->permission_rols_id;
             $data['com_code']=$com_code;
             $data['created_at']=date("Y-m-d H:i:s");
             $data['added_by']=auth()->user()->id;
             $data['date']=date("Y-m-d");
             $data['active']=$request->active;
             Admin::create($data);
             return redirect()->route('admin.admins_accounts.index')->with(['success'=>'لقد تم اضافة المستخدم بنجاح']);
            }else{
              return redirect()->back()
              ->with(['error'=>'عفوا اسم المستخدم لدخول للنظام  موجود من قبل'])
              ->withInput(); }  $admin->password=bcrypt('admin');
 
            }else{
             return redirect()->back()
             ->with(['error'=>'عفوا اسم المستخدم موجود من قبل'])
             ->withInput(); }
  
  }catch(\Exception $ex){
     return redirect()->back()
     ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
     ->withInput(); }
  }
       

  public function Edit($id){
      $com_code=auth()->user()->com_code;
      $data=admin::select()->find($id);
     $permission_rols=get_cols_where (new permission_rols(),array("id","name"),array("active"=>1,"com_code"=>$com_code ),'id','ASC');

    return  view('admin.admins_accounts.edit',['data'=>$data,'permission_rols'=>$permission_rols]);
  }
  
  public function update($id,AdminReqUpdate $request){
     try{
     $com_code=auth()->user()->com_code;
     $data=admin::select()->find($id);
     if(empty($data)){
     return redirect()->route('admin.admins_accounts.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
     }
     $checkExists=admin::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
     if( $checkExists==null){
      $checkExist1=Admin::where(['username'=>$request->username,'com_code'=>$com_code])->where('id','!=',$id)->first();
      if($checkExist1==null){
        $data_to_update['name']=$request->name;
        $data_to_update['username']=$request->username;

        if($request->checkforupdatepassword==1){
        $data_to_update['password']=bcrypt($request->password);
        }
        
        $data_to_update['permission_rols_id']=$request->permission_rols_id;
        $data_to_update['com_code']=$com_code;
        $data_to_update['updated_at']=date("Y-m-d H:i:s");
        $data_to_update['updated_by']=auth()->user()->id;
        $data_to_update['active']=$request->active;
      Admin::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
      return redirect()->route('admin.admins_accounts.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
    }else{
      return redirect()->back()
      ->with(['error'=>'عفوا اسم المستخدم لدخول للنظام  موجود من قبل'])
      ->withInput(); }  

    }else{
     return redirect()->back()
     ->with(['error'=>'عفوا اسم المستخدم موجود من قبل'])
     ->withInput(); }
    
  }catch(\Exception $ex){
     return redirect()->back()
     ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
     ->withInput();           
     }  }
 
  public function Details($id){
    try{
        $com_code=auth()->user()->com_code;
        $data=get_cols_where_row(new admin(),array("*"),array("com_code"=>$com_code,"id"=>$id));
        if(empty($data)){
           return redirect()->route('admin.admins_accounts.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
           }
           $data['added_by_admin']=Admin::where('id',$data['added_by'])->value('name');  
           $data['permission_rol_name']=permission_rols::where('id',$data['permission_rols_id'])->value('name');  
           if($data['updated_by']>0 and $data['updated_by']!=null){
              $data['updated_by_admin']=Admin::where('id',$data['updated_by'])->value('name');    
               }


    $Treasuries=get_cols_where(new Treasuries(),array("id","name"),array("com_code"=>$com_code,"active"=>1));
    $admins_treasuries  =get_cols_where(new admins_treasuries(),array("*"),array("com_code"=>$com_code,"admin_id"=>$id)); 
    if (!empty($admins_treasuries)) {
      foreach ($admins_treasuries as $inf) {
        $inf->added_by_admin = Admin::where('id', $inf->added_by)->value('name');
        $inf->treasuries_name = Treasuries::where('id', $inf->treasuries_id )->value('name');}} 

        $Stores=get_cols_where(new Stores(),array("id","name"),array("com_code"=>$com_code,"active"=>1));
        $admins_stores  =get_cols_where(new admins_stores(),array("*"),array("com_code"=>$com_code,"admin_id"=>$id));
        if (!empty($admins_stores)) {
          foreach ($admins_stores as $info) {
            $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
            $info->stores_name = Stores::where('id', $info->Store_id )->value('name');}}

          return   view('admin.admins_accounts.Details',['data'=>$data,"Stores"=>$Stores,"admins_stores"=>$admins_stores,"Treasuries"=>$Treasuries,"admins_treasuries"=>$admins_treasuries,]);
    
 }catch(\Exception $ex){
    return redirect()->back()
       ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
           ->withInput();           
}       }

    


public function Add_permission_main_menues($id,Request $request ){
  try{        $com_code=auth()->user()->com_code;

    $data=get_cols_where_row(new admin(),array("*"),array("com_code"=>$com_code,"id"=>$id));
    if(empty($data)){
       return  redirect()->back()->with(['error'=>'1 غير قادر علي الوصول الي البيانات المطلوبة !!']);
       }
 
       $Treasuries_id=$request->Treasuries_id;
       if(empty($Treasuries_id)){
           return  redirect()->back()->with(['error'=>'1 غير قادر علي الوصول الي البيانات المطلوبة !!']);
       }
    
  foreach($Treasuries_id as $info){
    $data_to_update['admin_id']=$id;
    $data_to_update['treasuries_id']=$info;            
    $data_to_update['created_at']=date("Y-m-d H:i:s");
    $data_to_update['added_by']=auth()->user()->id;
    $data_to_update['com_code']=$com_code;
    $data_to_update['date']=date("Y-m-d");
    $data_to_update['active']=1; }
    admins_treasuries::create($data_to_update);
    return redirect()->route('admin.admins_accounts.Details',['id'=>$id])->with(['success'=>'لقد تم اضافة البيانات بنجاح']);

  

}catch(\Exception $ex){
  return redirect()->back()
  ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
  ->withInput();           
  }  
}

public function Add_Stores($id,Request $request ){
  try{        $com_code=auth()->user()->com_code;

    $data=get_cols_where_row(new admin(),array("*"),array("com_code"=>$com_code,"id"=>$id));
    if(empty($data)){
       return  redirect()->back()->with(['error'=>'1 غير قادر علي الوصول الي البيانات المطلوبة !!']);
       }
 
       $Stores_id=$request->Stores_id;
       if(empty($Stores_id)){
           return  redirect()->back()->with(['error'=>'1 غير قادر علي الوصول الي البيانات المطلوبة !!']);
       }
    
  foreach($Stores_id as $info){
    $data_to_update['admin_id']=$id;
    $data_to_update['Store_id']=$info;            
    $data_to_update['created_at']=date("Y-m-d H:i:s");
    $data_to_update['added_by']=auth()->user()->id;
    $data_to_update['com_code']=$com_code;
    $data_to_update['date']=date("Y-m-d");
    $data_to_update['active']=1; }
    admins_stores::create($data_to_update);
    return redirect()->route('admin.admins_accounts.Details',['id'=>$id])->with(['success'=>'لقد تم اضافة البيانات بنجاح']);

  

}catch(\Exception $ex){
  return redirect()->back()
  ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
  ->withInput();           
  }  
}
public function treasuries_delete($id){
  try{        $com_code=auth()->user()->com_code;

    $admins_treasuries=get_cols_where_row(new admins_treasuries(),array("*"),array("com_code"=>$com_code,"id"=>$id));
     if(!empty($admins_treasuries)){
        $flag=$admins_treasuries->delete();
        if($flag){
          return redirect()->back()
         ->with(['success'=>'   تم حذف البيانات بنجاح']);
     }else{
          return redirect()->back()
              ->with(['error'=>'عفوا حدث خطأ ما']);
          }
 }else{
        return redirect()->back()
         ->with(['error'=>'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
 }

 }catch(\Exception $ex){
 return redirect()->back()
 ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()]);
 }
 }
 public function admins_store_delete($id){    
      $com_code=auth()->user()->com_code;
  try{    $admins_treasuries=get_cols_where_row(new admins_stores(),array("*"),array("com_code"=>$com_code,"id"=>$id));
     if(!empty($admins_treasuries)){
        $flag=$admins_treasuries->delete();
        if($flag){
          return redirect()->back()
         ->with(['success'=>'   تم حذف البيانات بنجاح']);
     }else{
          return redirect()->back()
              ->with(['error'=>'عفوا حدث خطأ ما']);
          }
 }else{
        return redirect()->back()
         ->with(['error'=>'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
 }

 }catch(\Exception $ex){
 return redirect()->back()
 ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()]);
 }
 }

 public function ajax_search(Request $request){
  if($request->ajax()){
  $search_by_text=$request->search_by_text;
  $permission_rols_id_search=$request->permission_rols_id_search;
  if($search_by_text==''){
  $field1="id";
  $operator1=">";
  $value1=0;
  }else{
  $field1="name";
  $operator1="LIKE";
  $value1="%{$search_by_text}%";
  }
  if($permission_rols_id_search=='all'){
  $field2="id";
  $operator2=">";
  $value2=0;
  }else{
  $field2="permission_rols_id";
  $operator2="=";
  $value2=$permission_rols_id_search;
  }
  $data=Admin::where($field1,$operator1, $value1)->where($field2,$operator2,$value2)->orderBy('id','DESC')->paginate(PAGINATION_count);
  if (!empty($data)) {
    foreach ($data as $info) {
      $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
      $info->permission_rols_name = permission_rols::where('id', $info->permission_rols_id)->value('name');
     if ($info->updated_by > 0 and $info->updated_by != null) {
      $info->updated_by_admin = Admin::where('id', $info->updated_by)->value('name');
 
}
}
}
  return view('Admin.admins_accounts.ajax_search',['data'=>$data]);
  }
  }
  
}