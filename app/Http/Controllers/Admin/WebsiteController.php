<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sales_invoices;
use App\Models\Admin;
use App\Models\Sales_matrial_types;
use App\Models\Customer;
use App\Models\Inv_itemcard;
use App\Models\Inv_itemcard_batches;
use App\Models\Inv_uom;
use App\Models\Stores;
use App\Models\Treasuries_transactions;
use App\Models\Treasuries;
use App\Models\Admins_Shifts;
use App\Models\Sales_invoices_details;
use App\Models\Inv_itemcard_movements;
use App\Models\Account;
use App\Models\Supplier;
use App\Models\Suppliers_with_orders;
use App\Models\SalesReturn;
use App\Models\Admin_panel_settings;
use App\Models\services_with_orders;
use App\Models\itemcard_photos;
use App\Models\inv_itemcard_categorie;
use App\Models\custmoer_favorite_itemcard;
use App\Models\customer_order;
use App\Models\customer_order_details;
use App\Http\Requests\ItemcardRequest;
use App\Http\Requests\ItemcardRequestUpdate;

class WebsiteController extends Controller
{ 
 public function index_for()
{  
   $com_code=auth()->user()->com_code;
   $data = get_cols_where(new Inv_itemCard(), array("*"), array("com_code" => $com_code), 'id', 'DESC');
   if (!empty($data)) {
     foreach($data as $info) {
        $info->photo= get_field_value(new itemcard_photos(), "photos1", array("itemcard_id" =>$info->item_code));
        $info->favorite= get_field_value(new custmoer_favorite_itemcard(), "id", array("itemcard_id" =>$info->id));
        }}

        $order_data['Numbers_vist']= get_field_value(new Admin_panel_settings(), "Numbers_vist", array("id" =>$com_code));
        $order_data['counter'] = get_count_where(new customer_order() ,array("com_code"=>$com_code));
       $order_data['Customer'] = count(get_cols_where(new Customer(), array("id"), array("com_code"=>$com_code)));
         return view('frontend.homepage',['data' => $data  ,'order_data'=>$order_data] );
}

public function shows($id)

{   $com_code=auth()->user()->com_code;
  $id_user=auth()->user()->id;

  $data = get_cols_where_row(new Inv_itemCard(), array("*"), array("id" => $id));
  $order_data = get_cols_where_row(new customer_order(), array("*"), array("com_code" => $com_code,"is_approved"=>0, "customer_code" =>$id_user));
 // $order_data->system_name= get_field_value(new Admin_panel_settings(), "system_name", array("id" =>$com_code));

          $photo = get_cols_where_row(new itemcard_photos(), array("*"), array("itemcard_id" => $id));
       return view('admin.inv_itemCard_for_web_order.show' ,['data' => $data ,'photo'=>$photo ,'order_data'=>$order_data] );
}

public function Add_custmoer_favorite_itemcard($id)
{$id_user=auth()->user()->id;

     try{$com_code=auth()->user()->com_code;
      $data = get_cols_where_row(new custmoer_favorite_itemcard(), array("*"), array("itemcard_id" =>$id));
if(!empty($data)){
  return redirect()->back()->with(['error' => '   عفوا لقد  تم اضافة هذا الصنف  من قبل  ']);

}
  $data_insert['itemcard_id'] = $id;
  $data_insert['customer_id'] =$id_user;
  $data_insert['created_at'] = date("Y-m-d H:i:s");
  $data_insert['com_code'] = $com_code;
  custmoer_favorite_itemcard::create($data_insert);
  return redirect()->back()->with(['success' => '   لقد تم اضافة الصنف  بنجاح للقائمة لمفضلة']);
    }  catch (\Exception $ex) {
             return redirect()->back()
                   ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
                   ->withInput();  }
}


public function load_modal_addorder(Request $request)
{$id_user=auth()->user()->id;

$com_code = auth()->user()->com_code;
if ($request->ajax()) {
  $data = get_cols_where_row(new Inv_itemCard(), array("*"), array("id" =>$request->itemcard_id));
  $data->name_catagr = get_field_value(new inv_itemcard_categorie(), "name", array("com_code" => $com_code, "id" => $data->inv_itemcard_categories_id));
  $photo = get_cols_where_row(new itemcard_photos(), array("*"), array("itemcard_id" =>$request->itemcard_id ));
  $checkExists_barcode = customer_order::where(['is_approved' =>0, 'customer_code' => $id_user, 'com_code'=>$com_code])->first();
  if (empty($checkExists_barcode)) {
  $data_insert['invoice_date'] = date("Y-m-d H:i:s");
  $data_insert['customer_code'] =$id_user;
  $data_insert['is_approved'] =0;
   $data_insert['added_by'] = auth()->user()->id;
  $data_insert['created_at'] = date("Y-m-d H:i:s");
   $data_insert['com_code'] = $com_code;
  $val= customer_order::create($data_insert);
return view("admin.inv_itemCard_for_web_order.load_modal_addActiveInvoice", ['data' => $data ,'photo'=>$photo]);

}else{
  return view("admin.inv_itemCard_for_web_order.load_modal_addActiveInvoice", ['data' => $data ,'photo'=>$photo ]);


}
  }
}
public function Add_custmoer_order(Request $request)
{$com_code = auth()->user()->com_code;$id_user=auth()->user()->id;

if ($request->ajax()) {
    
$checkExists= customer_order::where(['is_approved' =>0, 'customer_code' => $id_user, 'com_code'=>$com_code])->first();
if (!empty($checkExists)) {
  $checkExists_barcode = customer_order_details::where(['item_code' => $request->id,"customer_order_id"=>$checkExists->id])->first();
  if (empty($checkExists_barcode)) {
  $data_insert_to_d['customer_order_id'] = $checkExists->id;
$data_insert_to_d['item_code'] =$request->id;
$data_insert_to_d['quantity'] =$request->item_quantity;
$data_insert_to_d['total_price'] =$request->item_total;
$data_insert_to_d['added_by'] = auth()->user()->id;
$data_insert_to_d['created_at'] = date("Y-m-d H:i:s");
customer_order_details::create($data_insert_to_d);
$data_to_update['total_cost']=$checkExists['total_cost']+$request->item_total;
$data_to_update['total_cost_items']=$checkExists['total_cost_items']+$request->item_quantity;
update(new customer_order(), $data_to_update, array( 'id' => $checkExists->id));
return json_encode('allowed');

}else{
  return json_encode('not_allowed');

}}

}

} 

public function load_orders_modal(Request $request)
{     $id_user=auth()->user()->id;

  if ($request->ajax()) {
    $com_code = auth()->user()->com_code;
    $order_data = get_cols_where_row(new customer_order(), array("*"), array("com_code" => $com_code,"is_approved"=>0, "customer_code" =>$id_user));
    if (empty($order_data)) {
      $order_data = get_cols_where_row(new customer_order(), array("*"), array("com_code" => $com_code,"is_approved"=>1, "customer_code" =>$id_user), 'id', 'DESC');
      if (empty($order_data)){

        $order_data = get_cols_where_row(new customer_order(), array("*"), array("com_code" => $com_code,"is_approved"=>2, "customer_code" =>$id_user), 'id', 'DESC');  
      }
    }
    if (!empty($order_data)) {
      $customer_order_details = get_cols_where(new customer_order_details(), array("*"), array("customer_order_id" => $order_data->id));
      foreach ($customer_order_details  as $info) {
      $info->item_name = get_field_value(new Inv_itemcard(), "name", array("com_code" => $com_code, "item_code" => $info->item_code));
      $info->photo = get_field_value(new itemcard_photos(),"photos1", array("itemcard_id" =>$info->item_code ));
    }      $order_data->added_by_admin = Admin::where('id', $order_data->approved_by)->value('name');

  }
    }
    return view("admin.inv_itemCard_for_web_order.load_order_details_modal", ['order_data' => $order_data, 'customer_order_details' => $customer_order_details ]);
    }


public function load_order_update_modal(Request $request)
{
 if ($request->ajax()) {
$com_code = auth()->user()->com_code;
$customer_order_details = get_cols_where_row(new customer_order_details(), array("*"), array("id" => $request->id));
if(!empty($customer_order_details)){
  $item_name = get_cols_where_row(new Inv_itemcard(), array("name","price"), array("id" => $customer_order_details['item_code']));
  $photo = get_cols_where_row(new itemcard_photos(), array("*"), array("itemcard_id" => $customer_order_details['item_code']));
  
}

return view("admin.inv_itemCard_for_web_order.load_order_update_modal", ['customer_order_details' => $customer_order_details,'item_name'=>$item_name,'photo'=>$photo]);}
}

public function update_order(Request $request)
{$com_code = auth()->user()->com_code;
  $id_user=auth()->user()->id;

  if ($request->ajax()) {

  $checkExists_barcode = customer_order_details::where(['id' => $request->id,])->first();
  if (!empty($checkExists_barcode)) {
$data_insert_to_d['quantity'] =$request->item_quantity;
$data_insert_to_d['total_price'] =$request->item_total;
$data_insert_to_d['updated_at'] = date("Y-m-d H:i:s");
//$data_insert_to_d['updated_by'] = auth()->user()->id;

update(new customer_order_details(), $data_insert_to_d, array( 'id' => $request->id));
/************************************* */  
$data=get_cols_where_row(new customer_order(),array("*"),array("customer_code"=>$id_user,"is_approved"=>0,"id"=>$checkExists_barcode->customer_order_id) );
if (!empty($checkExists_barcode)) {
  $data['total_cost']= 0;
  $data['total_cost_items']=0;
  $data_to_update=get_cols_where_p(new customer_order_details(),array("*"),array("customer_order_id"=>$data->id) );
  foreach($data_to_update as $info){
 $data['total_cost']=$data['total_cost']+  $info['total_price'];
  $data['total_cost_items']=$data['total_cost_items']+ $info['quantity'];

 }

 $data_update['total_cost']= $data['total_cost'];
 $data_update['total_cost_items']= $data['total_cost_items'];
 update(new customer_order(), $data_update, array( 'id' => $checkExists_barcode->customer_order_id));
return json_encode('allowed');
}else{
    return json_encode('not_allowed');
}
  }
  }
}

function remove_active_row_item(Request $request)
{
 if ($request->ajax()) {
$com_code = auth()->user()->com_code;
$customer_order_details = get_cols_where_row(new customer_order_details(), array("*"), array( "id" => $request->id));

$order_data = get_cols_where_row(new customer_order(), array("*"), array("com_code" => $com_code,"is_approved"=>0, "id" => $customer_order_details->customer_order_id));
if (!empty($order_data)) {
if (!empty($customer_order_details)) {
  $data_update['total_cost']=$order_data['total_cost']- $customer_order_details['total_price'];
  $data_update['total_cost_items']=$order_data['total_cost_items']-$customer_order_details['quantity'];
//حذف السطر من تفاصيل الفاتورة
$flag = delete(new customer_order_details(), array( "id" => $request->id));
if ($flag) {
  update(new customer_order(), $data_update, array( 'id' => $customer_order_details->customer_order_id));

  return  json_encode($customer_order_details->customer_order_id);
}
}
}
}
}

public function delete_order($id)
{
 try {
 $com_code = auth()->user()->com_code;
 $order_data = get_cols_where_row(new customer_order(), array("*"), array("id" => $id,"com_code" => $com_code));
  if (empty($order_data)) {
    return redirect()->back()
    ->with(['error' => 'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
}

if ($order_data['is_approved']==1) {
    return redirect()->back()
->with(['error' => 'عفوا لايمكن حذف فاتورة معتمدة ومؤرشفة !!']);
}

$flag = delete(new customer_order(), array("id" => $id, "com_code" => $com_code));
if ($flag) {
    return redirect()->back()
    ->with(['success' => '   تم حذف البيانات بنجاح']);
    
} else {
return redirect()->back()
->with(['error' => 'عفوا حدث خطأ ما']);
}
 
} catch (\Exception $ex) {
return redirect()->back()
->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
}
}

public function remove_favorite_item($id)
  {
  try {
  $com_code = auth()->user()->com_code;
  $order_data = get_cols_where_row(new custmoer_favorite_itemcard(), array("*"), array("itemcard_id" => $id,"com_code" => $com_code));
  if (empty($order_data)) {
      return redirect()->back()
      ->with(['error' => 'عفوا غير قادر الي الوصول للبيانات المطلوبة']);
  }
  
  $flag = delete(new custmoer_favorite_itemcard(), array("itemcard_id" => $id, "com_code" => $com_code));
  if ($flag) {
      return redirect()->back()
      ->with(['success' => '   تم الازالة من القائمة المفضلة بنجاح']);
      
  } else {
  return redirect()->back()
  ->with(['error' => 'عفوا حدث خطأ ما']);
  }
   
  } catch (\Exception $ex) {
  return redirect()->back()
  ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()]);
  }
  }
  

