<?php 
//use  Illuminate\Support\Facades\config;
use App\Models\permission_rols_mian_menues;
use App\Models\permission_rols_sub_menues;
use App\Models\permission_rols_sub_menues_action;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\customer_order;


function check_for_user_login($id=null){
    if( $id==""||$id==null){
   return false;
     }else{
 $data=Admin::select("id")->where(["id"=>$id ,"name"=>auth()->user()->name,"username"=>auth()->user()->username])->first();
 if(!empty($data)){
     return true;
 }else{
     return false;
 }
 }
 }
 function check_for_show_order(){

    $data =get_cols_where(new customer_order(), array("*"), array("is_approved"=>1),"id","ASC");
  if(!empty($data)){
    foreach($data as $info){
        $info->name_Customer=get_field_value(new Customer(), "name", array("id" => $info['customer_code']));
       
        $datatime1=date_create($info->invoice_date);

        $datatime2=date_create(date("Y-m-d h:i:sa"));
        if(date_diff($datatime1,$datatime2)->format(' %m ')!=0){
            $info->age_order=date_diff($datatime1,$datatime2)->format(' %m  شهر و  %d   يوم    ');
        }  
        elseif(date_diff($datatime1,$datatime2)->format(' %d ')!=0){
            $info->age_order=date_diff($datatime1,$datatime2)->format(' %d  يوم و  %h   ساعة  ');
           }elseif(date_diff($datatime1,$datatime2)->format(' %h ')!=0){
             $info->age_order=date_diff($datatime1,$datatime2)->format(' %h  ساعة و  %i   دقيقة  ');
       }else{ $info->age_order=date_diff($datatime1,$datatime2)->format('  %i  دقيقة  ');
        }
    }
  }
     return $data;
 }
 

 function check_for_pagehome(){
   if(check_for_user_login(auth()->user()->id)==true){
    return('layouts.admin');
   }
  else{
    return ('layouts.customer');

  }
 }

 function check_permeission_main_menues($permission_main_menues_id=null){
    if( $permission_main_menues_id==""||$permission_main_menues_id==null){
   return false;
     }else{
 $permission_rols_id=auth()->user()->permission_rols_id;
 $data=permission_rols_mian_menues::select("id")->where(["permission_rols_id"=>$permission_rols_id,"permission_main_menues_id"=>$permission_main_menues_id])->first();
 if(!empty($data)){
     return true;
 }else{
     return false;
 }
 }
 }

function check_permeission_sub_menues($permission_sub_menues_id=null){
    if( $permission_sub_menues_id==""||$permission_sub_menues_id==null){
   return false;
     }else{
 $permission_rols_id=auth()->user()->permission_rols_id;
 $data=permission_rols_sub_menues::select("id")->where(["permission_rols_id"=>$permission_rols_id,"permission_sub_menues"=>$permission_sub_menues_id])->first();
 if(!empty($data)){
     return true;
 }else{
     return false;
 }
 }
 }
 function check_permeission_sub_menues_action($permission_sub_menues_action_id=null){
    if( $permission_sub_menues_action_id==""||$permission_sub_menues_action_id==null){
   return false;
     }else{
 $permission_rols_id=auth()->user()->permission_rols_id;
 $data=permission_rols_sub_menues_action::select("id")->where(["permission_rols_id"=>$permission_rols_id,"permission_sub_menues_action_id"=>$permission_sub_menues_action_id])->first();
 if(!empty($data)){
     return true;
 }else{
     return false;
 }
 }
 }

 function check_permeission_Redirection($permission_sub_menues_action_id=null){
 $permission_rols_id=auth()->user()->permission_rols_id;
 $data=permission_rols_sub_menues_action::select("id")->where(["permission_rols_id"=>$permission_rols_id,"permission_sub_menues_action_id"=>$permission_sub_menues_action_id])->first();
 if(empty($data)){
   return redirect()->away(route('admin.homepage'))->send()->with(['error'=>'عفواً لا تمتلك صلاحيات لهذه الصفحة']);
 }
 }
 

