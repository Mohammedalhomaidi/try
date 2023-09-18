<?php

namespace App\Http\Controllers\Admin;
use App\Models\Treasuries;
use App\Models\Admin;
use App\Models\Treasuries_delivery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TreasuriesRequests;
use App\Http\Requests\Addtreasuries_deliveryRequest;



class Treasuries_Controller extends Controller
{    public function show(){
    check_permeission_Redirection(18);

        $data=Treasuries::select()->orderby('id','Desc')->paginate(PAGINATION_count);
        if(!empty($data)){
            foreach( $data as $info ){
                $info->added_by=Admin::where('id',$info['added_by'])->value('name');

                if($info->updated_by>0 and $info->updated_by!=null){
                    $info->updated_by_admin=Admin::where('id',$info->updated_by)->value('name'); 
        }}}
        return view ('admin.Treasuries.TreasuriesPage',['data'=>$data]);
    }

     public  function create(){
        return view ('admin.Treasuries.create');
     }
 public function added(TreasuriesRequests $request){
          
         try{ $com_code=auth()->user()->com_code;
             $checkExist=Treasuries::where(['name'=>$request->name,'com_code'=>$com_code])->first();
            if($checkExist==null){
                if($request->is_mester==1){
                    $checkExists_isMaster=Treasuries::where(['is_mester'=>1,'com_code'=>$com_code])->first();
                    if($checkExists_isMaster!=null){
                    return redirect()->back()
                    ->with(['error'=>'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لايمكن ان يكون هناك اكثر من خزنة رئيسية'])
                    ->withInput(); }
                   }
                    $data['name']=$request->name;
                    $data['is_mester']=$request->is_mester;
                    $data['last_isal_exchange']=$request->last_isal_exchange;
                    $data['last_isal_collect']=$request->last_isal_collect;              
                    $data['created_at']=date("Y-m-d H:i:s");
                    $data['added_by']=auth()->user()->id;
                    $data['com_code']=$com_code;
                    $data['date']=date("Y-m-d");
                    $data['active']=$request->active;
                    Treasuries::create($data);
                    return redirect()->route('admin.TreasuriesPage')->with(['success'=>'لقد تم اضافة البيانات بنجاح']);
          }else{
                    return redirect()->back()
                    ->with(['error'=>'عفوا اسم الخزنة مسجل من قبل'])
                    ->withInput(); }


         }catch(\Exception $ex){
            return redirect()->back()
            ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
            ->withInput(); }
     }

     public function Edit($id){
         $data=Treasuries::select()->find($id);
         
       return  view('admin.Treasuries.edit',['data'=>$data]);
     }

