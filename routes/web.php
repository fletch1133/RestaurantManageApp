<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Routes for management
    Route::get('/management', function() { 
        return view('management.index', ['slot' => '']);
    }); 

    Route::resource('management/category', 'App\Http\Controllers\Management\CategoryController');  
    Route::resource('management/menu', 'App\Http\Controllers\Management\MenuController'); 
    Route::resource('management/table', 'App\Http\Controllers\Management\TableController'); 

    Route::delete('/management/category/{id}', 'App\Http\Controllers\Management\CategoryController@destroy');
    //Route for the delete button to function


    //Routes for cashier
    Route::get('/cashier', 'App\Http\Controllers\Cashier\CashierController@index'); 

    Route::get('/cashier/getMenuByCategory/{category_id}', 'App\Http\Controllers\Cashier\CashierController@getMenuByCategory'); 

    Route::get('/cashier/getTable', 'App\Http\Controllers\Cashier\CashierController@getTables');

    Route::get('/cashier/getSaleDetailsByTable/{table_id}', 'App\Http\Controllers\Cashier\CashierController@getSaleDetailsByTable');

    Route::post('/cashier/orderFood', 'App\Http\Controllers\Cashier\CashierController@orderFood');

    Route::post('/cashier/deleteSaleDetail', 'App\Http\Controllers\Cashier\CashierController@deleteSaleDetail');

    Route::post('/cashier/confirmOrderStatus', 'App\Http\Controllers\Cashier\CashierController@confirmOrderStatus'); 

    Route::post('/cashier/savePayment', 'App\Http\Controllers\Cashier\CashierController@savePayment'); 

    Route::get('/cashier/showReceipt/{saleID}', 'App\Http\Controllers\Cashier\CashierController@showReceipt');


    //Routes for report
    Route::get('/report', 'App\Http\Controllers\Report\ReportController@index'); 

    Route::get('/report/show', 'App\Http\Controllers\Report\ReportController@show'); 


});

require __DIR__.'/auth.php';
