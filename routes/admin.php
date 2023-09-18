<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\LoginController;
use App\Http\controllers\Admin\DashboardController;
use App\Http\controllers\Admin\Admin_panel_settingscontroller;
use App\Http\controllers\Admin\Treasuries_Controller;
use App\Http\controllers\Admin\Sales_matriatypeController;
use App\Http\controllers\Admin\Store_Controller ;
use App\Http\Controllers\Admin\Inv_UomController;
use App\Http\Controllers\Admin\Inv_itemcard_categories;
use App\Http\Controllers\Admin\InvItemCardController;
use App\Http\Controllers\Admin\AccountsController;
use App\Http\Controllers\Admin\Account_types_controller;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SupplierCategoriesController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\Suppliers_with_ordersController;
use App\Http\Controllers\Admin\Admins_ShiftsContoller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CollectController;
use App\Http\Controllers\Admin\ExchangeController;
use App\Http\Controllers\Admin\SalesInvoicesController;
use App\Http\Controllers\Admin\DelegatesController;
use App\Http\Controllers\Admin\Suppliers_with_ordersGeneralRetuen;
use App\Http\Controllers\Admin\ItemcardBalanceController;
use App\Http\Controllers\Admin\SalesReturnInvoicesController;
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\Services_with_ordersController;
use App\Http\Controllers\Admin\Inv_stores_inventoryController;

