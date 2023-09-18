<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stores;
use App\Models\Admin;
use App\Http\Requests\StoresRequest;

class Store_Controller extends Controller
{
    public function index(){
        check_permeission_Redirection(96);
        $data=Stores::select()->orderby('id','Desc')->paginate(PAGINATION_count);
        if(!empty($data)){
            foreach( $data as $info ){
                $info->added_by=Admin::where('id',$info['added_by'])->value('name');
    
                if($info->updated_by>0 and $info->updated_by!=null){
                    $info->updated_by_admin=Admin::where('id',$info->updated_by)->value('name'); 
        }}}
        return view ('admin.Stores.index',['data'=>$data]);
    }
    
public function create(){
    return view ('admin.Stores.create');
   

 }

public function storesadd(StoresRequest $request){
try{
     $com_code=auth()->user()->com_code;
     
    $checkExist=Stores::where(['name'=>$request->name,'com_code'=>$com_code])->first();
    if($checkExist==null){
           $data['name']=$request->name;
           $data['phones']=$request->phones;
           $data['address']=$request->address;
           $data['com_code']=$com_code;
           $data['created_at']=date("Y-m-d H:i:s");
           $data['added_by']=auth()->user()->id;
           $data['date']=date("Y-m-d");
           $data['active']=$request->active;
           Stores::create($data);
           return redirect()->route('admin.stores.index')->with(['success'=>'لقد تم اضافة الفئة بنجاح']);
 }else{
           return redirect()->back()
           ->with(['error'=>'عفوا اسم الفئة موجود من قبل'])
           ->withInput(); }


}catch(\Exception $ex){
   return redirect()->back()
   ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
   ->withInput(); }
}
     
public function Edit($id){
    $data=Stores::select()->find($id);
    
  return  view('admin.Stores.edit',['data'=>$data]);
}

public function update($id,StoresRequest $request){
   try{
   $com_code=auth()->user()->com_code;
   $data=Stores::select()->find($id);
   if(empty($data)){
   return redirect()->route('admin.stores.index')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
   }
   $checkExists=Stores::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
   if( $checkExists==null){
    $data_to_update['name']=$request->name;
    $data_to_update['phones']=$request->phones;
    $data_to_update['address']=$request->address;
    $data_to_update['active']=$request->active;
    $data_to_update['updated_by']=auth()->user()->id;
    $data_to_update['updated_at']=date("Y-m-d H:i:s");
    Stores::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
    return redirect()->route('admin.stores.index')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
    }else{
    
   return redirect()->back()
   ->with(['error'=>'عفوا اسم الفئة مسجلة من قبل'])
   ->withInput(); 
   }
  
}catch(\Exception $ex){
   return redirect()->back()
   ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
   ->withInput();           
   }  }

}
