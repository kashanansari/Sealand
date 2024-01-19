<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/create_user',[userController::class,'create_user']);
Route::post('/login',[userController::class,'login_user']);

//Middleware Fucntions
Route::middleware(['auth:sanctum','Admin'])->group(function () {

Route::post('/create_client',[userController::class,'create_client']);
Route::post('/create_customers',[userController::class,'create_customers']);
Route::post('/create_vendor',[userController::class,'create_vendors']);
Route::post('/user_logout',[userController::class,'user_logout']);
Route::post('/create_expense',[userController::class,'create_expense']);
Route::post('/create_customer_owner',[userController::class,'create_customer_owner']);
Route::post('/create_cheque_book',[userController::class,'create_cheque_book']);
Route::post('/create_cheque_data',[userController::class,'create_cheque_data']);

Route::post('/create_bank',[userController::class,'create_bank']);
Route::get('/get_roles',[userController::class,'get_roles']);
Route::get('/get_banks',[userController::class,'get_banks']);

});
Route::middleware(['auth:sanctum','Manager'])->group(function () {

    //POST APIS
    Route::post('/create_client',[userController::class,'create_client']);
    Route::post('/create_customers',[userController::class,'create_customers']);
    Route::post('/create_vendor',[userController::class,'create_vendors']);
    Route::post('/user_logout',[userController::class,'user_logout']);
    Route::post('/create_expense',[userController::class,'create_expense']);
    Route::post('/create_customer_owner',[userController::class,'create_customer_owner']);
    Route::post('/create_cheque_book',[userController::class,'create_cheque_book']);
    Route::post('/create_cheque_data',[userController::class,'create_cheque_data']);
    Route::post('/create_purchses',[userController::class,'create_purchses']);
    Route::post('/create_bank',[userController::class,'create_bank']);
    Route::post('/create_products',[userController::class,'create_products']);
    Route::post('/create_purchases_product',[userController::class,'create_purchases_product']);
    Route::post('/create_vendor_bill',[userController::class,'create_vendor_bill']);
    Route::post('/create_report',[userController::class,'create_report']);
    Route::post('/create_invoices',[userController::class,'create_invoices']);
    Route::post('/create_ledger_acc',[userController::class,'create_ledger_acc']);
//GET APIS
    Route::get('/get_roles',[userController::class,'get_roles']);
    Route::get('/get_banks',[userController::class,'get_banks']);
    Route::get('/view_user',[userController::class,'view_all_user']);
    // Route::get('/view_all_vendors',[userController::class,'view_all_vendors']);
    Route::get('/view_all_vendors_record',[userController::class,'view_all_vendors_record']);
    Route::get('/view_all_customers_records',[userController::class,'view_all_customers_records']);
    Route::get('/view_all_vendors_bill',[userController::class,'view_all_vendors_bill']);

    });
    Route::get('/get_all',[userController::class,'get_all']);
    // Route::post('//create_products',[userController::class,'create_products']);
