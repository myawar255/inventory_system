<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowRequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IssuedBooksController;
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
        Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('reports_print', [ReportsController::class, 'reports_print'])->name('reports.print');
        Route::get('reports_get/{type}', [ReportsController::class, 'reports_getData'])->name('reports.getData');

        // Users Management
        Route::resource('users', 'UserController');
        Route::get('get_users', [UserController::class, 'get_data'])->name('get_users');
    });

    Route::group(['middleware' => ['role:librarian']], function () {
        // Author Management
        Route::resource('author', 'AuthorController');
        Route::get('get_author', [AuthorController::class, 'get_data'])->name('get_author');
        // category Management
        Route::resource('categories', 'CategoryController');
        Route::get('get_categories', [CategoryController::class, 'get_data'])->name('get_categories');
        Route::post('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        // Books Management
        Route::resource('book', 'BookController');
        Route::get('get_books', [BookController::class, 'get_data'])->name('get_books');
        Route::post('book/{id}', [BookController::class, 'update'])->name('book.update');
        // Issued Book Management
        Route::resource('issuedBooks', 'IssuedBooksController');
        Route::get('get_issuedBooks', [IssuedBooksController::class, 'get_data'])->name('get_issuedBooks');
        Route::post('return_issuedBooks', [IssuedBooksController::class, 'return_issuedBooks'])->name('return_issuedBooks');
        Route::get('return_book/{id}', [IssuedBooksController::class, 'return_book'])->name('return_book');
        Route::post('check_book_availability', [IssuedBooksController::class, 'check_book_availability'])->name('check_book_availability');
        Route::post('return_book_data', [IssuedBooksController::class, 'return_book_data'])->name('return_book_data');
        // Request Books
        Route::get('requested_books', [RequestedBooksController::class, 'index'])->name('requested_books.index');
        Route::get('get_requested_books', [RequestedBooksController::class, 'get_requested_books'])->name('requested_books.get_requested_books');
        Route::get('delete_book_request/{id}', [RequestedBooksController::class, 'delete_book_request'])->name('requested_books.delete_book_request');

        // Reserve Books
        Route::get('reserve_request', [ReserveRequestController::class, 'index'])->name('reserve_request.index');
        Route::get('get_reserved_request', [ReserveRequestController::class, 'get_reserved_request'])->name('reserve_request.get_reserved_request');
        Route::get('reserve_request/add_reserved_request', [ReserveRequestController::class, 'add_reserved_request'])->name('reserve_request.add_reserved_request');
        Route::get('delete_reserved_request/{id}', [ReserveRequestController::class, 'delete_reserved_request'])->name('reserve_request.delete_reserved_request');
        Route::get('show_reserve_approve_req/{id}', [ReserveRequestController::class, 'show_reserve_approve_req'])->name('renew_request.show_reserve_approve_req');
        Route::post('approve_reserve', [ReserveRequestController::class, 'approve_reserve'])->name('reserve_request.approve_reserve');

        // Renew Request
        Route::get('renew_request', [RenewRequestController::class, 'index'])->name('renew_request.index');
        Route::get('get_renew_request', [RenewRequestController::class, 'get_renew_request'])->name('renew_request.get_renew_request');
        Route::get('delete_renew_request/{id}', [RenewRequestController::class, 'delete_renew_request'])->name('renew_request.delete_renew_request');
        Route::get('show_renew_approve_req/{id}', [RenewRequestController::class, 'show_renew_approve_req'])->name('renew_request.show_renew_approve_req');
        Route::post('approve_renew', [RenewRequestController::class, 'approve_renew'])->name('renew_request.approve_renew');
        Route::get('get_issue_data_on_renew/{id}', [RenewRequestController::class, 'get_issue_data_on_renew'])->name('renew_request.get_issue_data_on_renew');

        // Return Request
        Route::get('return_request', [ReturnRequestController::class, 'index'])->name('return_request.index');
        Route::get('get_return_request', [ReturnRequestController::class, 'get_return_request'])->name('return_request.get_return_request');
        Route::get('return_request/add_return_request', [ReturnRequestController::class, 'add_return_request'])->name('return_request.add_return_request');
        Route::get('show_return_approve_req/{id}', [ReturnRequestController::class, 'show_return_approve_req'])->name('return_request.show_return_approve_req');
        Route::post('approve_return',[ReturnRequestController::class, 'approve_return'])->name('return_request.approve_return');
        Route::get('delete_return_request/{id}', [ReturnRequestController::class, 'delete_return_request'])->name('return_request.delete_return_request');

        // Borrow Request
        Route::get('borrow_request', [BorrowRequestController::class, 'index'])->name('borrow_request.index');
        Route::get('get_borrow_request', [BorrowRequestController::class, 'get_borrow_request'])->name('borrow_request.get_borrow_request');
        Route::get('borrow_request/add_borrow_request', [BorrowRequestController::class, 'add_borrow_request'])->name('borrow_request.add_borrow_request');
        Route::get('show_borrow_approve_req/{id}', [BorrowRequestController::class, 'show_borrow_approve_req'])->name('borrow_request.show_borrow_approve_req');
        Route::post('approve_borrow', [BorrowRequestController::class, 'approve_borrow'])->name('borrow_request.approve_borrow');
        Route::get('delete_borrow_request/{id}', [BorrowRequestController::class, 'delete_borrow_request'])->name('borrow_request.delete_borrow_request');
    });
    Route::group(['middleware' => ['role:librarian|student|faculty']], function () {
        Route::get('books/view_book/{id}/{user_info?}', [BookController::class, 'view_book'])->name('book.view_book');
        Route::get('renew_request/add_renew_request/{book_id?}', [RenewRequestController::class, 'add_renew_request'])->name('renew_request.add_renew_request');
        Route::post('save_renew_request', [RenewRequestController::class, 'save_renew_request'])->name('renew_request.save_renew_request');
        Route::get('add_request', [RequestedBooksController::class, 'add_request'])->name('requested_books.add_request');
        Route::post('save_request', [RequestedBooksController::class, 'save_request'])->name('requested_books.save_request');
        Route::post('save_borrow_request', [BorrowRequestController::class, 'save_borrow_request'])->name('borrow_request.save_borrow_request');
        Route::post('save_reserved_request', [ReserveRequestController::class, 'save_reserved_request'])->name('reserve_request.save_reserved_request');
        Route::match(['get', 'post'], 'save_return_request', [ReturnRequestController::class, 'save_return_request'])->name('return_request.save_return_request');
    });

    Route::group(['middleware' => ['role:student|faculty']], function () {
        Route::match(['get', 'post'], 'category', [CategoryController::class, 'user_categories'])->name('categories.user');
        Route::match(['get', 'post'], 'books', [BookController::class, 'user_books'])->name('book.user');
        // profile routes
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('profile/getData/{type}', [ProfileController::class, 'getData'])->name('profile.getData');
        Route::get('profile/get_issued_books', [ProfileController::class, 'get_issued_books'])->name('profile.get_issued_books');
        Route::get('profile/get_returned_books', [ProfileController::class, 'get_returned_books'])->name('profile.get_returned_books');
        Route::get('profile/get_requested_books', [ProfileController::class, 'get_requested_books'])->name('profile.get_requested_books');
        Route::get('profile/get_reserved_books', [ProfileController::class, 'get_reserved_books'])->name('profile.get_reserved_books');
    });
});







Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
