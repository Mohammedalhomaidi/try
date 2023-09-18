<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins_Shifts;
use App\Models\Admin;
use App\Models\Treasuries;
use App\Models\Mov_type;
use App\Models\Admin_panel_settings;
use App\Models\Treasuries_transactions;
use App\Models\Admins_treasuries;
use App\Models\Treasuries_delivery;
use App\Http\Requests\AdminShiftsRequest;

class Admins_ShiftsContoller extends Controller
{
public function index()
{
  $com_code = auth()->user()->com_code;
  $data = get_cols_where_p(new Admins_Shifts(), array("*"), array("com_code" => $com_code), 'id', 'DESC', PAGINATION_count);
    if (!empty($data)) {
       foreach ($data as $info) {
        $info->admin_name = Admin::where('id', $info->admin_id)->value('name');
        $info->treasuries_name = Treasuries::where('id', $info->treasuries_id)->value('name');
}}
    $checkExistsOpenShift=get_cols_where_row(new Admins_Shifts(),array("id","treasuries_id"),array("com_code"=>$com_code,"admin_id"=>auth()->user()->id,"is_finished"=>0));
   if(!empty($data)){
    foreach ($data as $info){
      $info['admin_name'] = Admin::where('id', $info['admin_id'])->value('name');
      $info['treasuries_name'] = Treasuries::where('id', $info->treasuries_id)->value('name');
     if($info->is_finished==1 and $info->is_delivered_and_review==0 and !empty($checkExistsOpenShift)){
        $check_permission_treasuries_delivery=get_cols_where_row(new Treasuries_delivery(),array("id"),array("com_code"=>$com_code,"treasuries_id"=>$checkExistsOpenShift['treasuries_id'],"treasuries_can_delivery_id"=>$info['treasuries_id']));
         if(!empty($check_permission_treasuries_delivery)){
              $info->can_review=true;
         }else{              $info->can_review=false;
         }
     }

    }
   }
    return view('admin.admins_shifts.index', ['data' => $data,'checkExistsOpenShift'=>$checkExistsOpenShift]);
}

public function create()
{
  $com_code = auth()->user()->com_code;    
   $admins_treasuries=get_cols_where(new Admins_treasuries(),array('treasuries_id'),array('com_code'=>$com_code,'active'=>1,'admin_id'=>auth()->user()->id),'id','DESC');     
    if (!empty($admins_treasuries)) {
      foreach ($admins_treasuries as $info) {
        $info->treasuries_name = Treasuries::where('id', $info->treasuries_id)->value('name');
       $check_exsits_admins_shifts=get_cols_where_row(new Admins_Shifts(),array("id"),
       array("treasuries_id"=>$info->treasuries_id,'com_code'=>$com_code,'is_finished'=>0));
      if(!empty($check_exsits_admins_shifts) and $check_exsits_admins_shifts!=null){
         $info->avaliable=false;
}else{
$info->avaliable=true;
}
}
}
return view('admin.admins_shifts.create',['admins_treasuries'=>$admins_treasuries]);
}

public function store(AdminShiftsRequest $request){
try{
    $com_code=auth()->user()->com_code;
    $admin_id=auth()->user()->id;
//check if not exsits open shift to current user
   $checkExistsOpenShift=get_cols_where_row(new Admins_Shifts(),array("id"),array("com_code"=>$com_code,"admin_id"=>$admin_id,"is_finished"=>0));
    if($checkExistsOpenShift!=null and !empty($checkExistsOpenShift)){
          return redirect()->route('admin.admin_shift.index')->with(['error'=>'عفوا هناك شفت مفتوح لديك بالفعل حاليا ولايمكن فتح شفت جديد الا بعد اغلاق الشفت الحالي']);
}
//check if not exsits open shift to current treasuries_id
    $checkExistsOpentreasuries=get_cols_where_row(new Admins_Shifts(),array("id"),array("com_code"=>$com_code,"treasuries_id"=>$request->treasuries_id,"is_finished"=>0));
    if($checkExistsOpentreasuries!=null and !empty($checkExistsOpentreasuries)){
           return redirect()->route('admin.admin_shift.index')->with(['error'=>'  عفوا الخزنة المختاره بالفعل مستخدمه حاليا لدي شفت اخر ولايمكن استخدامها الا بعد انتهاء الشفت الاخر']);
}
//set Shift code
   $row = get_cols_where_row_orderby(new Admins_Shifts(), array("shift_code"), array("com_code" => $com_code), 'id', 'DESC');
     if (!empty($row)) {
         $data_insert['shift_code'] = $row['shift_code'] + 1;
} else {
        $data_insert['shift_code'] = 1;
}
  $data_insert['admin_id']=$admin_id;
  $data_insert['treasuries_id']=$request->treasuries_id;
  $data_insert['start_date']=date("Y-m-d H:i:s");
  $data_insert['created_at']=date("Y-m-d H:i:s");
  $data_insert['added_by']=auth()->user()->id;
  $data_insert['com_code']=$com_code;
  $data_insert['date']=date("Y-m-d");
  $flag=insert(new Admins_Shifts(),$data_insert);
if($flag){
     return redirect()->route('admin.admin_shift.index')->with(['success'=>'لقد تم اضافة البيانات بنجاح']);
}else{
     return redirect()->route('admin.admin_shift.index')->with(['error'=>'عفوا لقد حدث خطأ ما من فضلك حاول مرة اخري']);
}
}catch(\Exception $ex){
    return redirect()->back()
         ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
         ->withInput();           
}
} 


public function finish($shift_id){
  try{
      $com_code=auth()->user()->com_code;
      $admin_id=auth()->user()->id;
  //check if not exsits open shift to current user
     $checkExistsShift=get_cols_where_row(new Admins_Shifts(),array("id","shift_code"),array("com_code"=>$com_code,"admin_id"=>$admin_id,"is_finished"=>0,"id"=>$shift_id));
      if($checkExistsShift!=null and empty($checkExistsShift)){
            return redirect()->route('admin.admin_shift.index')->with(['error'=>'عفوا غير قادر على الوصول الي البيانات !']);
  }
   $data_insert['money_should_deviled'] = get_sum_where(new Treasuries_transactions(), "money", array("com_code" => $com_code, "shift_code" => $checkExistsShift['shift_code']));
    $data_insert['is_finished']=1 ;
    $data_insert['end_date']=date("Y-m-d H:i:s");
    $data_insert['updated_at']=date("Y-m-d H:i:s");
    $data_insert['updated_by']=auth()->user()->id;
    $flag=update(new Admins_Shifts(),$data_insert ,array("com_code"=>$com_code,"admin_id"=>$admin_id,"is_finished"=>0,"id"=>$shift_id));
  if($flag){
       return redirect()->route('admin.admin_shift.index')->with(['success'=>'لقد   تم انهاء الشفت بنجاح']);
  }else{
       return redirect()->route('admin.admin_shift.index')->with(['error'=>'عفوا لقد حدث خطأ ما من فضلك حاول مرة اخري']);
  }
  }catch(\Exception $ex){
      return redirect()->back()
           ->with(['error'=>'عفوا حدث خطأ ما'.$ex->getMessage()])
           ->withInput();           
  }
  } 