 function send_order(Request $request)
{
 if ($request->ajax()) {
$com_code = auth()->user()->com_code;
  $order_data['is_approved'] =1;
update(new customer_order(), $order_data, array( 'id' => $request->id));
 
$flag = delete(new customer_order_details(), array( "id" => $request->id));
check_for_show_order();

  return  json_encode($request->id);

}
}


public function load_invoice_order_modal(Request $request)
{
if ($request->ajax()) {
$com_code = auth()->user()->com_code;
$invoice_order_data = get_cols_where_row(new customer_order(), array("*"), array("com_code" => $com_code, "id" => $request->auto_serial));
$stores = get_cols_where(new Stores(), array("id", "name"), array("com_code" => $com_code, "active" => 1), 'id', 'ASC');
$user_shift = get_user_shift(new Admins_Shifts(), new Treasuries(), new Treasuries_transactions());
$customers = get_field_value(new Customer(),  "name", array("com_code" => $com_code, "id" => $invoice_order_data['customer_code']));
$Sales_matrial_types = get_cols_where(new Sales_matrial_types(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
$sales_order_details = get_cols_where(new customer_order_details(), array("*"), array( "customer_order_id" => $request->auto_serial));
if (!empty($sales_order_details)) {
foreach ($sales_order_details  as $info) {
//$info->store_name = get_field_value(new Stores(), "name", array("com_code" => $com_code, "id" => $info->store_id));
$info->item_name = get_field_value(new Inv_itemcard(), "name", array("com_code" => $com_code, "item_code" => $info->item_code));
}
}
return view("admin.inv_itemCard_for_web_order.create", ['stores' => $stores, 'user_shift' =>
$user_shift, 'customers' => $customers, 'Sales_matrial_types' => $Sales_matrial_types, 'invoice_data' => $invoice_order_data, 'sales_invoices_details' => $sales_order_details]);
}
}

public function get_item_batches(Request $request)
{
   $com_code = auth()->user()->com_code;
     if ($request->ajax()) {
         $sales_order_details = get_cols_where(new customer_order_details(), array("*"), array( "customer_order_id" =>$request->item_code));
       if (!empty($sales_order_details)) {
    foreach ($sales_order_details  as $info) {
      $info->item_name = get_field_value(new Inv_itemcard(), "name", array("com_code" => $com_code, "item_code" => $info->item_code));
      $info->stores_name = get_field_value(new Stores(),  "name", array("com_code" => $com_code, "id" => $request->store_id));
    $info->itemcard_batches = get_field_value(new Inv_itemcard_batches(), "quantity", array("com_code" => $com_code, "item_code" => $info->item_code,'store_id' => $request->store_id));
    }}

    return view("admin.inv_itemCard_for_web_order.ajax_search_movements", ['sales_invoices_details' => $sales_order_details]);
}
}


function DoApproveInvoiceFinally(Request $request)
{
if ($request->ajax()) {
 $com_code = auth()->user()->com_code;
 $invoice_data = get_cols_where_row(new customer_order(), array("*"), array("com_code" => $com_code, "id" => $request->id_order));
if (!empty($invoice_data)) {

 $last_auto_serial_Date = get_cols_where_row_orderby(new Sales_invoices(), array("auto_serial"), array("com_code" => $com_code), 'id', 'DESC');
 if (!empty($last_auto_serial_Date)) {
 $data_insert['auto_serial'] = $last_auto_serial_Date['auto_serial'] + 1;
  } else {
    $data_insert['auto_serial'] = 1;
    }
 $data_insert['invoice_date'] =$invoice_data['invoice_date'];
 $data_insert['is_has_customer'] =1;
 $data_insert['customer_code'] =$invoice_data->customer_code;
 $data_insert['money_for_account'] = $invoice_data['total_cost'];
 $data_insert['sales_item_type']=1;
 $data_insert['sales_matrial_types'] = 6;
 $data_insert['pill_type'] = $request->pill_type;
 $data_insert['total_cost_items'] = $invoice_data->total_cost_items;
 $data_insert['total_cost'] = $invoice_data->total_cost;
 $data_insert['added_by'] = auth()->user()->id;
 $data_insert['created_at'] = date("Y-m-d H:i:s");
 $data_insert['date'] = date("Y-m-d");
 $data_insert['com_code'] = $com_code;
  $flag=  insert(new Sales_invoices(), $data_insert, false);
$invoice_datas = get_cols_where_row(new Sales_invoices(), array("is_approved", "sales_item_type","invoice_date","is_has_customer", "customer_code","id"), array("com_code" => $com_code, "id" => $flag->id));
if (!empty($invoice_datas)) {
if ($invoice_datas['is_approved'] == 0) {
 $details_order=get_cols_where(new customer_order_details(),array("*"),array("customer_order_id"=> $request->id_order));
 
 foreach ($details_order as $info){
    $last_auto_serial_Date = get_cols_where_row_orderby(new Sales_invoices_details(), array("sales_invoices_auto_serial"), array("com_code" => $com_code), 'id', 'DESC');
    if (!empty($last_auto_serial_Date)) {
    $datainsert_items['sales_invoices_auto_serial'] = $last_auto_serial_Date['sales_invoices_auto_serial'] + 1;
     } else {
      $datainsert_items['sales_invoices_auto_serial'] = 1;
       } 
       $batch_data = get_cols_where_row(new Inv_itemcard_batches(), array("quantity", "unit_cost_price", "id","inv_uoms_id"), array("com_code" => $com_code, 'store_id' => $request->store_id, 'item_code' => $info->item_code));
       $itemCard_Data = get_cols_where_row(new Inv_itemcard(), array("uom_id", "retail_uom_quntToParent", "retail_uom_id", "does_has_retailunit"), array("com_code" => $com_code, "item_code" => $info->item_code));

       $MainUomName = get_field_value(new Inv_uom(), "name", array("com_code" => $com_code, "id" => $itemCard_Data['uom_id']));

       $datainsert_items['sales_invoices_id'] = $invoice_datas['id'];
       $datainsert_items['store_id'] = $request->store_id;
       $datainsert_items['invoice_date'] = $invoice_datas['invoice_date'];
       $datainsert_items['sales_item_type'] = $invoice_datas['sales_item_type'];
       $datainsert_items['item_code'] = $info->item_code;
       $datainsert_items['uom_id'] =1;
       $datainsert_items['batch_auto_serial'] = $batch_data->id;
       $datainsert_items['itemCostPriceFromBatah'] = $batch_data['unit_cost_price'];
      $datainsert_items['taoalitemCostPriceFromBatah'] = round ($batch_data['unit_cost_price']* $info->quantity,2);
      $datainsert_items['item_total_earnings'] =round( $info->total_price-($batch_data['unit_cost_price']* $info->quantity),2);
      $datainsert_items['quantity'] = $info->quantity;
      $datainsert_items['unit_price'] = $info->total_price/$info->quantity;
      $datainsert_items['is_normal_orOther'] = 1;
      $datainsert_items['total_price'] = $info->total_price;
      $datainsert_items['isparentuom'] =1;
      $datainsert_items['added_by'] = auth()->user()->id;
      $datainsert_items['created_at'] = date("Y-m-d H:i:s");
      $datainsert_items['date'] = date("Y-m-d");
      $datainsert_items['com_code'] = $com_code;
      $flag_datainsert_items = insert(new Sales_invoices_details(), $datainsert_items, true);
      if (!empty($flag_datainsert_items)) {
//خصم الكمية من الباتش 
//كمية الصنف بكل المخازن قبل الحركة
$quantityBeforMove = get_sum_where(
  new Inv_itemcard_batches(),
  "quantity",
  array(
  "item_code" => $info->item_code,
  "com_code" => $com_code
  )
  );
  //get Quantity Befor any Action  حنجيب كيمة الصنف  بالمخزن المحدد معه   الحالي قبل الحركة
$quantityBeforMoveCurrntStore = get_sum_where(
  new Inv_itemcard_batches(),
  "quantity",
  array(
  "item_code" => $request->item_code, "com_code" => $com_code,
  'store_id' => $request->store_id
  )
  );
  //هنا حخصم الكمية لحظيا من باتش الصنف
//update current Batch تحديث علي الباتش القديمة
  $dataUpdateOldBatch['quantity'] = $batch_data['quantity'] - $info->quantity;
  $dataUpdateOldBatch['total_cost_price'] = $batch_data['unit_cost_price'] * $dataUpdateOldBatch['quantity'];
  $dataUpdateOldBatch["updated_at"] = date("Y-m-d H:i:s");
  $dataUpdateOldBatch["updated_by"] = auth()->user()->id;
  $flag = update(new Inv_itemcard_batches(), $dataUpdateOldBatch, array("id" => $batch_data['id'], "com_code" => $com_code));
if ($flag) {
  $quantityAfterMove = get_sum_where(
  new Inv_itemcard_batches(),
  "quantity",
  array(
  "item_code" => $info->item_code,
  "com_code" => $com_code
  )
  );
  //get Quantity Befor any Action  حنجيب كيمة الصنف  بالمخزن المحدد معه   الحالي بعد الحركة
$quantityAfterMoveCurrentStore = get_sum_where(
  new Inv_itemcard_batches(),
  "quantity",
  array("item_code" => $request->item_code, "com_code" => $com_code, 'store_id' => $request->store_id)
  );
//التاثير في حركة كارت الصنف
 $dataInsert_inv_itemcard_movements['inv_itemcard_movements_categories'] = 2;
 $dataInsert_inv_itemcard_movements['items_movements_types'] = 4;
 $dataInsert_inv_itemcard_movements['item_code'] = $info->item_code;
//كود الفاتورة الاب
  $dataInsert_inv_itemcard_movements['FK_table'] = $invoice_datas->id;
//كود صف الابن بتفاصيل الفاتورة
 $dataInsert_inv_itemcard_movements['FK_table_details'] = $flag_datainsert_items['id'];
 $customerName = get_field_value(new Customer(), "name", array("com_code" => $com_code, "id" => $invoice_datas['customer_code']));
 $dataInsert_inv_itemcard_movements['byan'] = "نظير مبيعات  للعميل " . " " . $customerName . " فاتورة رقم" . " " . $request->invoiceautoserial;
//كمية الصنف بكل المخازن قبل الحركة
$dataInsert_inv_itemcard_movements['quantity_befor_movement'] = "عدد " . " " . ($quantityBeforMove * 1) . " " . $MainUomName;
// كمية الصنف بكل المخازن بعد  الحركة
$dataInsert_inv_itemcard_movements['quantity_after_move'] = "عدد " . " " . ($quantityAfterMove * 1) . " " . $MainUomName;
//كمية الصنف  المخزن الحالي قبل الحركة
$dataInsert_inv_itemcard_movements['quantity_befor_move_store'] = "عدد " . " " . ($quantityBeforMoveCurrntStore * 1) . " " . $MainUomName;
// كمية الصنف بالمخزن الحالي بعد الحركة الحركة
$dataInsert_inv_itemcard_movements['quantity_after_move_store'] = "عدد " . " " . ($quantityAfterMoveCurrentStore * 1) . " " . $MainUomName;
$dataInsert_inv_itemcard_movements["store_id"] = $request->store_id;
$dataInsert_inv_itemcard_movements["created_at"] = date("Y-m-d H:i:s");
$dataInsert_inv_itemcard_movements["added_by"] = auth()->user()->id;
$dataInsert_inv_itemcard_movements["date"] = date("Y-m-d");
$dataInsert_inv_itemcard_movements["com_code"] = $com_code;
$flag = insert(new Inv_itemcard_movements(), $dataInsert_inv_itemcard_movements);
if ($flag) {
//update itemcard Quantity mirror  تحديث المرآه الرئيسية للصنف
do_update_itemCardQuantity(
new Inv_itemcard(),
$info->item_code,
new Inv_itemcard_batches(),
$itemCard_Data['does_has_retailunit'],
$itemCard_Data['retail_uom_quntToParent']
);
}
}}}
$customerData = get_cols_where_row(new Customer(), array("account_number"), array("com_code" => $com_code, "id" => $invoice_datas['customer_code']));
$dataUpdateParent['account_number'] = $customerData['account_number'];
$dataUpdateParent['is_approved'] = 1;
$dataUpdateParent['approved_by'] = auth()->user()->com_code;
$dataUpdateParent['updated_at'] = date("Y-m-d H:i:s");
$dataUpdateParent['updated_by'] = auth()->user()->com_code;
$dataUpdateParent['what_paid'] = $request->what_paid;
$dataUpdateParent['what_remain'] = $request->what_remain;
 update(new Sales_invoices(), $dataUpdateParent, array("com_code" => $com_code, "id" => $invoice_datas->id));

if ($invoice_datas['is_has_customer'] == 1) {
//Affect on Customer Finanical Account Balance
refresh_account_blance_customer($customerData["account_number"], new Account(), new Customer(), new Treasuries_transactions(), new Sales_invoices(),new SalesReturn(),new services_with_orders(), false);
}
}

  }}
  $data = get_cols_where_p(new Sales_invoices(), array("*"), array("com_code" => $com_code), "id", "DESC", PAGINATION_count);
  if (!empty($data)) {
  foreach ($data as $info) {
  $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
  $info->Sales_matrial_types_name = get_field_value(new Sales_matrial_types(), "name", array("com_code" => $com_code, "id" => $info->sales_matrial_types));
  if ($info->is_has_customer == 1) {
  $info->customer_name = get_field_value(new Customer(), "name", array("com_code" => $com_code, "customer_code" => $info->customer_code));
  } else {
  $info->customer_name = "بدون عميل";
  }
  }
 
  $order_data['is_approved'] =2;
  $order_data['approved_by'] =auth()->user()->id;
  update(new customer_order(), $order_data, array( 'id' => $request->id_order));
}
echo json_encode("done");

}
}


public function index()

    {
      $com_code = auth()->user()->com_code;
      $data = get_cols_where_row(new Customer(), array("*"), array("com_code" => $com_code ,"id"=>auth()->user()->id));
      if (!empty($data)) {
         $data->added_by_admin = Admin::where('id', $data->added_by)->value('name');
        if ($data->updated_by > 0 and $data->updated_by != null) {
        $data->updated_by_admin = Admin::where('id', $data->updated_by)->value('name');
    } }

    return view('admin.inv_itemCard_for_web_order.index', ['data' => $data]);
    }
}


    


  
  