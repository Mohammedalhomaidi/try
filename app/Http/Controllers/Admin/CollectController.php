<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Treasuries_transactions;
use App\Models\Admin;
use App\Models\Admins_Shifts;
use App\Models\Treasuries;
use App\Models\Account;
use App\Models\Mov_type;
use App\Models\Account_types;
use App\Models\Supplier;
use App\Models\Suppliers_with_orders;
use App\Models\Stores;
use App\Models\Inv_uom;
use App\Models\Suppliers_with_orders_details;
use App\Models\Admin_panel_settings;
use App\Models\Inv_itemCard;
use App\Models\Customer;
use App\Models\Sales_invoices;
use App\Models\SalesReturn;
use App\Models\Delegate;
use App\Models\Services;

use App\Http\Requests\Collect_transactionRequest;
use App\Models\services_with_orders;

class CollectController extends Controller
{
public function index()
{
  $com_code = auth()->user()->com_code;
  $data = get_cols_where2_p(new Treasuries_transactions(), array("*"), array("com_code" => $com_code), "money", ">", 0, 'id', 'DESC', PAGINATION_count);
  if (!empty($data)) {
     foreach ($data as $info) {
           $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
           $info->treasuries_name = Treasuries::where('id', $info->treasuries_id)->value('name');
           $info->mov_type_name = Mov_type::where('id', $info->mov_type)->value('name');
           if($info->is_account==1){
              $info->account_type = Account::where(["account_number" => $info->account_number, "com_code" => $com_code])->value("account_type");
              $info->account_type_name = Account_types::where(["id" => $info->account_type])->value("name");
              $info->account_name = Account::where(["account_number" => $info->account_number, "com_code" => $com_code])->value("name");
}
}
}
    $checkExistsOpenShift = get_cols_where_row(new Admins_Shifts(), array("treasuries_id", "shift_code"), array("com_code" => $com_code, "admin_id" => auth()->user()->id, "is_finished" => 0));
     if (!empty($checkExistsOpenShift)) {
        $checkExistsOpenShift['treasuries_name'] = Treasuries::where('id', $checkExistsOpenShift['treasuries_id'])->value('name');
//get Treasuries Balance
      $checkExistsOpenShift['treasuries_balance_now'] = get_sum_where(new Treasuries_transactions(), "money", array("com_code" => $com_code, "shift_code" => $checkExistsOpenShift['shift_code']));
}
     $mov_type = get_cols_where(new Mov_type(), array("id", "name"), array("active" => 1, 'in_screen' => 2, 'is_private_internal' => 0), 'id', 'ASC');
     $accounts = get_cols_where(new Account(), array("name", "account_number", "account_type"), array("com_code" => $com_code, "active"=>1, "is_parent" => 0), 'id', 'DESC');
     if (!empty($accounts)) {
          foreach ($accounts as $info) {
            $info->account_type_name = Account_types::where(["id" => $info->account_type])->value("name");
}
}
      $accounts_search = get_cols_where(new Account(), array("name", "account_number", "account_type"), array("com_code" => $com_code, "is_parent" => 0), 'id', 'DESC');
      if (!empty($accounts_search)) {
         foreach ($accounts_search as $info) {
            $info->account_type_name = Account_types::where(["id" => $info->account_type])->value("name");
}
}
     $treasuries = get_cols_where(new Treasuries(), array("id", "name"), array("com_code" => $com_code), 'id', 'ASC');
     $admins = get_cols_where(new Admin(), array("id", "name"), array("com_code" => $com_code), 'id', 'ASC');
     return view('admin.collect_transactions.index', ['data' => $data, 'checkExistsOpenShift' => $checkExistsOpenShift, 'accounts' => $accounts, 'mov_type' => $mov_type,'treasuries'=>$treasuries,'admins'=>$admins,'accounts_search'=>$accounts_search]);
}

//for collect money
public function store(Collect_transactionRequest $request)
{
try {
$com_code = auth()->user()->com_code;
//check if user has open shift or not
$checkExistsOpenShift = get_cols_where_row(new Admins_Shifts(), array("treasuries_id", "shift_code"), array("com_code" => $com_code, "admin_id" => auth()->user()->id, "is_finished" => 0, "treasuries_id" => $request->treasuries_id));
if (empty($checkExistsOpenShift)) {
return redirect()->back()->with(['error' => "  عفوا لايوجد شفت خزنة مفتوح حاليا !!"])->withInput();
}
//first get isal number with treasuries 
$treasury_date = get_cols_where_row(new Treasuries(), array("last_isal_collect"), array("com_code" => $com_code, "id" => $request->treasuries_id));
if (empty($treasury_date)) {
return redirect()->back()->with(['error' => "  عفوا بيانات الخزنة المختارة غير موجوده !!"])->withInput();
}
$last_record_treasuries_transactions_record = get_cols_where_row_orderby(new Treasuries_transactions(), array("auto_serial"), array("com_code" => $com_code), "auto_serial", "DESC");
if (!empty($last_record_treasuries_transactions_record)) {
$dataInsert['auto_serial'] = $last_record_treasuries_transactions_record['auto_serial'] + 1;
} else {
$dataInsert['auto_serial'] = 1;
}
$dataInsert['isal_number'] = $treasury_date['last_isal_collect'] + 1;
$dataInsert['shift_code'] = $checkExistsOpenShift['shift_code'];
//debit مدين
$dataInsert['money'] = $request->money;
$dataInsert['treasuries_id'] = $request->treasuries_id;
$dataInsert['mov_type'] = $request->mov_type;
$dataInsert['move_date'] = $request->move_date;
$dataInsert['account_number'] = $request->account_number;
$dataInsert['is_account'] = 1;
$dataInsert['is_approved'] = 1;
//Credit دائن
$dataInsert['money_for_account'] = $request->money * (-1);
$dataInsert['byan'] = $request->byan;
$dataInsert['created_at'] = date("Y-m-Y H:i:s");
$dataInsert['added_by'] = auth()->user()->id;
$dataInsert['com_code'] = $com_code;
$flag = insert(new Treasuries_transactions(), $dataInsert);
if ($flag) {
//update Treasuries last_isal_collect
$dataUpdateTreasuries['last_isal_collect'] = $dataInsert['isal_number'];
update(new Treasuries(), $dataUpdateTreasuries, array("com_code" => $com_code, "id" => $request->treasuries_id));
$account_type = Account::where(["account_number" => $request->account_number])->value("account_type");

if($account_type==2){
    $the_final_Balance=refresh_account_blance_supplier($request->account_number,new Account(),new Supplier(),new Treasuries_transactions(),new Suppliers_with_orders(),new services_with_orders() ,false);
    }elseif($account_type==3){
    $the_final_Balance=refresh_account_blance_customer($request->account_number,new Account(),new Customer(),new Treasuries_transactions(),new Sales_invoices(),new SalesReturn(),new services_with_orders(),false);
    }elseif ($account_type == 4) {
        $the_final_Balance =  refresh_account_blance_delegate($request->account_number,new Account(),new Delegate(),new Treasuries_transactions(),new Sales_invoices(),new services_with_orders(),false);
    }
    else{
    $the_final_Balance=refresh_account_blance_General($request->account_number,new Account(),new Treasuries_transactions(),new services_with_orders(),false);
    }

return redirect()->route('admin.collect_transaction.index')->with(['success' => "لقد تم اضافة البيانات بنجاح "]);
} else {
return redirect()->back()->with(['error' => " عفوا حدث خطأ م من فضلك حاول مرة اخري !"])->withInput();
}
} catch (\Exception $ex) {
return redirect()->back()->with(['error' => "عفوا حدث خطأما" . " " . $ex->getMessage()])->withInput();
}
}



public function  get_account_blance(Request $request){
if($request->ajax()){
$com_code=auth()->user()->com_code;
$account_number=$request->account_number;
$AccountData=  Account::select("account_type")->where(["com_code"=>$com_code,"account_number"=>$account_number])->first();
if(!empty($AccountData)){
if($AccountData['account_type']==2){
$the_final_Balance=refresh_account_blance_supplier($account_number,new Account(),new Supplier(),new Treasuries_transactions(),new Suppliers_with_orders(),new services_with_orders() ,true);
return view('admin.collect_transactions.get_account_blance',['the_final_Balance'=>$the_final_Balance]);
}elseif($AccountData['account_type']==3){
$the_final_Balance=refresh_account_blance_customer($account_number,new Account(),new Customer(),new Treasuries_transactions(),new Sales_invoices(),new SalesReturn(),new services_with_orders(),true);
return view('admin.collect_transactions.get_account_blance',['the_final_Balance'=>$the_final_Balance]);
}elseif ($AccountData['account_type'] == 4) {
    $the_final_Balance =  refresh_account_blance_delegate($account_number,new Account(),new Delegate(),new Treasuries_transactions(),new Sales_invoices(),new services_with_orders(),true);
    return view('admin.collect_transactions.get_account_blance',['the_final_Balance'=>$the_final_Balance]);

}

else{
$the_final_Balance=refresh_account_blance_General($account_number,new Account(),new Treasuries_transactions(),new services_with_orders(),true);
return view('admin.collect_transactions.get_account_blance',['the_final_Balance'=>$the_final_Balance]);
}
}
}
}


public function ajax_search(Request $request)
{
if ($request->ajax()) {
$com_code=auth()->user()->com_code;
$account_number = $request->account_number;
$mov_type = $request->mov_type;
$treasuries = $request->treasuries;
$admins = $request->admins;
$from_date = $request->from_date;
$to_date = $request->to_date;
$searchbyradio = $request->searchbyradio;
$search_by_text = $request->search_by_text;
if ($account_number == 'all') {
//دائما  true
$field1 = "id";
$operator1 = ">";
$value1 = 0;
}  else {
$field1 = "account_number";
$operator1 = "=";
$value1 = $account_number;
}
if ($mov_type == 'all') {
//دائما  true
$field2 = "id";
$operator2 = ">";
$value2 = 0;
} else {
$field2 = "mov_type";
$operator2 = "=";
$value2 = $mov_type;
}
if ($treasuries == 'all') {
//دائما  true
$field3 = "id";
$operator3 = ">";
$value3 = 0;
}  else {
$field3 = "treasuries_id";
$operator3 = "=";
$value3 = $treasuries;
}
if ($admins == 'all') {
//دائما  true
$field4 = "id";
$operator4 = ">";
$value4 = 0;
}  else {
$field4 = "added_by";
$operator4 = "=";
$value4 = $admins;
}
if ($from_date == '') {
//دائما  true
$field5 = "id";
$operator5 = ">";
$value5 = 0;
} else {
$field5 = "move_date";
$operator5 = ">=";
$value5 = $from_date;
}
if ($to_date == '') {
//دائما  true
$field6 = "id";
$operator6 = ">";
$value6 = 0;
} else {
$field6 = "move_date";
$operator6 = "<=";
$value6 = $to_date;
}
if ($search_by_text != '') {
if ($searchbyradio == 'auto_serial') {
$field7 = "auto_serial";
$operator7 = "=";
$value7 = $search_by_text;
} elseif ($searchbyradio == 'isal_number') {
$field7 = "isal_number";
$operator7 = "=";
$value7 = $search_by_text;
}
elseif ($searchbyradio == 'account_number') {
$field7 = "account_number";
$operator7 = "=";
$value7 = $search_by_text;
}
else {
$field7 = "shift_code";
$operator7 = "=";
$value7 = $search_by_text;
}
} else {
//true 
$field7 = "id";
$operator7 = ">";
$value7 = 0;
}
$data = Treasuries_transactions::where($field1, $operator1, $value1)->
where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where
($field4, $operator4, $value4)->
where($field5, $operator5, $value5)->
where($field6, $operator6, $value6)
->
where($field7, $operator7, $value7) -> where("money", ">", 0)->
orderBy('id', 'DESC')->paginate(PAGINATION_count);
if (!empty($data)) {
foreach ($data as $info) {
$info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
$info->treasuries_name = Treasuries::where('id', $info->treasuries_id)->value('name');
$info->mov_type_name = Mov_type::where('id', $info->mov_type)->value('name');
if($info->is_account==1){
$info->account_type = Account::where(["account_number" => $info->account_number, "com_code" => $com_code])->value("account_type");
$info->account_type_name = Account_types::where(["id" => $info->account_type])->value("name");
$info->account_name = Account::where(["account_number" => $info->account_number, "com_code" => $com_code])->value("name");
}
}
}
$totalCollectInSearch=Treasuries_transactions::where($field1, $operator1, $value1)->
where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where
($field4, $operator4, $value4)->
where($field5, $operator5, $value5)->
where($field6, $operator6, $value6)
->
where($field7, $operator7, $value7) -> where("money", ">", 0)->sum('money');
return view('admin.collect_transactions.ajax_search', ['data' => $data,'totalCollectInSearch'=>$totalCollectInSearch]);
}
}
public function printsaleswina4($id,$size){

    try {
    $com_code = auth()->user()->com_code;
    $data = get_cols_where_row(new Treasuries_transactions(), array("*"), array("com_code" => $com_code ,'id'=>$id), "money", ">", 0, 'id', 'DESC');
    if (!empty($data)) {
     
             $data->added_by_admin = Admin::where('id', $data->added_by)->value('name');
             $data->mov_type_name = Mov_type::where('id', $data->mov_type)->value('name');
             if($data->is_account==1){
                $data->account_nu = Account::where(["account_number" => $data->account_number, "com_code" => $com_code])->value("account_number");
                $data->account_name = Account::where(["account_number" => $data->account_number, "com_code" => $com_code])->value("name");
                         }}
 
    $systemData=get_cols_where_row(new Admin_panel_settings(),array("system_name","phone","address","photo"),array("com_code"=>$com_code));
    if($size=="A4"){
        return view('admin.collect_transactions.printsaleswina4',['data'=>$data,'systemData'=>$systemData ]);
    }
    } catch (\Exception $ex) {
    return redirect()->back()
    ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
    }
    }

public function storeAndprint(Collect_transactionRequest $request)
{
try {
$com_code = auth()->user()->com_code;
//check if user has open shift or not
$checkExistsOpenShift = get_cols_where_row(new Admins_Shifts(), array("treasuries_id", "shift_code"), array("com_code" => $com_code, "admin_id" => auth()->user()->id, "is_finished" => 0, "treasuries_id" => $request->treasuries_id));
if (empty($checkExistsOpenShift)) {
return redirect()->back()->with(['error' => "  عفوا لايوجد شفت خزنة مفتوح حاليا !!"])->withInput();
}
//first get isal number with treasuries 
$treasury_date = get_cols_where_row(new Treasuries(), array("last_isal_collect"), array("com_code" => $com_code, "id" => $request->treasuries_id));
if (empty($treasury_date)) {
return redirect()->back()->with(['error' => "  عفوا بيانات الخزنة المختارة غير موجوده !!"])->withInput();
}
$last_record_treasuries_transactions_record = get_cols_where_row_orderby(new Treasuries_transactions(), array("auto_serial"), array("com_code" => $com_code), "auto_serial", "DESC");
if (!empty($last_record_treasuries_transactions_record)) {
$dataInsert['auto_serial'] = $last_record_treasuries_transactions_record['auto_serial'] + 1;
} else {
$dataInsert['auto_serial'] = 1;
}
$dataInsert['isal_number'] = $treasury_date['last_isal_collect'] + 1;
$dataInsert['shift_code'] = $checkExistsOpenShift['shift_code'];
//debit مدين
$dataInsert['money'] = $request->money;
$dataInsert['treasuries_id'] = $request->treasuries_id;
$dataInsert['mov_type'] = $request->mov_type;
$dataInsert['move_date'] = $request->move_date;
$dataInsert['account_number'] = $request->account_number;
$dataInsert['is_account'] = 1;
$dataInsert['is_approved'] = 1;
//Credit دائن
$dataInsert['money_for_account'] = $request->money * (-1);
$dataInsert['byan'] = $request->byan;
$dataInsert['created_at'] = date("Y-m-Y H:i:s");
$dataInsert['added_by'] = auth()->user()->id;
$dataInsert['com_code'] = $com_code;
$flag = insert(new Treasuries_transactions(), $dataInsert);
if ($flag) {
//update Treasuries last_isal_collect
$dataUpdateTreasuries['last_isal_collect'] = $dataInsert['isal_number'];
update(new Treasuries(), $dataUpdateTreasuries, array("com_code" => $com_code, "id" => $request->treasuries_id));
$account_type = Account::where(["account_number" => $request->account_number])->value("account_type");

if($account_type==2){
    $the_final_Balance=refresh_account_blance_supplier($request->account_number,new Account(),new Supplier(),new Treasuries_transactions(),new Suppliers_with_orders(),new services_with_orders() ,false);
    }elseif($account_type==3){
    $the_final_Balance=refresh_account_blance_customer($request->account_number,new Account(),new Customer(),new Treasuries_transactions(),new Sales_invoices(),new SalesReturn(),new services_with_orders(),false);
    }elseif ($account_type == 4) {
        $the_final_Balance =  refresh_account_blance_delegate($request->account_number,new Account(),new Delegate(),new Treasuries_transactions(),new Sales_invoices(),new services_with_orders(),false);
    }
    else{
    $the_final_Balance=refresh_account_blance_General($request->account_number,new Account(),new Treasuries_transactions(),new services_with_orders(),false);
    }
 $data = get_cols_where_row(new Treasuries_transactions(), array("*"), array("com_code" => $com_code ,'id'=>$flag->id), "money", ">", 0, 'id', 'DESC');
    if (!empty($data)) {
     
             $data->added_by_admin = Admin::where('id', $data->added_by)->value('name');
             $data->mov_type_name = Mov_type::where('id', $data->mov_type)->value('name');
             if($data->is_account==1){
                $data->account_nu = Account::where(["account_number" => $data->account_number, "com_code" => $com_code])->value("account_number");
                $data->account_name = Account::where(["account_number" => $data->account_number, "com_code" => $com_code])->value("name");
                         }}
 
    $systemData=get_cols_where_row(new Admin_panel_settings(),array("system_name","phone","address","photo"),array("com_code"=>$com_code));
    
        return view('admin.collect_transactions.printsaleswina4',['data'=>$data,'systemData'=>$systemData ]);
    


}
} catch (\Exception $ex) {
return redirect()->back()->with(['error' => "عفوا حدث خطأما" . " " . $ex->getMessage()])->withInput();
}
}
    
}