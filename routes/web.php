<?php


use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\LoginController;
use App\Http\controllers\Admin\DashboardController;
use App\Http\controllers\Admin\WebsiteController;
use App\Http\controllers\Admin\FinancialReportController;


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



Route::group(['prefix' => '/',  'middleware' => 'guest:web'], function () {
  Route::get('/', [LoginController::class, 'index'])->name('web.LoginCustomer');
   Route::post('login', [LoginController::class, 'checklogin_for_customer'])->name('web.login');
});
Route::group([ 'prefix' => 'Website', 'middleware' => 'auth:web'], function () {
  Route::get('logout', [LoginController::class, 'logoutCustomer'])->name('web.logout');
  Route::get('/', [DashboardController::class, 'for_change_page'])->name('admin.for_change_page');

  Route::get('/home', [WebsiteController::class, 'index_for'])->name('web.homepage');
  Route::get('/shows/{id}', [WebsiteController::class, 'shows'])->name('website.itemcard_for_web.shows');
  Route::get('/Add_custmoer_favorite_itemcard/{id}', [WebsiteController::class, 'Add_custmoer_favorite_itemcard'])->name('admin.itemcard_for_web.Add_custmoer_favorite_itemcard');
  Route::post('/Add_custmoer_order', [WebsiteController::class, 'Add_custmoer_order'])->name('admin.itemcard_for_web.Add_custmoer_order');
  Route::post('/load_modal_Add_custmoer_order', [WebsiteController::class, 'load_modal_addorder'])->name('admin.itemcard_for_web.load_modal_addoroder');
  Route::post('/load_orders_modal', [WebsiteController::class, 'load_orders_modal'])->name('admin.itemcard_for_web.load_orders_modal');
  Route::post('/load_order_update_modal', [WebsiteController::class, 'load_order_update_modal'])->name('admin.itemcard_for_web.load_order_update_modal');
  Route::post('/update_order', [WebsiteController::class, 'update_order'])->name('admin.itemcard_for_web.update_order');
  Route::post('/remove_active_row_item', [WebsiteController::class, 'remove_active_row_item'])->name('admin.itemcard_for_web.remove_active_row_item');
  Route::get('/remove_favorite_item/{id}', [WebsiteController::class, 'remove_favorite_item'])->name('admin.itemcard_for_web.remove_favorite_item');
  Route::get('/delete/{id}', [WebsiteController::class, 'delete_order'])->name('admin.itemcard_for_web.delete');
  Route::post('/send_order', [WebsiteController::class, 'send_order'])->name('admin.itemcard_for_web.send_order');
  Route::post('/itemcard/ajax_check_order', [DashboardController::class, 'ajax_check_order'])->name('admin.itemcard.ajax_check_order');
  Route::get('/count_customer', [WebsiteController::class, 'index'])->name('admin.count_customer');
/*  ═══════ ೋღ start  FinancialReportController تقاير الحسابات  ღೋ ═══════ */
Route::get('/FinancialReport/customeraccount', [FinancialReportController::class, 'customer_account_mirror'])->name('admin.FinancialReport.customeraccount');
Route::post('/FinancialReport/customeraccount', [FinancialReportController::class, 'customer_account_mirror'])->name('admin.FinancialReport.customeraccount');
/*  ═══════ ೋღ end  FinancialReportController ღೋ ═══════  */


});