  public function print_details($id){

    try {
    $com_code = auth()->user()->com_code;
    $Admins_Shifts = get_cols_where_row(new Admins_Shifts(), array("*"), array("id" => $id, "com_code" => $com_code));
    if (empty($Admins_Shifts)) {
    return redirect()->route('admin.admin_shift.index')->with(['error' => $id]);
    }
    $Admins_Shifts['admin_name'] = Admin::where('id', $Admins_Shifts['admin_id'])->value('name');
    $Admins_Shifts['treasuries_name'] = Treasuries::where('id', $Admins_Shifts->treasuries_id)->value('name');

if($Admins_Shifts['is_finished']==1 and $Admins_Shifts['is_delivered_and_review'] ){
  $Admins_Shifts['review_by_admin_name'] = Admin::where('id', $Admins_Shifts['delivered_to_admin_id'])->value('name');
 //  $Admins_Shifts['review_by_admin_treasuries_name'] = Treasuries::where('delivered_to_treasuries_id', $Admins_Shifts-['delivered_to_treasuries_id'])->value('name');

}
$Treasuries_transactions = get_cols_where(new Treasuries_transactions(), array("*"), array('shift_code' => $Admins_Shifts['shift_code'], 'com_code' => $com_code), 'id', 'ASC');
    if (!empty($Treasuries_transactions)) {
    foreach ($Treasuries_transactions as $info) {
    $info->mov_type_name = Mov_type::where('id', $info->mov_type)->value('name');
    }
    }
    $systemData=get_cols_where_row(new Admin_panel_settings(),array("system_name","phone","address","photo"),array("com_code"=>$com_code));
   $total_exceh=Treasuries_transactions::where("com_code","=",$com_code)->where("shift_code","=", $Admins_Shifts['shift_code'])->where("money","<",0)->sum("money");
    $total_collect=Treasuries_transactions::where("com_code","=",$com_code)->where("shift_code","=", $Admins_Shifts['shift_code'])->where("money",">",0)->sum("money");
   $total_net=$total_exceh+$total_collect;
        return view('admin.admins_shifts.print_details',['data'=>$Admins_Shifts,'systemData'=>$systemData,'Treasuries_transactions'=>$Treasuries_transactions,
                                                         'total_exceh'=>$total_exceh,'total_collect'=>$total_collect,'total_net'=>$total_net]);
    
    
    } catch (\Exception $ex) {
    return redirect()->back()
    ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
    } }
    
    
    public function review_now(Request $request){
      if($request->ajax()){
        $com_code = auth()->user()->com_code;
        $Admins_Shifts_will_reviewed=get_cols_where_row( new Admins_Shifts(),array("*"),array("id"=>$request->id,"com_code"=>$com_code,"is_finished"=>1,"is_delivered_and_review"=>0));
        $checkExistsOpenShift=get_cols_where_row(new Admins_Shifts(),array("id","treasuries_id"),array("com_code"=>$com_code,"admin_id"=>auth()->user()->id,"is_finished"=>0));
        
          return view('admin.admins_shifts.review_now',['checkExistsOpenShift'=>$checkExistsOpenShift,'Admins_Shifts_will_reviewed'=>$Admins_Shifts_will_reviewed]);
      }
      }
 public function do_review_now($shift_id ,Request $request){
        
          $com_code = auth()->user()->com_code;
          $Admins_Shifts_will_reviewed=get_cols_where_row( new Admins_Shifts(),array("*"),array("id"=>$shift_id,"com_code"=>$com_code,"is_finished"=>1,"is_delivered_and_review"=>0));
          $checkExistsOpenShift=get_cols_where_row(new Admins_Shifts(),array("id","treasuries_id","shift_code","admin_id"),array("com_code"=>$com_code,"admin_id"=>auth()->user()->id,"is_finished"=>0));
          if(empty($Admins_Shifts_will_reviewed)){
              return redirect()->route('admin.admin_shift.index')
            ->with(['error' => 'عفوا غير قادر للوصول الى بيانات   هذا  الشفت' ]);
          }
          if(empty($checkExistsOpenShift)){
            return redirect()->route('admin.admin_shift.index')
          ->with(['error' => 'عفوا لا تمتلك  شفت  مفتوح  حالياً' ]);
        }

        //first get isal number with treasuries 
  $treasury_date = get_cols_where_row(new Treasuries(), array("last_isal_collect"), array("com_code" => $com_code, "id" => $checkExistsOpenShift['treasuries_id']));
  if (empty($treasury_date)) {
    return redirect()->route('admin.admin_shift.index')
     ->with(['error' => 'عفوا غير قادر للوصول الى بيانات   خزنة  الشفت' ]);
  }

 $last_record_treasuries_transactions_record = get_cols_where_row_orderby(new Treasuries_transactions(), array("auto_serial"), array("com_code" => $com_code), "auto_serial", "DESC");
    if (!empty($last_record_treasuries_transactions_record)) {
         $dataInsert['auto_serial'] = $last_record_treasuries_transactions_record['auto_serial'] + 1;
     } else {
         $dataInsert['auto_serial'] = 1;
     }

$dataInsert['isal_number'] = $treasury_date['last_isal_collect'] + 1;
$dataInsert['shift_code'] = $checkExistsOpenShift['shift_code'];
$dataInsert['money'] = $request->what_realy_delivered;
$dataInsert['treasuries_id'] =$checkExistsOpenShift['treasuries_id'];;
$dataInsert['mov_type'] = 1;
$dataInsert['move_date'] = date("Y-m-d");
$dataInsert['is_approved'] = 1;
$treasuries_name = Treasuries::where('id', $Admins_Shifts_will_reviewed['treasuries_id'])->value('name');
$admin_name = Admin::where('id', $Admins_Shifts_will_reviewed->admin_id)->value('name');

$dataInsert['byan'] = "مراجعة واستلام نقدية خزنة" . $treasuries_name . "للمستخدم" . $admin_name . "رقم الشفت" . $Admins_Shifts_will_reviewed['shift_code'];
$dataInsert['created_at'] = date("Y-m-d H:i:s");
$dataInsert['added_by'] = auth()->user()->id;
$dataInsert['com_code'] = $com_code;
$flag = insert(new Treasuries_transactions(), $dataInsert);
 if($flag){
  $Treasuries_transactions=get_cols_where_row(new Treasuries_transactions() ,array("id"),array( "id"=>$flag->id));
  $dataToUpdate['is_delivered_and_review']=1;
  $dataToUpdate['delivered_to_admin_id']=$checkExistsOpenShift['admin_id'];
  $dataToUpdate['delivered_to_admin_sift_id']=$checkExistsOpenShift['shift_code'];
  $dataToUpdate['what_realy_delivered']=$request->what_realy_delivered;
  $dataToUpdate['delivered_to_treasuries_id'] =$checkExistsOpenShift['treasuries_id'];;
  $dataToUpdate['review_receive_date'] =date("Y-m-d H:i:s");
  $dataToUpdate['money_state']=$request->money_state;
  $dataToUpdate['money_state_value']=$request->money_state_value;
  if(!empty($Treasuries_transactions)){
    $dataToUpdate['treasuries_transactions_id']=$Treasuries_transactions['id'];

  }
  update(new Admins_Shifts(),$dataToUpdate,array("id"=>$shift_id,"com_code"=>$com_code,"is_finished"=>1,"is_delivered_and_review"=>0));
 }
 return redirect()->route('admin.admin_shift.index')
 ->with(['success' => ' تم مرجعة وستلام  الشفت بنجاح' ]);
        }
   
}