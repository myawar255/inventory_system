<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowRequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IssuedBooksController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RenewRequestController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RequestedBooksController;
use App\Http\Controllers\ReserveRequestController;
use App\Http\Controllers\ReturnRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['role:admin']], function () {


        // Users Management
    });
    Route::resource('users', 'UserController');
    Route::get('get_users', [UserController::class, 'get_data'])->name('get_users');

    Route::resource('customers', 'CustomerController');
    Route::get('get_customers', [CustomerController::class, 'get_data'])->name('get_customers');
    Route::get('export_customers', [CustomerController::class, 'export_customers'])->name('export_customers');
    Route::post('import_customers', [CustomerController::class, 'import_customers'])->name('import_customers');

    Route::resource('products', 'ProductController');
    Route::get('get_products', [ProductController::class, 'get_data'])->name('get_products');
    Route::get('export_products', [ProductController::class, 'export_products'])->name('export_products');
    Route::post('import_products', [ProductController::class, 'import_products'])->name('import_products');



    Route::resource('order_management', 'OrderManagementController');
    Route::get('get_orders', [OrderManagementController::class, 'get_data'])->name('get_orders');
    Route::get('get_more_products/{count?}', [OrderManagementController::class, 'get_more_products'])->name('get_more_products');
    Route::delete('order_management/bulk/delete', [OrderManagementController::class, 'order_bulk_delete'])->name('order_bulk_delete');




    Route::group(['middleware' => ['role:librarian']], function () {
    });
    Route::group(['middleware' => ['role:librarian|student|faculty']], function () {
    });

    Route::group(['middleware' => ['role:student|faculty']], function () {
    });
});







Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
