<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer_order;
use App\Models\Customer;
use App\Models\Sales_invoices;

class DashboardController extends Controller
{
    //
    public function index(){
        $com_code = auth()->user()->com_code;
        $order_data;
        $order_data['all'] =count(get_cols_where(new customer_order(), array("id"), array("com_code"=>$com_code)));
        $order_data['new'] =count( get_cols_where(new customer_order(), array("id"), array("is_approved"=>1)));
        $order_data['Customer'] =count( get_cols_where(new Customer(), array("id"), array("com_code"=>$com_code)));
        $order_data['Sales_invoices'] =count( get_cols_where(new Sales_invoices(), array("id"), array("com_code"=>$com_code)));
      return view('admin.homepage',['order_data'=>$order_data]);
    }
    public function for_change_page(){
        auth()->logout();
        return redirect()->route('admin.homepage');    }
    
   
    public function ajax_check_order (Request $request)
    {    $data =get_cols_where(new customer_order(), array("id"), array("is_approved"=>5));
        if (empty(($data))) {
        return json_encode('not_allowed');
    }else{ $count=0;

        foreach ($data as $info){
            $count++;

        }
        return json_encode($count);
    }
    
    }
    
}