use App\Http\Controllers\Admin\Inv_stores_transferController;
use App\Http\Controllers\Admin\Inv_stores_transferIncomingController;
use App\Http\Controllers\Admin\permission_rolsController;
use App\Http\Controllers\Admin\permission_main_menuesController;
use App\Http\Controllers\Admin\permission_sub_menuesController;
use App\Http\Controllers\Admin\WebsiteController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  define('PAGINATION_count',10); 
    Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
           Route::get('login', [LoginController::class, 'show'])->name('admin.login');
            Route::post('login', [LoginController::class, 'checklogin'])->name('admin.login');
    });

        Route::group([ 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
            Route::get('/', [DashboardController::class, 'index'])->name('admin.homepage');
            Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
            Route::get('/adminpanelsettin/index', [Admin_panel_settingscontroller::class, 'show'])->name('admin.adminsettings');
            Route::get('/adminpanelsettin/edit', [Admin_panel_settingscontroller::class, 'edit'])->name('admin.adminsettings.edit');
            Route::post('/adminpanelsettin/update', [Admin_panel_settingscontroller::class, 'updated'])->name('admin.adminsettings.update');
          
            //start  TreasuriesPage...................
           
           Route::get('/TreasuriesPage/index', [Treasuries_Controller::class, 'show'])->name('admin.TreasuriesPage');
            Route::get('/TreasuriesPage/create', [Treasuries_Controller::class, 'create'])->name('admin.Treasuriescreate');
            Route::post('/TreasuriesPage/added', [Treasuries_Controller::class, 'added'])->name('admin.Treasuriesadded');
            Route::get('/TreasuriesPage/Edit{id}', [Treasuries_Controller::class, 'Edit'])->name('admin.TreasuriesEdit');
            Route::post('/TreasuriesPage/update{id}', [Treasuries_Controller::class, 'update'])->name('admin.Treasuries.update');
            Route::post('/TreasuriesPage/search', [Treasuries_Controller::class, 'search'])->name('admin.Treasuries.search');
            Route::get('/TreasuriesPage/Details{id}', [Treasuries_Controller::class, 'Details'])->name('admin.Treasuries.Details');
            Route::get('/Treasuries_Delivery/add{id}', [Treasuries_Controller::class, 'Treasuries_Delivery_add'])->name('admin.Treasuries_Delivery.add');
            Route::post('/Treasuries_Delivery/store{id}', [Treasuries_Controller::class, 'Treasuries_Delivery_Store'])->name('admin.Treasuries_Delivery_Store');
            Route::get('/Treasuries_Delivery/Delete{id}', [Treasuries_Controller::class, 'delete_treasuries_delivery'])->name('admin.delete_treasuries_delivery');

             //end  TreasuriesPage...................

           //start  sales_matrial_types...................
           Route::get('/sales_matrial_types/index', [Sales_matriatypeController::class, 'index'])->name('admin.sales_matrial_types.index');
           Route::get('/sales_matrial_types/create', [Sales_matriatypeController::class, 'create'])->name('admin.sales_matrial_types.create');
           Route::post('/sales_matrial_types/store', [Sales_matriatypeController::class, 'Sales_matrialstore'])->name('admin.Sales_matrialtype_Store');
           Route::get('/sales_matrial_types/Edit{id}', [Sales_matriatypeController::class, 'Edit'])->name('admin.Sales_matriatype.Edit');
           Route::post('/sales_matrial_types/update{id}', [Sales_matriatypeController::class, 'update'])->name('admin.Sales_matriatype.update');

            //end  sales_matrial_types...................

             //start  Stores...................
             Route::get('/Store/index', [Store_Controller::class, 'index'])->name('admin.stores.index');
             Route::get('/stores/create', [Store_Controller::class, 'create'])->name('admin.stores.create');
             Route::post('/stores/store', [Store_Controller::class, 'storesadd'])->name('admin.stores');
             Route::get('/stores/Edit{id}', [Store_Controller::class, 'Edit'])->name('admin.stores.Edit');
             Route::post('/stores/update{id}', [Store_Controller::class, 'update'])->name('admin.stores.update');

            //end  Stores...................

             //start  Uoms...................
             Route::get('/uoms/index', [Inv_UomController::class, 'index'])->name('admin.uoms.index');
             Route::get('/uoms/create', [Inv_UomController::class, 'create'])->name('admin.uoms.create');
             Route::post('/uoms/store', [Inv_UomController::class, 'store'])->name('admin.uoms.stores');
             Route::get('/uoms/edit/{id}', [Inv_UomController::class, 'edit'])->name('admin.uoms.edit');
             Route::post('/uoms/update/{id}', [Inv_UomController::class, 'update'])->name('admin.uoms.update');
             Route::get('/uoms/delete/{id}', [Inv_UomController::class, 'delete'])->name('admin.uoms.delete');
             Route::post('/uoms/ajax_search', [Inv_UomController::class, 'ajax_search'])->name('admin.uoms.ajax_search');   Route::get('/Uoms/index', [inv_uomController::class, 'index'])->name('admin.Uoms.index');
            
            //end  Uoms...................

          //start  inv_itemcard_categorage...................
            Route::resource('/inv_itemcard_categories', Inv_itemcard_categories::class);
        //end  inv_itemcard_categorage.....................

     //start  inv_itemcard..................
        Route::get('/itemcard/index', [InvItemCardController::class, 'index'])->name('admin.itemcard.index');
        Route::get('/itemcard/create', [InvItemCardController::class, 'create'])->name('admin.itemcard.create');
        Route::post('/itemcard/store', [InvItemCardController::class, 'store'])->name('admin.itemcard.store');
        Route::get('/itemcard/edit/{id}', [InvItemCardController::class, 'edit'])->name('admin.itemcard.edit');
        Route::post('/itemcard/update/{id}', [InvItemCardController::class, 'update'])->name('admin.itemcard.update');
        Route::get('/itemcard/delete/{id}', [InvItemCardController::class, 'delete'])->name('admin.itemcard.delete');
        Route::post('/itemcard/ajax_search', [InvItemCardController::class, 'ajax_search'])->name('admin.itemcard.ajax_search');
        Route::get('/itemcard/show/{id}', [InvItemCardController::class, 'show'])->name('admin.itemcard.show');
        Route::post('/itemcard/ajax_search_movements', [InvItemCardController::class, 'ajax_search_movements'])->name('admin.itemcard.ajax_search_movements');
        Route::post('/itemcard/ajax_check_barcode', [InvItemCardController::class, 'ajax_check_barcode'])->name('admin.itemcard.ajax_check_barcode');
        Route::post('/itemcard/ajax_check_name', [InvItemCardController::class, 'ajax_check_name'])->name('admin.itemcard.ajax_check_name');
        Route::get('/itemcard/generate_barcode/{id}', [InvItemCardController::class, 'generate_barcode'])->name('admin.itemcard.generate_barcode');

        //end  inv_itemcard.....................

      /*         start  account types .......................             */
Route::get('/accountTypes/index', [Account_types_controller::class, 'index'])->name('admin.accountTypes.index');
/*           end account types.................                */

/*         start  accounts .................................               */
Route::get('/accounts/index', [AccountsController::class, 'index'])->name('admin.accounts.index');
Route::get('/accounts/create', [AccountsController::class, 'create'])->name('admin.accounts.create');
Route::post('/accounts/store', [AccountsController::class, 'store'])->name('admin.accounts.store');
Route::get('/accounts/edit/{id}', [AccountsController::class, 'edit'])->name('admin.accounts.edit');
Route::post('/accounts/update/{id}', [AccountsController::class, 'update'])->name('admin.accounts.update');
Route::get('/accounts/delete/{id}', [AccountsController::class, 'delete'])->name('admin.accounts.delete');
Route::post('/accounts/ajax_search', [AccountsController::class, 'ajax_search'])->name('admin.accounts.ajax_search');
Route::get('/accounts/show/{id}', [AccountsController::class, 'show'])->name('admin.accounts.show');
/*           end accounts ...............................               */

//        start  Customer .................................              
Route::get('/Customer/index', [CustomerController::class, 'index'])->name('admin.Customer.index');
Route::get('/Customer/create', [CustomerController::class, 'create'])->name('admin.Customer.create');
Route::post('/Customer/store', [CustomerController::class, 'store'])->name('admin.Customer.store');
Route::get('/Customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin.Customer.edit');
Route::post('/Customer/update/{id}', [CustomerController::class, 'update'])->name('admin.Customer.update');
Route::get('/Customer/delete/{id}', [CustomerController::class, 'delete'])->name('admin.Customer.delete');
Route::post('/Customer/ajax_search', [CustomerController::class, 'ajax_search'])->name('admin.Customer.ajax_search');
//      end Customer ...............................       
/*         start suppliers_categories                */
Route::get('/suppliers_categories/index', [SupplierCategoriesController::class, 'index'])->name('admin.suppliers_categories.index');
Route::get('/suppliers_categories/create', [SupplierCategoriesController::class, 'create'])->name('admin.suppliers_categories.create');
Route::post('/suppliers_categories/store', [SupplierCategoriesController::class, 'store'])->name('admin.suppliers_categories.store');
Route::get('/suppliers_categories/edit/{id}', [SupplierCategoriesController::class, 'edit'])->name('admin.suppliers_categories.edit');
Route::post('/suppliers_categories/update/{id}', [SupplierCategoriesController::class, 'update'])->name('admin.suppliers_categories.update');
Route::get('/suppliers_categories/delete/{id}', [SupplierCategoriesController::class, 'delete'])->name('admin.suppliers_categories.delete');
/*           end suppliers_categories                */
//        start  suppliers .................................              
Route::get('/suppliers/index', [SuppliersController::class, 'index'])->name('admin.supplier.index');
Route::get('/suppliers/create', [SuppliersController::class, 'create'])->name('admin.supplier.create');
Route::post('/suppliers/store', [SuppliersController::class, 'store'])->name('admin.supplier.store');
Route::get('/suppliers/edit/{id}', [SuppliersController::class, 'edit'])->name('admin.supplier.edit');
Route::post('/suppliers/update/{id}', [SuppliersController::class, 'update'])->name('admin.supplier.update');
Route::get('/suppliers/delete/{id}', [SuppliersController::class, 'delete'])->name('admin.supplier.delete');
Route::post('/suppliers/ajax_search', [SuppliersController::class, 'ajax_search'])->name('admin.supplier.ajax_search');
Route::get('/suppliers/show/{id}', [SuppliersController::class, 'show'])->name('admin.supplier.show');
//      end suppliers ...............................      

/*         start  suppliers_orders   المشتريات             */
Route::get('/suppliers_orders/index', [Suppliers_with_ordersController::class, 'index'])->name('admin.suppliers_orders.index');
Route::get('/suppliers_orders/create', [Suppliers_with_ordersController::class, 'create'])->name('admin.suppliers_orders.create');
Route::post('/suppliers_orders/store', [Suppliers_with_ordersController::class, 'store'])->name('admin.suppliers_orders.store');
Route::get('/suppliers_orders/edit/{id}', [Suppliers_with_ordersController::class, 'edit'])->name('admin.suppliers_orders.edit');
Route::post('/suppliers_orders/update/{id}', [Suppliers_with_ordersController::class, 'update'])->name('admin.suppliers_orders.update');
Route::get('/suppliers_orders/delete/{id}', [Suppliers_with_ordersController::class, 'delete'])->name('admin.suppliers_orders.delete');
Route::post('/suppliers_orders/ajax_search', [Suppliers_with_ordersController::class, 'ajax_search'])->name('admin.suppliers_orders.ajax_search');
Route::get('/suppliers_orders/show/{id}', [Suppliers_with_ordersController::class, 'show'])->name('admin.suppliers_orders.show');
Route::post('/suppliers_orders/get_item_uoms', [Suppliers_with_ordersController::class, 'get_item_uoms'])->name('admin.suppliers_orders.get_item_uoms');
Route::post('/suppliers_orders/load_modal_add_details', [Suppliers_with_ordersController::class, 'load_modal_add_details'])->name('admin.suppliers_orders.load_modal_add_details');
Route::post('/suppliers_orders/add_new_details', [Suppliers_with_ordersController::class, 'add_new_details'])->name('admin.suppliers_orders.add_new_details');
Route::post('/suppliers_orders/reload_itemsdetials', [Suppliers_with_ordersController::class, 'reload_itemsdetials'])->name('admin.suppliers_orders.reload_itemsdetials');
Route::post('/suppliers_orders/reload_parent_pill', [Suppliers_with_ordersController::class, 'reload_parent_pill'])->name('admin.suppliers_orders.reload_parent_pill');
Route::post('/suppliers_orders/load_edit_item_details', [Suppliers_with_ordersController::class, 'load_edit_item_details'])->name('admin.suppliers_orders.load_edit_item_details');
Route::post('/suppliers_orders/edit_item_details', [Suppliers_with_ordersController::class, 'edit_item_details'])->name('admin.suppliers_orders.edit_item_details');
Route::get('/suppliers_orders/delete_details/{id}/{id_parent}', [Suppliers_with_ordersController::class, 'delete_details'])->name('admin.suppliers_orders.delete_details');
Route::post('/suppliers_orders/do_approve/{id}', [Suppliers_with_ordersController::class, 'do_approve'])->name('admin.suppliers_orders.do_approve');
Route::post('/suppliers_orders/load_modal_approve_invoice', [Suppliers_with_ordersController::class, 'load_modal_approve_invoice'])->name('admin.suppliers_orders.load_modal_approve_invoice');
Route::post('/suppliers_orders/load_usershiftDiv', [Suppliers_with_ordersController::class, 'load_usershiftDiv'])->name('admin.suppliers_orders.load_usershiftDiv');
Route::get('/suppliers_orders/printsaleswina4/{id}/{size}', [Suppliers_with_ordersController::class, 'printsaleswina4'])->name('admin.suppliers_orders.printsaleswina4');
/*           end suppliers_orders               */

/*         start admins_accounts                */
Route::get('/admins_accounts/index', [AdminController::class, 'index'])->name('admin.admins_accounts.index');
Route::get('/admins_accounts/create', [AdminController::class, 'create'])->name('admin.admins_accounts.create');
Route::post('/admins_accounts/store', [AdminController::class, 'store'])->name('admin.admins_accounts.store');
Route::get('/admins_accounts/edit/{id}', [AdminController::class, 'Edit'])->name('admin.admins_accounts.Edit');
Route::post('/admins_accounts/update/{id}', [AdminController::class, 'update'])->name('admin.admins_accounts.update');
Route::post('/admins_accounts/Add_permission_main_menues/{id}', [AdminController::class, 'Add_permission_main_menues'])->name('admin.admins_accounts.Add_permission_main_menues');
Route::get('/admins_accounts/Details/{id}', [AdminController::class, 'Details'])->name('admin.admins_accounts.Details');
Route::get('/admins_accounts/treasuries_delete{id}', [AdminController::class, 'treasuries_delete'])->name('admin.admins_accounts.treasuries_delete');
Route::post('/admins_accounts/Add_Stores/{id}', [AdminController::class, 'Add_Stores'])->name('admin.admins_accounts.Add_Stores');
Route::get('/admins_accounts/admins_store_delete{id}', [AdminController::class, 'admins_store_delete'])->name('admin.admins_accounts.admins_store_delete');
Route::post('/admins_accounts/ajax_search', [AdminController::class, 'ajax_search'])->name('admin.admins_accounts.ajax_search');

/*           end admins_accounts                */


/*         start admins shifts          */
Route::get('/admin_shift/index', [Admins_ShiftsContoller::class, 'index'])->name('admin.admin_shift.index');
Route::get('/admin_shift/create', [Admins_ShiftsContoller::class, 'create'])->name('admin.admin_shift.create');
Route::post('/admin_shift/store', [Admins_ShiftsContoller::class, 'store'])->name('admin.admin_shift.store');
Route::get('/admin_shift/finish{id}', [Admins_ShiftsContoller::class, 'finish'])->name('admin.admin_shift.finish');
Route::get('/admin_shift/print_details{id}', [Admins_ShiftsContoller::class, 'print_details'])->name('admin.admin_shift.print_details');
Route::post('/admin_shift/review_now', [Admins_ShiftsContoller::class, 'review_now'])->name('admin.admin_shift.review_now');
Route::post('/admin_shift/do_review_now/{shift_id}', [Admins_ShiftsContoller::class, 'do_review_now'])->name('admin.admin_shift.do_review_now');

/*           end admins shifts                  */
     /*         start  collect_transaction                */
Route::get('/collect_transaction/index', [CollectController::class, 'index'])->name('admin.collect_transaction.index');
Route::get('/collect_transaction/create', [CollectController::class, 'create'])->name('admin.collect_transaction.create');
Route::post('/collect_transaction/store', [CollectController::class, 'store'])->name('admin.collect_transaction.store');
Route::post('/collect_transaction/storeAndprint', [CollectController::class, 'storeAndprint'])->name('admin.collect_transaction.storeAndprint');
Route::post('/collect_transaction/get_account_blance', [CollectController::class, 'get_account_blance'])->name('admin.collect_transaction.get_account_blance');
Route::post('/collect_transaction/ajax_search', [CollectController::class, 'ajax_search'])->name('admin.collect_transaction.ajax_search');
Route::get('/collect_transaction/printsaleswina4/{id}/{size}', [CollectController::class, 'printsaleswina4'])->name('admin.collect_transaction.printsaleswina4');

/*           end  collect_transaction                  */
/*         start  exchange_transaction                */
Route::get('/exchange_transaction/index', [ExchangeController::class, 'index'])->name('admin.exchange_transaction.index');
Route::get('/exchange_transaction/create', [ExchangeController::class, 'create'])->name('admin.exchange_transaction.create');
Route::post('/exchange_transaction/store', [ExchangeController::class, 'store'])->name('admin.exchange_transaction.store');
Route::post('/exchange_transaction/storeAndprint', [ExchangeController::class, 'storeAndprint'])->name('admin.exchange_transaction.storeAndprint');
Route::post('/exchange_transaction/get_account_blance', [ExchangeController::class, 'get_account_blance'])->name('admin.exchange_transaction.get_account_blance');
Route::post('/exchange_transaction/ajax_search', [ExchangeController::class, 'ajax_search'])->name('admin.exchange_transaction.ajax_search');
Route::get('/exchange_transaction/printsaleswina4/{id}/{size}', [ExchangeController::class, 'printsaleswina4'])->name('admin.exchange_transaction.printsaleswina4');

/*           end  exchange_transaction                  */


/*     ═══════ ೋღ start  sales Invoices   المبيعات  ღೋ ═══════                */
Route::get('/SalesInvoices/index', [SalesInvoicesController::class, 'index'])->name('admin.SalesInvoices.index');
Route::get('/SalesInvoices/create', [SalesInvoicesController::class, 'create'])->name('admin.SalesInvoices.create');
Route::post('/SalesInvoices/store', [SalesInvoicesController::class, 'store'])->name('admin.SalesInvoices.store');
Route::get('/SalesInvoices/edit/{id}', [SalesInvoicesController::class, 'edit'])->name('admin.SalesInvoices.edit');
Route::post('/SalesInvoices/update/{id}', [SalesInvoicesController::class, 'update'])->name('admin.SalesInvoices.update');
Route::get('/SalesInvoices/delete/{id}', [SalesInvoicesController::class, 'delete'])->name('admin.SalesInvoices.delete');
Route::get('/SalesInvoices/show/{id}', [SalesInvoicesController::class, 'show'])->name('admin.SalesInvoices.show');
Route::post('/SalesInvoices/get_item_uoms', [SalesInvoicesController::class, 'get_item_uoms'])->name('admin.SalesInvoices.get_item_uoms');
Route::post('/SalesInvoices/get_item_batches', [SalesInvoicesController::class, 'get_item_batches'])->name('admin.SalesInvoices.get_item_batches');
Route::post('/SalesInvoices/get_item_unit_price', [SalesInvoicesController::class, 'get_item_unit_price'])->name('admin.SalesInvoices.get_item_unit_price');
Route::post('/SalesInvoices/get_Add_new_item_row', [SalesInvoicesController::class, 'get_Add_new_item_row'])->name('admin.SalesInvoices.get_Add_new_item_row');
Route::post('/SalesInvoices/load_modal_addMirror', [SalesInvoicesController::class, 'load_modal_addMirror'])->name('admin.SalesInvoices.load_modal_addMirror');
Route::post('/SalesInvoices/load_modal_addActiveInvoice', [SalesInvoicesController::class, 'load_modal_addActiveInvoice'])->name('admin.SalesInvoices.load_modal_addActiveInvoice');
Route::post('/SalesInvoices/store', [SalesInvoicesController::class, 'store'])->name('admin.SalesInvoices.store');
Route::post('/SalesInvoices/load_invoice_update_modal', [SalesInvoicesController::class, 'load_invoice_update_modal'])->name('admin.SalesInvoices.load_invoice_update_modal');
Route::post('/SalesInvoices/Add_item_to_invoice', [SalesInvoicesController::class, 'Add_item_to_invoice'])->name('admin.SalesInvoices.Add_item_to_invoice');
Route::post('/SalesInvoices/reload_items_in_invoice', [SalesInvoicesController::class, 'reload_items_in_invoice'])->name('admin.SalesInvoices.reload_items_in_invoice');
Route::post('/SalesInvoices/recalclate_parent_invoice', [SalesInvoicesController::class, 'recalclate_parent_invoice'])->name('admin.SalesInvoices.recalclate_parent_invoice');
Route::post('/SalesInvoices/remove_active_row_item', [SalesInvoicesController::class, 'remove_active_row_item'])->name('admin.SalesInvoices.remove_active_row_item');
Route::post('/SalesInvoices/DoApproveInvoiceFinally', [SalesInvoicesController::class, 'DoApproveInvoiceFinally'])->name('admin.SalesInvoices.DoApproveInvoiceFinally');
Route::post('/SalesInvoices/load_usershiftDiv', [SalesInvoicesController::class, 'load_usershiftDiv'])->name('admin.SalesInvoices.load_usershiftDiv');
Route::post('/SalesInvoices/load_invoice_details_modal', [SalesInvoicesController::class, 'load_invoice_details_modal'])->name('admin.SalesInvoices.load_invoice_details_modal');
Route::post('/SalesInvoices/ajax_search', [SalesInvoicesController::class, 'ajax_search'])->name('admin.SalesInvoices.ajax_search');
Route::post('/SalesInvoices/do_add_new_customer', [SalesInvoicesController::class, 'do_add_new_customer'])->name('admin.SalesInvoices.do_add_new_customer');
Route::post('/SalesInvoices/get_last_added_customer', [SalesInvoicesController::class, 'get_last_added_customer'])->name('admin.SalesInvoices.get_last_added_customer');
Route::post('/SalesInvoices/searchforcustomer', [SalesInvoicesController::class, 'searchforcustomer'])->name('admin.SalesInvoices.searchforcustomer');
Route::post('/SalesInvoices/searchforitems', [SalesInvoicesController::class, 'searchforitems'])->name('admin.SalesInvoices.searchforitems');
Route::get('/SalesInvoices/printsaleswina4/{id}/{size}', [SalesInvoicesController::class, 'printsaleswina4'])->name('admin.SalesInvoices.printsaleswina4');
/*       ═══════ ೋღ sales Invoices   المبيعات   ღೋ ═══════                     */

/*      ═══════ ೋღ start  delegates   ღೋ ═══════                 */
Route::get('/delegates/index', [DelegatesController::class, 'index'])->name('admin.delegates.index');
Route::get('/delegates/create', [DelegatesController::class, 'create'])->name('admin.delegates.create');
Route::post('/delegates/store', [DelegatesController::class, 'store'])->name('admin.delegates.store');
Route::get('/delegates/edit/{id}', [DelegatesController::class, 'edit'])->name('admin.delegates.edit');
Route::post('/delegates/update/{id}', [DelegatesController::class, 'update'])->name('admin.delegates.update');
Route::get('/delegates/delete/{id}', [DelegatesController::class, 'delete'])->name('admin.delegates.delete');
Route::post('/delegates/ajax_search', [DelegatesController::class, 'ajax_search'])->name('admin.delegates.ajax_search');
Route::post('/delegates/show', [DelegatesController::class, 'show'])->name('admin.delegates.show');
/*     ═══════ ೋღ      end delegates       ღೋ ═══════           */

/*     ═══════ ೋღ start  suppliers_orders Gernal Return   مرتجع المشتريات العام  ღೋ ═══════                */
Route::get('/suppliers_orders_general_return/index', [Suppliers_with_ordersGeneralRetuen::class, 'index'])->name('admin.suppliers_orders_general_return.index');
Route::get('/suppliers_orders_general_return/create', [Suppliers_with_ordersGeneralRetuen::class, 'create'])->name('admin.suppliers_orders_general_return.create');
Route::post('/suppliers_orders_general_return/store', [Suppliers_with_ordersGeneralRetuen::class, 'store'])->name('admin.suppliers_orders_general_return.store');
Route::get('/suppliers_orders_general_return/edit/{id}', [Suppliers_with_ordersGeneralRetuen::class, 'edit'])->name('admin.suppliers_orders_general_return.edit');
Route::post('/suppliers_orders_general_return/update/{id}', [Suppliers_with_ordersGeneralRetuen::class, 'update'])->name('admin.suppliers_orders_general_return.update');
Route::get('/suppliers_orders_general_return/delete/{id}', [Suppliers_with_ordersGeneralRetuen::class, 'delete'])->name('admin.suppliers_orders_general_return.delete');
Route::post('/suppliers_orders_general_return/ajax_search', [Suppliers_with_ordersGeneralRetuen::class, 'ajax_search'])->name('admin.suppliers_orders_general_return.ajax_search');
Route::get('/suppliers_orders_general_return/show/{id}', [Suppliers_with_ordersGeneralRetuen::class, 'show'])->name('admin.suppliers_orders_general_return.show');
Route::post('/suppliers_orders_general_return/get_item_uoms', [Suppliers_with_ordersGeneralRetuen::class, 'get_item_uoms'])->name('admin.suppliers_orders_general_return.get_item_uoms');
Route::post('/suppliers_orders_general_return/load_modal_add_details', [Suppliers_with_ordersGeneralRetuen::class, 'load_modal_add_details'])->name('admin.suppliers_orders_general_return.load_modal_add_details');
Route::post('/suppliers_orders_general_return/Add_item_to_invoice', [Suppliers_with_ordersGeneralRetuen::class, 'Add_item_to_invoice'])->name('admin.suppliers_orders_general_return.Add_item_to_invoice');
Route::post('/suppliers_orders_general_return/reload_itemsdetials', [Suppliers_with_ordersGeneralRetuen::class, 'reload_itemsdetials'])->name('admin.suppliers_orders_general_return.reload_itemsdetials');
Route::post('/suppliers_orders_general_return/reload_parent_pill', [Suppliers_with_ordersGeneralRetuen::class, 'reload_parent_pill'])->name('admin.suppliers_orders_general_return.reload_parent_pill');
Route::post('/suppliers_orders_general_return/load_edit_item_details', [Suppliers_with_ordersGeneralRetuen::class, 'load_edit_item_details'])->name('admin.suppliers_orders_general_return.load_edit_item_details');
Route::post('/suppliers_orders_general_return/edit_item_details', [Suppliers_with_ordersGeneralRetuen::class, 'edit_item_details'])->name('admin.suppliers_orders_general_return.edit_item_details');
Route::get('/suppliers_orders_general_return/delete_details/{id}/{id_parent}', [Suppliers_with_ordersGeneralRetuen::class, 'delete_details'])->name('admin.suppliers_orders_general_return.delete_details');
Route::post('/suppliers_orders_general_return/do_approve/{id}', [Suppliers_with_ordersGeneralRetuen::class, 'do_approve'])->name('admin.suppliers_orders_general_return.do_approve');
Route::post('/suppliers_orders_general_return/load_modal_approve_invoice', [Suppliers_with_ordersGeneralRetuen::class, 'load_modal_approve_invoice'])->name('admin.suppliers_orders_general_return.load_modal_approve_invoice');
Route::post('/suppliers_orders_general_return/load_usershiftDiv', [Suppliers_with_ordersGeneralRetuen::class, 'load_usershiftDiv'])->name('admin.suppliers_orders_general_return.load_usershiftDiv');
Route::post('/suppliers_orders_general_return/get_item_batches', [Suppliers_with_ordersGeneralRetuen::class, 'get_item_batches'])->name('admin.suppliers_orders_general_return.get_item_batches');
Route::get('/suppliers_orders_general_return/printsaleswina4/{id}/{size}', [Suppliers_with_ordersGeneralRetuen::class, 'printsaleswina4'])->name('admin.suppliers_orders_general_return.printsaleswina4');
/*        ═══════ ೋღ end  suppliers_orders Gernal Return  ღೋ ═══════                  */

/*      ═══════ ೋღ  start    itemcardBalance  ღೋ ═══════                 */
Route::get('/itemcardBalance/index', [ItemcardBalanceController::class, 'index'])->name('admin.itemcardBalance.index');
Route::post('/itemcardBalance/ajax_search', [ItemcardBalanceController::class, 'ajax_search'])->name('admin.itemcardBalance.ajax_search');
/*     ═══════ ೋღ   end    itemcardBalance     ღೋ ═══════              */

/*     ═══════ ೋღ start  sales Invoices   مرتجع المبيعات العام  ღೋ ═══════                */
Route::get('/SalesReturnInvoices/index', [SalesReturnInvoicesController::class, 'index'])->name('admin.SalesReturnInvoices.index');
Route::get('/SalesReturnInvoices/create', [SalesReturnInvoicesController::class, 'create'])->name('admin.SalesReturnInvoices.create');
Route::post('/SalesReturnInvoices/store', [SalesReturnInvoicesController::class, 'store'])->name('admin.SalesReturnInvoices.store');
Route::get('/SalesReturnInvoices/edit/{id}', [SalesReturnInvoicesController::class, 'edit'])->name('admin.SalesReturnInvoices.edit');
Route::post('/SalesReturnInvoices/update/{id}', [SalesReturnInvoicesController::class, 'update'])->name('admin.SalesReturnInvoices.update');
Route::get('/SalesReturnInvoices/delete/{id}', [SalesReturnInvoicesController::class, 'delete'])->name('admin.SalesReturnInvoices.delete');
Route::get('/SalesReturnInvoices/show/{id}', [SalesReturnInvoicesController::class, 'show'])->name('admin.SalesReturnInvoices.show');
Route::post('/SalesReturnInvoices/get_item_uoms', [SalesReturnInvoicesController::class, 'get_item_uoms'])->name('admin.SalesReturnInvoices.get_item_uoms');
Route::post('/SalesReturnInvoices/get_item_batches', [SalesReturnInvoicesController::class, 'get_item_batches'])->name('admin.SalesReturnInvoices.get_item_batches');
Route::post('/SalesReturnInvoices/get_item_unit_price', [SalesReturnInvoicesController::class, 'get_item_unit_price'])->name('admin.SalesReturnInvoices.get_item_unit_price');
Route::post('/SalesReturnInvoices/get_Add_new_item_row', [SalesReturnInvoicesController::class, 'get_Add_new_item_row'])->name('admin.SalesReturnInvoices.get_Add_new_item_row');
Route::post('/SalesReturnInvoices/load_modal_addMirror', [SalesReturnInvoicesController::class, 'load_modal_addMirror'])->name('admin.SalesReturnInvoices.load_modal_addMirror');
Route::post('/SalesReturnInvoices/load_modal_addActiveInvoice', [SalesReturnInvoicesController::class, 'load_modal_addActiveInvoice'])->name('admin.SalesReturnInvoices.load_modal_addActiveInvoice');
Route::post('/SalesReturnInvoices/store', [SalesReturnInvoicesController::class, 'store'])->name('admin.SalesReturnInvoices.store');
Route::post('/SalesReturnInvoices/load_invoice_update_modal', [SalesReturnInvoicesController::class, 'load_invoice_update_modal'])->name('admin.SalesReturnInvoices.load_invoice_update_modal');
Route::post('/SalesReturnInvoices/Add_item_to_invoice', [SalesReturnInvoicesController::class, 'Add_item_to_invoice'])->name('admin.SalesReturnInvoices.Add_item_to_invoice');
Route::post('/SalesReturnInvoices/reload_items_in_invoice', [SalesReturnInvoicesController::class, 'reload_items_in_invoice'])->name('admin.SalesReturnInvoices.reload_items_in_invoice');
Route::post('/SalesReturnInvoices/recalclate_parent_invoice', [SalesReturnInvoicesController::class, 'recalclate_parent_invoice'])->name('admin.SalesReturnInvoices.recalclate_parent_invoice');
Route::post('/SalesReturnInvoices/remove_active_row_item', [SalesReturnInvoicesController::class, 'remove_active_row_item'])->name('admin.SalesReturnInvoices.remove_active_row_item');
Route::post('/SalesReturnInvoices/DoApproveInvoiceFinally', [SalesReturnInvoicesController::class, 'DoApproveInvoiceFinally'])->name('admin.SalesReturnInvoices.DoApproveInvoiceFinally');
Route::post('/SalesReturnInvoices/load_usershiftDiv', [SalesReturnInvoicesController::class, 'load_usershiftDiv'])->name('admin.SalesReturnInvoices.load_usershiftDiv');
Route::post('/SalesReturnInvoices/load_invoice_details_modal', [SalesReturnInvoicesController::class, 'load_invoice_details_modal'])->name('admin.SalesReturnInvoices.load_invoice_details_modal');
Route::post('/SalesReturnInvoices/ajax_search', [SalesReturnInvoicesController::class, 'ajax_search'])->name('admin.SalesReturnInvoices.ajax_search');
Route::post('/SalesReturnInvoices/do_add_new_customer', [SalesReturnInvoicesController::class, 'do_add_new_customer'])->name('admin.SalesReturnInvoices.do_add_new_customer');
Route::post('/SalesReturnInvoices/get_last_added_customer', [SalesReturnInvoicesController::class, 'get_last_added_customer'])->name('admin.SalesReturnInvoices.get_last_added_customer');
Route::post('/SalesReturnInvoices/searchforcustomer', [SalesReturnInvoicesController::class, 'searchforcustomer'])->name('admin.SalesReturnInvoices.searchforcustomer');
Route::post('/SalesReturnInvoices/searchforitems', [SalesReturnInvoicesController::class, 'searchforitems'])->name('admin.SalesReturnInvoices.searchforitems');
Route::get('/SalesReturnInvoices/printsaleswina4/{id}/{size}', [SalesReturnInvoicesController::class, 'printsaleswina4'])->name('admin.SalesReturnInvoices.printsaleswina4');
/*  ═══════ ೋღ  sales Invoices   المبيعات                ღೋ ═══════        */

/*  ═══════ ೋღ start  FinancialReportController تقاير الحسابات  ღೋ ═══════ */
Route::get('/FinancialReport/supplieraccountmirror', [FinancialReportController::class, 'supplier_account_mirror'])->name('admin.FinancialReport.supplieraccountmirror');
Route::post('/FinancialReport/supplieraccountmirror', [FinancialReportController::class, 'supplier_account_mirror'])->name('admin.FinancialReport.supplieraccountmirror');
Route::get('/FinancialReport/customeraccountmirror', [FinancialReportController::class, 'customer_account_mirror'])->name('admin.FinancialReport.customeraccountmirror');
Route::post('/FinancialReport/customeraccountmirror', [FinancialReportController::class, 'customer_account_mirror'])->name('admin.FinancialReport.customeraccountmirror');
Route::post('/FinancialReport/searchforcustomer', [FinancialReportController::class, 'searchforcustomer'])->name('admin.FinancialReport.searchforcustomer');
Route::get('/FinancialReport/delegateaccountmirror', [FinancialReportController::class, 'delegate_account_mirror'])->name('admin.FinancialReport.delegateaccountmirror');
Route::post('/FinancialReport/delegateaccountmirror', [FinancialReportController::class, 'delegate_account_mirror'])->name('admin.FinancialReport.delegateaccountmirror');
/*  ═══════ ೋღ end  FinancialReportController ღೋ ═══════  */

/*  ═══════ ೋღ start  Services  ღೋ ═══════                      */
Route::get('/Services/index', [ServicesController::class, 'index'])->name('admin.Services.index');
Route::get('/Services/create', [ServicesController::class, 'create'])->name('admin.Services.create');
Route::post('/Services/store', [ServicesController::class, 'store'])->name('admin.Services.store');
Route::get('/Services/edit/{id}', [ServicesController::class, 'edit'])->name('admin.Services.edit');
Route::post('/Services/update/{id}', [ServicesController::class, 'update'])->name('admin.Services.update');
Route::get('/Services/delete/{id}', [ServicesController::class, 'delete'])->name('admin.Services.delete');
Route::post('/Services/ajax_search', [ServicesController::class, 'ajax_search'])->name('admin.Services.ajax_search');
/*      ═══════ ೋღ end Services  ღೋ ═══════                    */

/*      ═══════ ೋღ  start  services_orders    ღೋ ═══════            */
Route::get('/Services_orders/index', [Services_with_ordersController::class, 'index'])->name('admin.Services_orders.index');
Route::get('/Services_orders/create', [Services_with_ordersController::class, 'create'])->name('admin.Services_orders.create');
Route::post('/Services_orders/store', [Services_with_ordersController::class, 'store'])->name('admin.Services_orders.store');
Route::get('/Services_orders/edit/{id}', [Services_with_ordersController::class, 'edit'])->name('admin.Services_orders.edit');
Route::post('/Services_orders/update/{id}', [Services_with_ordersController::class, 'update'])->name('admin.Services_orders.update');
Route::get('/Services_orders/delete/{id}', [Services_with_ordersController::class, 'delete'])->name('admin.Services_orders.delete');
Route::post('/Services_orders/ajax_search', [Services_with_ordersController::class, 'ajax_search'])->name('admin.Services_orders.ajax_search');
Route::get('/Services_orders/show/{id}', [Services_with_ordersController::class, 'show'])->name('admin.Services_orders.show');
Route::post('/Services_orders/load_modal_add_details', [Services_with_ordersController::class, 'load_modal_add_details'])->name('admin.Services_orders.load_modal_add_details');
Route::post('/Services_orders/add_new_details', [Services_with_ordersController::class, 'add_new_details'])->name('admin.Services_orders.add_new_details');
Route::post('/Services_orders/reload_itemsdetials', [Services_with_ordersController::class, 'reload_itemsdetials'])->name('admin.Services_orders.reload_itemsdetials');
Route::post('/Services_orders/reload_parent_pill', [Services_with_ordersController::class, 'reload_parent_pill'])->name('admin.Services_orders.reload_parent_pill');
Route::post('/Services_orders/load_edit_item_details', [Services_with_ordersController::class, 'load_edit_item_details'])->name('admin.Services_orders.load_edit_item_details');
Route::post('/Services_orders/edit_item_details', [Services_with_ordersController::class, 'edit_item_details'])->name('admin.Services_orders.edit_item_details');
Route::get('/Services_orders/delete_details/{id}/{id_parent}', [Services_with_ordersController::class, 'delete_details'])->name('admin.Services_orders.delete_details');
Route::post('/Services_orders/do_approve/{id}', [Services_with_ordersController::class, 'do_approve'])->name('admin.Services_orders.do_approve');
Route::post('/Services_orders/load_modal_approve_invoice', [Services_with_ordersController::class, 'load_modal_approve_invoice'])->name('admin.Services_orders.load_modal_approve_invoice');
Route::post('/Services_orders/load_usershiftDiv', [Services_with_ordersController::class, 'load_usershiftDiv'])->name('admin.Services_orders.load_usershiftDiv');
Route::get('/Services_orders/printsaleswina4/{id}/{size}', [Services_with_ordersController::class, 'printsaleswina4'])->name('admin.Services_orders.printsaleswina4');
/*     ═══════ ೋღ  end services_orders       ღೋ ═══════              */

/*      ═══════ ೋღ start  inv_stores_inventory  ღೋ ═══════              */
Route::get('/stores_inventory/index', [Inv_stores_inventoryController::class, 'index'])->name('admin.stores_inventory.index');
Route::get('/stores_inventory/create', [Inv_stores_inventoryController::class, 'create'])->name('admin.stores_inventory.create');
Route::post('/stores_inventory/store', [Inv_stores_inventoryController::class, 'store'])->name('admin.stores_inventory.store');
Route::get('/stores_inventory/edit/{id}', [Inv_stores_inventoryController::class, 'edit'])->name('admin.stores_inventory.edit');
Route::post('/stores_inventory/update/{id}', [Inv_stores_inventoryController::class, 'update'])->name('admin.stores_inventory.update');
Route::get('/stores_inventory/delete/{id}', [Inv_stores_inventoryController::class, 'delete'])->name('admin.stores_inventory.delete');
Route::post('/stores_inventory/ajax_search', [Inv_stores_inventoryController::class, 'ajax_search'])->name('admin.stores_inventory.ajax_search');
Route::get('/stores_inventory/show/{id}', [Inv_stores_inventoryController::class, 'show'])->name('admin.stores_inventory.show');
Route::post('/stores_inventory/add_new_details/{id}', [Inv_stores_inventoryController::class, 'add_new_details'])->name('admin.stores_inventory.add_new_details');
Route::post('/stores_inventory/load_edit_item_details', [Inv_stores_inventoryController::class, 'load_edit_item_details'])->name('admin.stores_inventory.load_edit_item_details');
Route::post('/stores_inventory/edit_item_details/{id}/{id_parent}', [Inv_stores_inventoryController::class, 'edit_item_details'])->name('admin.stores_inventory.edit_item_details');
Route::get('/stores_inventory/delete_details/{id}/{id_parent}', [Inv_stores_inventoryController::class, 'delete_details'])->name('admin.stores_inventory.delete_details');
Route::get('/stores_inventory/close_one_details/{id}/{id_parent}', [Inv_stores_inventoryController::class, 'close_one_details'])->name('admin.stores_inventory.close_one_details');
Route::get('/stores_inventory/do_close_parent/{id}', [Inv_stores_inventoryController::class, 'do_close_parent'])->name('admin.stores_inventory.do_close_parent');
Route::get('/stores_inventory/printsaleswina4/{id}/{size}', [Inv_stores_inventoryController::class, 'printsaleswina4'])->name('admin.stores_inventory.printsaleswina4');
/*     ═══════ ೋღ end sservices_orders   ღೋ ═══════                   */

/*     ═══════ ೋღ   start  inv_stores_transfer   ღೋ ═══════          أوامر تحويل مخزنية صادرة    */
Route::get('/inv_stores_transfer/index', [Inv_stores_transferController::class, 'index'])->name('admin.inv_stores_transfer.index');
Route::get('/inv_stores_transfer/create', [Inv_stores_transferController::class, 'create'])->name('admin.inv_stores_transfer.create');
Route::post('/inv_stores_transfer/store', [Inv_stores_transferController::class, 'store'])->name('admin.inv_stores_transfer.store');
Route::get('/inv_stores_transfer/edit/{id}', [Inv_stores_transferController::class, 'edit'])->name('admin.inv_stores_transfer.edit');
Route::post('/inv_stores_transfer/update/{id}', [Inv_stores_transferController::class, 'update'])->name('admin.inv_stores_transfer.update');
Route::get('/inv_stores_transfer/delete/{id}', [Inv_stores_transferController::class, 'delete'])->name('admin.inv_stores_transfer.delete');
Route::post('/inv_stores_transfer/ajax_search', [Inv_stores_transferController::class, 'ajax_search'])->name('admin.inv_stores_transfer.ajax_search');
Route::get('/inv_stores_transfer/show/{id}', [Inv_stores_transferController::class, 'show'])->name('admin.inv_stores_transfer.show');
Route::post('/inv_stores_transfer/get_item_uoms', [Inv_stores_transferController::class, 'get_item_uoms'])->name('admin.inv_stores_transfer.get_item_uoms');
Route::post('/inv_stores_transfer/load_modal_add_details', [Inv_stores_transferController::class, 'load_modal_add_details'])->name('admin.inv_stores_transfer.load_modal_add_details');
Route::post('/inv_stores_transfer/Add_item_to_invoice', [Inv_stores_transferController::class, 'Add_item_to_invoice'])->name('admin.inv_stores_transfer.Add_item_to_invoice');
Route::post('/inv_stores_transfer/reload_itemsdetials', [Inv_stores_transferController::class, 'reload_itemsdetials'])->name('admin.inv_stores_transfer.reload_itemsdetials');
Route::post('/inv_stores_transfer/reload_parent_pill', [Inv_stores_transferController::class, 'reload_parent_pill'])->name('admin.inv_stores_transfer.reload_parent_pill');
Route::post('/inv_stores_transfer/load_edit_item_details', [Inv_stores_transferController::class, 'load_edit_item_details'])->name('admin.inv_stores_transfer.load_edit_item_details');
Route::post('/inv_stores_transfer/edit_item_details', [Inv_stores_transferController::class, 'edit_item_details'])->name('admin.inv_stores_transfer.edit_item_details');
Route::get('/inv_stores_transfer/delete_details/{id}/{id_parent}', [Inv_stores_transferController::class, 'delete_details'])->name('admin.inv_stores_transfer.delete_details');
Route::get('/inv_stores_transfer/do_approve/{id}', [Inv_stores_transferController::class, 'do_approve'])->name('admin.inv_stores_transfer.do_approve');
Route::post('/inv_stores_transfer/get_item_batches', [Inv_stores_transferController::class, 'get_item_batches'])->name('admin.inv_stores_transfer.get_item_batches');
Route::get('/inv_stores_transfer/printsaleswina4/{id}/{size}', [Inv_stores_transferController::class, 'printsaleswina4'])->name('admin.inv_stores_transfer.printsaleswina4');
/*   ═══════ ೋღ end  inv_stores_transfer  ღೋ ═══════                      */

/*    ═══════ ೋღ  start  inv_stores_transfer_incoming  ღೋ ═══════            أوامر تحويل مخزنية واردة    */
Route::get('/inv_stores_transfer_incoming/index', [Inv_stores_transferIncomingController::class, 'index'])->name('admin.inv_stores_transfer_incoming.index');
Route::post('/inv_stores_transfer_incoming/ajax_search', [Inv_stores_transferIncomingController::class, 'ajax_search'])->name('admin.inv_stores_transfer_incoming.ajax_search');
Route::get('/inv_stores_transfer_incoming/show/{id}', [Inv_stores_transferIncomingController::class, 'show'])->name('admin.inv_stores_transfer_incoming.show');
Route::get('/inv_stores_transfer_incoming/printsaleswina4/{id}/{size}', [Inv_stores_transferIncomingController::class, 'printsaleswina4'])->name('admin.inv_stores_transfer_incoming.printsaleswina4');
Route::get('/inv_stores_transfer_incoming/approve_one_details/{id}/{id_parent}', [Inv_stores_transferIncomingController::class, 'approve_one_details'])->name('admin.inv_stores_transfer_incoming.approve_one_details');
Route::get('/inv_stores_transfer_incoming/cancel_one_details/{id}/{id_parent}', [Inv_stores_transferIncomingController::class, 'cancel_one_details'])->name('admin.inv_stores_transfer_incoming.cancel_one_details');
Route::post('/inv_stores_transfer_incoming/load_cancel_one_details', [Inv_stores_transferIncomingController::class, 'load_cancel_one_details'])->name('admin.inv_stores_transfer_incoming.load_cancel_one_details');
Route::post('/inv_stores_transfer_incoming/do_cancel_one_details/{id}/{id_parent}', [Inv_stores_transferIncomingController::class, 'do_cancel_one_details'])->name('admin.inv_stores_transfer_incoming.do_cancel_one_details');
/*     ═══════ ೋღ  end  inv_stores_transfer_incoming   ღೋ ═══════                   */

/*    ═══════ ೋღ  start  permission_rolsController  ღೋ ═══════                   */
Route::get('/permission_rols/index', [permission_rolsController::class, 'index'])->name('admin.permission_rols.index');
Route::get('/permission_rols/create', [permission_rolsController::class, 'create'])->name('admin.permission_rols.create');
Route::get('/permission_rols/edit/{id}', [permission_rolsController::class, 'edit'])->name('admin.permission_rols.Edit');
Route::post('/permission_rols/store', [permission_rolsController::class, 'store'])->name('admin.permission_rols.store');
Route::post('/permission_rols/update/{id}', [permission_rolsController::class, 'update'])->name('admin.permission_rols.update');
Route::get('/permission_rols/Details/{id}', [permission_rolsController::class, 'Details'])->name('admin.permission_rols.Details');
Route::post('/permission_rols/Add_permission_main_menues/{id}', [permission_rolsController::class, 'Add_permission_main_menues'])->name('admin.permission_rols.Add_permission_main_menues');
Route::get('/permission_rols/permission_rols_mian_menues_delete{id}', [permission_rolsController::class, 'permission_rols_mian_menues_delete'])->name('admin.permission_rols.permission_rols_mian_menues_delete');
Route::post('/permission_rols/load_add_permission_rols_sub_menues', [permission_rolsController::class, 'load_add_permission_rols_sub_menues'])->name('admin.permission_rols.load_add_permission_rols_sub_menues');
Route::post('/permission_rols/add_permission_rols_sub_menues/{id}', [permission_rolsController::class, 'add_permission_rols_sub_menues'])->name('admin.permission_rols.add_permission_rols_sub_menues');
Route::get('/permission_rols/permission_rols_sub_menues_delete{id}', [permission_rolsController::class, 'permission_rols_sub_menues_delete'])->name('admin.permission_rols.permission_rols_sub_menues_delete');
Route::post('/permission_rols/load_add_permission_rols_sub_menues_action', [permission_rolsController::class, 'load_add_permission_rols_sub_menues_action'])->name('admin.permission_rols.load_add_permission_rols_sub_menues_action');
Route::post('/permission_rols/add_permission_rols_sub_menues_action/{id}', [permission_rolsController::class, 'add_permission_rols_sub_menues_action'])->name('admin.permission_rols.add_permission_rols_sub_menues_action');
Route::get('/permission_rols/permission_rols_sub_menues_action_delete{id}', [permission_rolsController::class, 'permission_rols_sub_menues_action_delete'])->name('admin.permission_rols.permission_rols_sub_menues_action_delete');

/*     ═══════ ೋღ  end  permission_rolsController   ღೋ ═══════                   */

/*    ═══════ ೋღ  start  permission_main_menues  ღೋ ═══════                   */
Route::get('/permission_main_menues/index', [permission_main_menuesController::class, 'index'])->name('admin.permission_main_menues.index');
Route::get('/permission_main_menues/create', [permission_main_menuesController::class, 'create'])->name('admin.permission_main_menues.create');
Route::get('/permission_main_menues/edit/{id}', [permission_main_menuesController::class, 'edit'])->name('admin.permission_main_menues.Edit');
Route::post('/permission_main_menues/store', [permission_main_menuesController::class, 'store'])->name('admin.permission_main_menues.store');
Route::post('/permission_main_menues/update/{id}', [permission_main_menuesController::class, 'update'])->name('admin.permission_main_menues.update');
Route::get('/permission_main_menues/delete/{id}', [permission_main_menuesController::class, 'delete'])->name('admin.permission_main_menues.delete');



/*     ═══════ ೋღ  end  permission_main_menues   ღೋ ═══════                   */
/*    ═══════ ೋღ  start  permission_sub_menues  ღೋ ═══════                   */
Route::get('/permission_sub_menues/index', [permission_sub_menuesController::class, 'index'])->name('admin.permission_sub_menues.index');
Route::get('/permission_sub_menues/create', [permission_sub_menuesController::class, 'create'])->name('admin.permission_sub_menues.create');
Route::get('/permission_sub_menues/edit/{id}', [permission_sub_menuesController::class, 'edit'])->name('admin.permission_sub_menues.Edit');
Route::post('/permission_sub_menues/store', [permission_sub_menuesController::class, 'store'])->name('admin.permission_sub_menues.store');
Route::post('/permission_sub_menues/update/{id}', [permission_sub_menuesController::class, 'update'])->name('admin.permission_sub_menues.update');
Route::post('/permission_sub_menues/ajax_search', [permission_sub_menuesController::class, 'ajax_search'])->name('admin.permission_sub_menues.ajax_search'); 
Route::post('/permission_sub_menues/ajax_load_add_permission', [permission_sub_menuesController::class, 'load_add_permission'])->name('admin.permission_sub_menues.load_add_permission');
Route::post('/permission_sub_menues/ajax_load_edit_permission', [permission_sub_menuesController::class, 'ajax_load_edit_permission'])->name('admin.permission_sub_menues.ajax_load_edit_permission');
Route::post('/permission_sub_menues/ajax_do_edit_permission', [permission_sub_menuesController::class, 'ajax_do_edit_permission'])->name('admin.permission_sub_menues.ajax_do_edit_permission'); 
Route::get('/permission_sub_menues/delete_action/{id}', [permission_sub_menuesController::class, 'delete_action'])->name('admin.permission_sub_menues.delete_action');
Route::get('/permission_sub_menues/delete/{id}', [permission_sub_menuesController::class, 'delete'])->name('admin.permission_sub_menues.delete');


/*     ═══════ ೋღ  end  permission_sub_menues   ღೋ ═══════                   */
     //start  inv_itemcard..................
     Route::get('/itemcard/index_for', [InvItemCardController::class, 'index_for'])->name('admin.itemcard_for_web.index');
     Route::get('/itemcard/shows/{id}', [InvItemCardController::class, 'shows'])->name('admin.itemcard_for_web.show');
     Route::get('/itemcard/Add_custmoer_favorite_itemcard/{id}', [InvItemCardController::class, 'Add_custmoer_favorite_itemcard'])->name('admin.itemcard_for_web.Add_custmoer_favorite_itemcard');
     Route::post('/itemcard/Add_custmoer_order', [InvItemCardController::class, 'Add_custmoer_order'])->name('admin.itemcard_for_web.Add_custmoer_order');
     Route::post('/SalesInvoices/load_modal_Add_custmoer_order', [InvItemCardController::class, 'load_modal_addorder'])->name('admin.itemcard_for_web.load_modal_addoroder');
     Route::post('/SalesInvoices/load_orders_modal', [InvItemCardController::class, 'load_orders_modal'])->name('admin.itemcard_for_web.load_orders_modal');
     Route::post('/itemcard/load_order_update_modal', [InvItemCardController::class, 'load_order_update_modal'])->name('admin.itemcard_for_web.load_order_update_modal');
     Route::post('/itemcard/update_order', [InvItemCardController::class, 'update_order'])->name('admin.itemcard_for_web.update_order');
     Route::post('/itemcard/remove_active_row_item', [InvItemCardController::class, 'remove_active_row_item'])->name('admin.itemcard_for_web.remove_active_row_item');
     Route::get('/order_customer/delete/{id}', [InvItemCardController::class, 'delete_order'])->name('admin.itemcard_for_web.delete');

     Route::post('/order_customer/load_invoice_order_modal', [WebsiteController::class, 'load_invoice_order_modal'])->name('admin.SalesInvoices.load_modal_order_modal');
     Route::post('/order_customer/get_item_batches_order', [WebsiteController::class, 'get_item_batches'])->name('admin.SalesInvoices.get_item_batches_order');
     Route::post('/order_customer/DoApproveInvoiceFinally_order', [WebsiteController::class, 'DoApproveInvoiceFinally'])->name('admin.SalesInvoices.DoApproveInvoiceFinally_order');
     Route::get('/home', [WebsiteController::class, 'index_for'])->name('web.homepageU');

     Route::post('/itemcard/ajax_check_order', [DashboardController::class, 'ajax_check_order'])->name('admin.itemcard.ajax_check_order');

     //end  inv_itemcard.....................

   /*         start  account types .......................             */

});