     public function update($id,TreasuriesRequests $request){
        try{
        $com_code=auth()->user()->com_code;
        $data=Treasuries::select()->find($id);
        if(empty($data)){
        return redirect()->route('admin.TreasuriesPage')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
        }
        $checkExists=Treasuries::where(['name'=>$request->name,'com_code'=>$com_code])->where('id','!=',$id)->first();
        if( $checkExists!=null){
        return redirect()->back()
        ->with(['error'=>'عفوا اسم الخزنة مسجل من قبل'])
        ->withInput(); 
        }
        if($request->is_mester==1){
        $checkExists_isMaster=Treasuries::where(['is_mester'=>1,'com_code'=>$com_code])->where('id','!=',$id)->first();
        if($checkExists_isMaster!=null){
        return redirect()->back()
        ->with(['error'=>'عفوا هناك خزنة رئيسية بالفعل مسجلة من قبل لايمكن ان يكون هناك اكثر من خزنة رئيسية'])
        ->withInput(); 
        }
        }
        $data_to_update['name']=$request->name;
        $data_to_update['active']=$request->active;
        $data_to_update['is_mester']=$request->is_mester;
        $data_to_update['last_isal_exchange']=$request->last_isal_exchange;
        $data_to_update['last_isal_collect']=$request->last_isal_collect;
        $data_to_update['updated_by']=auth()->user()->id;
        $data_to_update['updated_at']=date("Y-m-d H:i:s");
        Treasuries::where(['id'=>$id,'com_code'=>$com_code])->update($data_to_update);
        return redirect()->route('admin.TreasuriesPage')->with(['success'=>'لقد تم تحديث البيانات بنجاح']);
        }
        catch(Exception $ex){
        return redirect()->back()
        ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
        ->withInput();           
        }
        }
        public function search(Request $request){
            if($request->ajax()){
            $search_by_text=$request->search_by_text;
            $data=Treasuries::where('name','LIKE',"%{$search_by_text}%")->orderBy('id','DESC')->paginate(PAGINATION_count);
            return view('admin.Treasuries.search',['data'=>$data]);
            }
            }
          public function Details($id){
             try{
                 $com_code=auth()->user()->com_code;
                 $data=Treasuries::select()->find($id);
                 if(empty($data)){
                    return redirect()->route('admin.TreasuriesPage')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
                    }
                    $data['added_by_admin']=Admin::where('id',$data['added_by'])->value('name');    
                    if($data['updated_by']>0 and $data['updated_by']!=null){
                             $data['updated_by_admin']=Admin::where('id',$data['updated_by'])->value('name');    
                        }
                            $treasuries_delivery=Treasuries_delivery::select()->where(['treasuries_id'=>$id])->orderby('id','DESC')->get(); 
                             if(!empty($treasuries_delivery)){
                                      foreach($treasuries_delivery as $info){
                                          $info->name=Treasuries::where('id',$info->treasuries_can_delivery_id)->value('name');    
                                            $info->added_by_admin=Admin::where('id',$info->added_by)->value('name');    
                                      }
                                    }
                   return   view('admin.Treasuries.Details',['data'=>$data,'treasuries_delivery'=>$treasuries_delivery]);
             
          }catch(\Exception $ex){
             return redirect()->back()
                ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
                    ->withInput();           
        }       }
        
public function Treasuries_Delivery_add($id){
    try{

 $com_code=auth()->user()->com_code;
 $data =Treasuries::select('id','name')->find($id);
    if(empty($data)){
        return redirect()->route('admin.TreasuriesPage')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
    }
    $Treasuries=Treasuries::select('id','name')->where(['com_code'=>$com_code,'active'=>1])->get();
    return view("admin.Treasuries.Add_treasuries_delivery",['data'=>$data,'Treasuries'=>$Treasuries]);
}
    catch(\Exception $ex){
    return redirect()->back()->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])->withInput();
}
}
public function Treasuries_Delivery_Store(Addtreasuries_deliveryRequest $request,$id){
    try{
         $com_code=auth()->user()->com_code;
         $Treasuries=new Treasuries();
         $data=Treasuries::select('id','name')->find($id);
          if(empty($data)){
            return redirect()->route('admin.TreasuriesPage')->with(['error'=>'عفوا غير قادر علي الوصول الي البيانات المطلوبة !!']);
                   }
         $checkExists=Treasuries_delivery::where(['treasuries_id'=>$id,'treasuries_can_delivery_id'=>$request->treasuries_can_delivery_id,'com_code'=>$com_code])->first();
             if($checkExists!=null){
                   return redirect()->back()
                   ->with(['error'=>'عفوا هذه الخزنة مسجلة من قبل !'])
                   ->withInput(); 
                   }
         $data_insert_details['treasuries_id']=$id;
         $data_insert_details['treasuries_can_delivery_id']=$request->treasuries_can_delivery_id;
         $data_insert_details['created_at']=date("Y-m-d H:i:s");
         $data_insert_details['added_by']=auth()->user()->id;
         $data_insert_details['com_code']=$com_code;
         Treasuries_delivery::create($data_insert_details);
                   return redirect()->route('admin.Treasuries.Details',$id)->with(['success'=>'لقد تم اضافة البيانات بنجاح']);

    
    }
    catch(\Exception $ex){
        return redirect()->back()
        ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()]);
        }
 } 

 public function delete_treasuries_delivery($id){
     try{
         $treasuries_delivery=Treasuries_delivery::find($id);
        if(!empty($treasuries_delivery)){
           $flag=$treasuries_delivery->delete();
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
}
            
    