function uploade($folder , $image){
    $extension = strtolower($image->extension());
    $filename = time() . rand(100, 999) . '.' . $extension;
    $image->getClientOriginalName = $filename;
    $image->move($folder, $filename);
    return $filename;
}
//we set default value for each parameter in function to avoid error in composer update
//Deprecate required parameters after optional parameters in
/*get some cols by pagination table */
function get_cols_where_p($model=null, $columns_names = array(), $where = array(), $order_field="id",$order_type="DESC",$pagination_counter=13)
{
$data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->paginate($pagination_counter);
return $data;
}
/*get some cols by pagination table where 2 */
function get_cols_where2_p($model=null, $columns_names = array(), $where = array(),$where2field=null,$where2operator=null,$where2value=null, $order_field="id",$order_type="DESC",$pagination_counter=13)
{
$data = $model::select($columns_names)->where($where)->where($where2field,$where2operator,$where2value)->
orderby($order_field, $order_type)->paginate($pagination_counter);
return $data;
}
/*get some cols  table */
function get_cols_where($model=null, $columns_names = array(), $where = array(), $order_field="id",$order_type="DESC")
{
$data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->get();
return $data;
}
/*get some cols  table */
function get_cols_where_limit($model=null, $columns_names = array(), $where = array(), $order_field="id",$order_type="DESC",$limit=1)
{
$data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->limit($limit)->get();
return $data;
}
/*get some cols  table 2 */
function get_cols_where_order2($model=null, $columns_names = array(), $where = array(), $order_field="id",$order_type="DESC",$order_field2="id",$order_type2="DESC")
{
$data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->orderby($order_field2, $order_type2)->get();
return $data;
}
/*get some cols  table */
function get_cols($model=null, $columns_names = array(), $order_field="id",$order_type="DESC")
{
$data = $model::select($columns_names)->orderby($order_field, $order_type)->get();
return $data;
}
/*get some cols row table */
function get_cols_where_row($model=null, $columns_names = array(), $where = array())
{
$data = $model::select($columns_names)->where($where)->first();
return $data;
}
/*get some cols row table */
function get_cols_where2_row($model=null, $columns_names = array(), $where = array(),$where2 = "")
{
$data = $model::select($columns_names)->where($where)->where($where2)->first();
return $data;
}
/*get some cols row table order by */
function get_cols_where_row_orderby($model, $columns_names = array(), $where = array(), $order_field="id",$order_type="DESC")
{
$data = $model::select($columns_names)->where($where)->orderby($order_field, $order_type)->first();
return $data;
}
/*get some cols table */
function insert($model=null, $arrayToInsert=array(),$returnData=false)
{
$flag = $model::create($arrayToInsert);
if($returnData==true){
$data=get_cols_where_row($model,array("*"),$arrayToInsert);
return $data;
}else{
return $flag;
}
}
function get_field_value($model=null, $field_name=null , $where = array())
{
$data = $model::where($where)->value($field_name);
return $data;
}
function update($model=null,$data_to_update=array(),$where=array()){
$flag=$model::where($where)->update($data_to_update);
return $flag;
}
function delete($model=null,$where=array()){
$flag=$model::where($where)->delete();
return $flag;
}
function get_sum_where($model=null,$field_name=null,$where=array()){
$sum=$model::where($where)->sum($field_name);
return $sum;
}
function get_user_shift($Admins_Shifts,$Treasuries=null,$Treasuries_transactions=null){
$com_code=auth()->user()->com_code;
$data = $Admins_Shifts::select("treasuries_id","shift_code")->where(["com_code"=>$com_code,"admin_id"=>auth()->user()->id,"is_finished"=>0])->first();
if(!empty($data)){
$data['name']=$Treasuries::where(["id"=>$data["treasuries_id"],"com_code"=>$com_code])->value("name");
$data['balance']=$Treasuries_transactions::where(["shift_code"=>$data["shift_code"],"com_code"=>$com_code])->sum("money");
}
return $data;
}
//get Account Balance دالة احتساب وتحديث رصيد الحساب المالي للمورد  
function refresh_account_blance_supplier($account_number=null,$AccountModel=null,$SupplierModel=null,$treasuries_transactionsModel=null,$suppliers_with_ordersModel=null,$ServicesOrdersModel=null,$returnFlag=false){
$com_code=auth()->user()->com_code;
//حنجيب الرصيد الافتتاحي  للحساب اول المده لحظة تكويده
$AccountData=  $AccountModel::select("start_balance","account_type")->where(["com_code"=>$com_code,"account_number"=>$account_number])->first();
//لو مورد
if($AccountData['account_type']==2){
//صافي مجموع المشتريات والمرتجعات للمورد   
$the_net_in_suppliers_with_orders=$suppliers_with_ordersModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//صافي حركة النقديه بالخزن علي حساب المورد
$the_net_in_treasuries_transactions=$treasuries_transactionsModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//صافي حركة فواتير الخدمات الخارجية والداخلية المتعلقه بالحساب المالي للمورد
$the_net_in_services_orders=$ServicesOrdersModel::where(["com_code"=>$com_code,"account_number"=>$account_number,'is_account_number'=>1])->sum("money_for_account");
//الرصيد النهائي للمورد
$the_final_Balance=$AccountData['start_balance']+$the_net_in_suppliers_with_orders+$the_net_in_treasuries_transactions+$the_net_in_services_orders;
$dataToUpdateAccount['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول الحسابات المالية بحقل المورد
$AccountModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateAccount);
$dataToUpdateSupplier['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول الموردين  بحقل المورد
$SupplierModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateSupplier);
if($returnFlag){
return $the_final_Balance;
}
}
}
function refresh_account_blance_delegate($account_number=null,$AccountModel=null,$delgateModel=null,$treasuries_transactionsModel=null,$SalesinvoiceModel=null,$ServicesOrdersModel=null,$returnFlag=true){
$com_code=auth()->user()->com_code;
//حنجيب الرصيد الافتتاحي  للحساب اول المده لحظة تكويده
$AccountData=  $AccountModel::select("start_balance","account_type","other_table_FK")->where(["com_code"=>$com_code,"account_number"=>$account_number])->first();
//لو مندوب
if(!empty($AccountData)){
if($AccountData['account_type']==4){
//صافي مجموع عموله المندوب بالمبيعات 
$the_net_sales_invoicesForDelegate=$SalesinvoiceModel::where(["com_code"=>$com_code,"delegate_code"=>$AccountData['other_table_FK']])->sum("delegate_commission_value");
//صافي حركة النقديه بالخزن علي حساب المندوب
$the_net_in_treasuries_transactions=$treasuries_transactionsModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//الرصيد النهائي المندوب
//حساب اول المده +صافي المبيعات والمرتجعات +صافي حركة النقدية بالخزن للحساب المالي المندوب الحالي
//صافي حركة فواتير الخدمات الخارجية والداخلية المتعلقه بالحساب المالي للمندوب
$the_net_in_services_orders=$ServicesOrdersModel::where(["com_code"=>$com_code,"account_number"=>$account_number,'is_account_number'=>1])->sum("money_for_account");
$the_final_Balance=$AccountData['start_balance']+$the_net_sales_invoicesForDelegate+$the_net_in_treasuries_transactions+$the_net_in_services_orders;
$dataToUpdateAccount['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول الحسابات المالية بحقل المندوب
$AccountModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateAccount);
$dataToUpdateDelgate['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول   بحقل المندوب
$delgateModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateDelgate);
if($returnFlag){
return $the_final_Balance;
}
}
}
}
//get Account Balance دالة احتساب وتحديث رصيد الحساب المالي للعميل  
function refresh_account_blance_customer($account_number=null,$AccountModel=null,$customerModel=null,$treasuries_transactionsModel=null,$SalesinvoiceModel=null,$SalesReturnModel=null,$ServicesOrdersModel=null,$returnFlag=false){
$com_code=auth()->user()->com_code;
//حنجيب الرصيد الافتتاحي  للحساب اول المده لحظة تكويده
$AccountData=  $AccountModel::select("start_balance","account_type")->where(["com_code"=>$com_code,"account_number"=>$account_number])->first();
//لو عميل
if($AccountData['account_type']==3){
//صافي مجموع المبيعات والمرتجعات للمورد   
$the_net_sales_invoicesForCustomer=$SalesinvoiceModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//    صافي  مرتجع المبيعات بس لما نعمله
$the_net_sales_invoicesReturnForCustomer=$SalesReturnModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//صافي حركة النقديه بالخزن علي حساب العميل
$the_net_in_treasuries_transactions=$treasuries_transactionsModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//الرصيد النهائي للعميل
//حساب اول المده +صافي المبيعات والمرتجعات +صافي حركة النقدية بالخزن للحساب المالي للعميل الحالي
//صافي حركة فواتير الخدمات الخارجية والداخلية المتعلقه بالحساب المالي للعميل
$the_net_in_services_orders=$ServicesOrdersModel::where(["com_code"=>$com_code,"account_number"=>$account_number,'is_account_number'=>1])->sum("money_for_account");
$the_final_Balance=$AccountData['start_balance']+$the_net_sales_invoicesForCustomer+$the_net_sales_invoicesReturnForCustomer+$the_net_in_treasuries_transactions+$the_net_in_services_orders;
$dataToUpdateAccount['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول الحسابات المالية بحقل العميل
$AccountModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateAccount);
$dataToUpdateSupplier['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول العملاء  بحقل العميل
$customerModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateSupplier);
if($returnFlag){
return $the_final_Balance;
}
}
}
//get Account Balance دالة احتساب وتحديث رصيد الحساب المالي العام  
function refresh_account_blance_General($account_number=null,$AccountModel=null,$treasuries_transactionsModel=null,$ServicesOrdersModel=null,$returnFlag=false){
$com_code=auth()->user()->com_code;
//حنجيب الرصيد الافتتاحي  للحساب اول المده لحظة تكويده
$AccountData=  $AccountModel::select("start_balance","account_type")->where(["com_code"=>$com_code,"account_number"=>$account_number])->first();
//لو عميل
if($AccountData['account_type']!=2 and $AccountData['account_type']!=3 and $AccountData['account_type']!=4 and $AccountData['account_type']!=5 and $AccountData['account_type']!=8){
//صافي حركة النقديه بالخزن علي حساب العميل
$the_net_in_treasuries_transactions=$treasuries_transactionsModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//صافي حركة فواتير الخدمات الخارجية والداخلية المتعلقه بالحساب المالي 
$the_net_in_services_orders=$ServicesOrdersModel::where(["com_code"=>$com_code,"account_number"=>$account_number,'is_account_number'=>1])->sum("money_for_account");
$the_final_Balance=$AccountData['start_balance']+$the_net_in_treasuries_transactions+$the_net_in_services_orders;
$dataToUpdateAccount['current_balance']=$the_final_Balance;
$AccountModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateAccount);
if($returnFlag){
return $the_final_Balance;
}
}
}
function do_update_itemCardQuantity($Inv_itemCard=null,$item_code=null,$Inv_itemcard_batches=null,$does_has_retailunit=null,$retail_uom_quntToParent=null){
$com_code=auth()->user()->com_code;
// update itemcard Quantity mirror  تحديث المرآه الرئيسية للصنف
//حنجيب كمية الصنف من جدول الباتشات
$allQuantityINBatches=  $sum=$Inv_itemcard_batches::where(["com_code"=>$com_code,"item_code"=>$item_code])->sum("quantity");
//كل كمية الصنف بوحده الاب مباشره بدون اي تحويلات مثال  4شكارة وعلبتين
$DataToUpdateItemCardQuantity['All_QUENTITY']=$allQuantityINBatches;
if($does_has_retailunit==1){
//all quantity in reatails  كل الكمية بوحده التجزئة
//emaple 21 kilo
$QUENTITY_all_Retails=$allQuantityINBatches*$retail_uom_quntToParent;
// 21kilo  21/10  ->  2 شكارة
$parentQuanityUom=intdiv($QUENTITY_all_Retails,$retail_uom_quntToParent);    
$DataToUpdateItemCardQuantity['QUENTITY']=$parentQuanityUom;
//% modelus  21%10  - 1 علبة 
$DataToUpdateItemCardQuantity['QUENTITY_Retail']=fmod($QUENTITY_all_Retails,$retail_uom_quntToParent);   
$DataToUpdateItemCardQuantity['QUENTITY_all_Retails']=$QUENTITY_all_Retails;
}else{
$DataToUpdateItemCardQuantity['QUENTITY']=$allQuantityINBatches;
}
update($Inv_itemCard,$DataToUpdateItemCardQuantity,array("com_code"=>$com_code,"item_code"=>$item_code));
}
/*get counter where from  table */
function get_count_where($model=null,  $where = array())
{
$counter = $model::where($where)->count();
return $counter;
}
//get Account Balance دالة احتساب وتحديث رصيد الحساب المالي للمورد  
function refresh_account_blance_ProductionLine($account_number=null,$AccountModel=null,$ProductionLineModel=null,$treasuries_transactionsModel=null,$ServicesOrdersModel=null,$inv_production_exchangeModel=null,$inv_production_receiveModel=null,$returnFlag=false){
$com_code=auth()->user()->com_code;
//حنجيب الرصيد الافتتاحي  للحساب اول المده لحظة تكويده
$AccountData=  $AccountModel::select("start_balance","account_type")->where(["com_code"=>$com_code,"account_number"=>$account_number])->first();
// 
if($AccountData['account_type']==5){
//صافي مجموع صرف الخامات واستلام الانتاج التام لخط الانتاج   
$the_net_in_inv_production_exchange=$inv_production_exchangeModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
$the_net_inv_production_receive=$inv_production_receiveModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//صافي حركة النقديه بالخزن علي حساب خط الانتاج
$the_net_in_treasuries_transactions=$treasuries_transactionsModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->sum("money_for_account");
//صافي حركة فواتير الخدمات الخارجية والداخلية المتعلقه بالحساب المالي لخط الانتاج
$the_net_Services_inv_productionLine=$ServicesOrdersModel::where(["com_code"=>$com_code,"account_number"=>$account_number,'is_account_number'=>1])->sum("money_for_account");
//الرصيد النهائي لخط الانتاج
$the_final_Balance=$AccountData['start_balance']+$the_net_in_inv_production_exchange+$the_net_inv_production_receive+$the_net_Services_inv_productionLine+$the_net_in_treasuries_transactions;
$dataToUpdateAccount['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول الحسابات المالية بحقل خط الانتاج
$AccountModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateAccount);
$dataToUpdateLine['current_balance']=$the_final_Balance;
//update in Accounts حندث جدول الموردين  بحقل المورد
$ProductionLineModel::where(["com_code"=>$com_code,"account_number"=>$account_number])->update($dataToUpdateLine);
if($returnFlag){
return $the_final_Balance;
}
}
}
function convert_to_word($n){
 
  //المتغيرات لي حمل القيمة من المصفوفة
  global $v; 
  global $v1;
  global $v2;
  global $v3;
  global $v4;
  global $v5;
  global $v6;
  global $v7;
  global $v8;
  global $v9;
  global $v10;
 global $v11;
  //متغير الي تعريف نوع العملة
  $ryal = "ريال";
  //متغير لي استخدامة في عملية الاخراج
  $len = $n; 
   //متغير لي حمل عملية القسمة 
   global  $divid;

   $a = array(" ","وحد","اثنين","ثلاثة","اربعه","خمسة","ستة","سبعه","ثمانية","تسعة","عشرة" ,"احد عشر", "اثنعش","ثلاتعش", "اربعتعش", "خمستعش", "ستعش", "سبعتعش", "ثمنتعش", "تستعش"  );
   $b = array("","","عشرين", "ثلاثين", "اربعين", "خمسين", "ستين", "سبعين", "ثمنين", "تسعين");
   $c = array("", "ماية", "ماتين", "ثلاثماية", "اربع ماية", "خمس ماية", " ست ماية", "سبع ماية", "ثمان ماية", "تسع ماية"  );
   $d = array( "", "الف", "الفين", "ثلاثه الف", "اربعه الف", "خمسه الف", " سته الف", "سبعه الف", "ثمانية الف", "تسعه الف", "عشرا الف ", "احد عشر الف", "اثنا عشر الف","ثلاتة عشر الف ", "اربعة عشر الف ", "خمسة عشر الف ", "ستة عشر الف", "سبعة عشر الف ", "ثمانية عشر الف ", "تسعة عشر الف" );
   $E = array("", "", "عشرين الف", "ثلاثين الف ", " اربعين الف ", " خمسين الف ", " ستين الف ", "سبعين الف ", "ثمنين الف ", "تسعين الف " );
   $F = array( "", "مليون", "اثنين مليون", "ثلاثه مليون", "اربعه مليون", "خمسه مليون", " سته مليون", "سبعه مليون", "ثمانية مليون", "تسعه مليون","عشرا مليون ", "احد عشر مليون", "اثنا عشر مليون","ثلاتة عشر مليون ", "اربعة عشر مليون ", "خمسة عشر مليون ", "ستة عشر مليون", "سبعة عشر مليون ", "ثمانية عشر مليون ", "تسعة عشر مليون" );
   $H = array("", "", "عشرين مليون", "ثلاثين مليون ", " اربعين مليون ", " خمسين مليون ", " ستين مليون ", "سبعين مليون ", "ثمنين مليون ", "تسعين مليون ");
  
   $J = array("", "ماية مليون ", "ماتين مليون ", "ثلاث ماية مليون ", " اربع ماية مليون ", "خمس ماية مليون", " ست ماية مليون", "سبع ماية مليون","ثمان ماية مليون", "تسع ماية مليون " );
   $Y = array("", "ترليون", "اثنين ترليون", "ثلاثه ترليون", "اربعه ترليون", "خمسه ترليون", " سته ترليون", "سبعه ترليون", "ثمانية ترليون", "تسعه ترليون",   "عشرا ترليون ", "احد عشر ترليون", "اثنا عشر ترليون","ثلاتة عشر ترليون ", "اربعة عشر ترليون ", "خمسة عشر ترليون ", "ستة عشر ترليون", "سبعة عشر ترليون ", "ثمانية عشر ترليون ", "تسعة عشر ترليون" );
      //دالة ما فوق الترليون
      if ($n > 99999999)
      {
          $divid = $n / 1000000000;
          $n = $n % 1000000000;
          for ( $i = 0; $i < 20; $i++)
          {
              if ($i == intval($divid))
              {
                  $v11 = $Y[$i];
              }
          }
      } 
      //دالة ما فوق الماية المليون
      if ($n >9999999)
      {
          $divid = $n / 100000000;
          if ($n % 100000000 < 1000000)
          {
              for ( $i = 0; $i < 10; $i++)
              {
                  if ($i == intval($divid))
                  {
                      $v10 = $J[$i];
                  }
              }
          }
          else
          {
              $n = $n % 100000000;
              for ( $i = 0; $i < 10; $i++)
              {
                  if ($i == intval($divid))
                  {
                      $v10 = $c[$i];
                      $v9 = $H[$i];
                  }
              }
          }
      }
      //دالة ما فوق العشربن المليون 
      if ($n > 19999999)
      {
          $divid = $n / 10000000;
          $n = $n % 10000000;
          for ( $i = 0; $i < 10; $i++)
          {
              if ($i == intval($divid))
              {
                  $v9 = $H[$i];
                
              }
          }
      }

      //دالة ما فوق المليون
      if ($n > 999999)
      {
          $divid = $n / 1000000;
          $n = $n % 1000000;
          for ( $i = 0; $i < 20; $i++)
          {
              if ($i == intval($divid))
              {
                  $v7 = $F[$i];
                  $v8 = $a[$i];
              }
          }
      } 

      //دالة مافوق الماية الالف
      if ($n > 99999)
      {
          $divid = $n / 100000;
          if ($n % 100000 == 0)
          {
              for ( $i = 0; $i < 10; $i++)
              {
                  if ($i == intval($divid))
                  {
                      $v6 = $G[$i];
                  }
              }
          }
          else
          {
              $n = $n % 100000;
              for ( $i = 0; $i < 10; $i++)
              {
                  if ($i == intval($divid))
                  {
                      $v6 = $c[$i];
                  }
              }
          }
      }
      // دالة ما فوق العشرسن الالف 
      if ($n > 19999)
      { 
          $divid = $n / 10000;
        
          $n = $n % 10000;
          for ( $i = 0; $i < 10; $i++)
          {
              if ($i==intval($divid))
              {
                $v4= $E[$i];
              }
          }
      } 
      //دالة ما فوق الاف 
      if ($n > 999)
      {
          $divid = $n / 1000;
          $n = $n % 1000;
          for ( $i = 0; $i < 20; $i++)
          {
              if ($i == intval($divid))
              {
                  $v3 = $d[$i];
                  $v5 = $a[$i];
              }
          }
      }
      //دالة ما فوق الماية
      if ($n > 99)
      {

          $divid = $n / 100;
          $n = $n % 100;
          for ( $i = 0; $i < 10; $i++)
          {
              if ($i == intval($divid))
              {
                  $v2 = $c[$i];
              }

          }

      }
      //دالة ما فةق العشرين
      if ($n >20 or $n==20)
      {
          $divid = $n / 10;
          $n = $n % 10;

          for ( $j = 0; $j < 10; $j++)
          {
              if ($j == intval($divid))
              {
                  $v1 = $b[$j];

              }
          }
      }
     
      //دلة ما تحت العشرين
      for ( $i = 0; $i < 20; $i++)
      {

          if ($i == $n)
          {
              $v =$a[$i];

          }
      }



      //تخرج ما فوق الترليون
      if ($len > 999999999)
      {
          $result = $v11 ." " .$v10 ."  " .$v8 ." " .$v9 ." " .$v6 ." " .$v5 ." " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal;
          return $result;

      }
      //تخرج ما فوق ماية مليون
      if ($len > 99999999)
      {
          $result = $v10 ."  " .$v8 ." " .$v9 ." " .$v6 ." " .$v5 ." " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal;
          return $result;

      }
      //تخرج ما تحت العشرين الالف 
      if ($len < 20000)
      {  
          $result = $v3 . $v2 . $v . $v1 . " " .$ryal;
          return $result;
      } 

      //تخرج ما فوق العشرين المليون
      if ($len > 19999999)
      {   
        return  $v8 ." " . $v9 ." " .$v6 ." " .$v5 ." " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal;
        
      }
      //تخرج ما فوق العشرين الالف
      if ($len > 20000 or $len==20000) {return  $v7 . " " . $v6 ." " . $v5 . " " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal; }
      
     

     /* $v; 
     $v1;
    $v2;
     $v3;
     $v4;
     $v5;
     $v6;
     $v7;
     $v8;
     $v9;
     $v10;
    $v11;*/
   /* $V7='VDHG';
    //متغير الي تعريف نوع العملة
    $ryal = "ريال";
    //متغير لي استخدامة في عملية الاخراج
    $len = $n; 
     //متغير لي حمل عملية القسمة 
     global $divid;
    $n = str_replace(array(',', ''), '' , trim($n));
    if(! $n) {
        return false;
    }
    $n = (int) $n;
    $words = array();
   
    $num_length = strlen($n);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $n = substr('00' . $n, -$max_length);
    $num_levels = str_split($n, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
              switch($n){
         case $n > 99999999:
            $divid = $n / 1000000000;
            $n = $n % 1000000000;
            for ( $i = 0; $i < 20; $i++)
            {
                if ($i == $divid)
                {
                 $GLOBALS['v11']  = $Y[$i];
                }
            };
            break;
            case $n > 99999999:
                $divid = $n / 100000000;
                if ($n % 100000000 < 1000000)
                {
                    for ( $i = 0; $i < 10; $i++)
                    {
                        if ($i == $divid)
                        {
                            $GLOBALS['v10'] = $J[$i];
                        }
                    }
                }
                else
                {
                    $n = $n % 100000000;
                    for ( $i = 0; $i < 10; $i++)
                    {
                        if ($i == $divid)
                        {
                             $GLOBALS['v10']= $c[$i];
                             $GLOBALS['v9'] = $H[$i];
                        }
                    }
                }
                break;
                case $n > 1999999:
                    $divid = $n / 10000000;
                    $n = $n % 10000000;
                    for ( $i = 0; $i < 10; $i++)
                    {
                        if ($i == $divid)
                        {
                             $GLOBALS['v9']  = $H[$i];
                        }
                    }
                    break;
                    case $n > 999999:
                        $divid = $n / 1000000;
                        $n = $n % 1000000;
                        for ( $i = 0; $i < 20; $i++)
                        {
                            if ($i == $divid)
                            {
                                 $GLOBALS['v7']  = $F[$i];
                                 $GLOBALS['v8']  = $a[$i];
                            }
                        }
                        break;
                        case $n > 99999:
                            $divid = $n / 100000;
                            if ($n % 100000 == 0)
                            {
                                for ( $i = 0; $i < 10; $i++)
                                {
                                    if ($i == $divid)
                                    {
                                         $GLOBALS['v6']  = $G[$i];
                                    }
                                }
                            }
                            else
                            {
                                $n = $n % 100000;
                                for ( $i = 0; $i < 10; $i++)
                                {
                                    if ($i == $divid)
                                    {
                                         $GLOBALS['v6']    = $c[$i];
                                    }
                                }
                            }
                            break;
                            case $n > 19999:
                                $divid = $n / 10000;
                                $n = $n % 10000;
                                for ( $i = 0; $i < 10; $i++)
                                {
                                    if ($i == $divid)
                                    {
                                         $GLOBALS['v4']   = $E[$i];
                                    }
                                }
                                break;
                                case $n > 20:
                                
                                    $divid = $n / 10;
                                    $n = $n % 10;
                          
                                    for ( $j = 0; $j < 10; $j++)
                                    {
                                        if ($j == $divid)
                                        {
                                             $GLOBALS['v1'] = $b[$j];
                          
                                        }
                                    }
                                    break;
                                   default:
                                    for ( $i = 0; $i < 20; $i++)
                                      {    if ($i == $n)   {
                                         $GLOBALS['$v']= $a[$i];

                                                            }
                                     }   }   }*/
                  //تخرج ما تحت العشرين الالف 
              

   /*   if ($len < 20000)
      {
          $result = $v3 . $v2 . $v . $v1 . " " .$ryal;
          return $result;
      }
      //تخرج ما فوق العشرين الالف
      if ($len > 20000) { $result = $v7 . " " . $v6 ." " . $v5 . " " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal; }
      //تخرج ما فوق العشرين المليون
      if ($len > 19999999)
      {
          $result = $v8 ." " .$v9 ." " .$v6 ." " .$v5 ." " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal;
          return $result;

      }
      //تخرج ما فوق ماية مليون
      if ($len > 99999999)
      {
          $result = $v10 ."  " .$v8 ." " .$v9 ." " .$v6 ." " .$v5 ." " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal;
          return $result;

      }
      //تخرج ما فوق الترليون
      if ($len > 999999999)
      {
          $result = $v11 ." " .$v10 ."  " .$v8 ." " .$v9 ." " .$v6 ." " .$v5 ." " .$v4 ." " .$v2 ." " .$v ." " .$v1 ." " .$ryal;
          return $result;

      }



        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : '' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' and ' . $list1[$tens] . ' ' : '' );
        } elseif ($tens >= 20) {
            $tens = (int)($tens / 10);
            $tens = ' and ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = implode(' ',  $words);
    $words = preg_replace('/^\s\b(and)/', '', $words );
    $words = trim($words);
    $words = ucfirst($words);
    $words = $words . ".";
    return $words;*/

  
}
