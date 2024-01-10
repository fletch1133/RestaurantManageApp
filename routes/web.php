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

    //Add Data Manage, Cashier and Report
    Route::get('/management', function() { 
        return view('management.index', ['slot' => '']);
    }); 

    Route::resource('management/category', 'App\Http\Controllers\Management\CategoryController');  
    Route::resource('management/menu', 'App\Http\Controllers\Management\MenuController'); 

    Route::get('/cashier', function () {
        return view('cashier.index', ['slot' => '']);
    });

    Route::get('/report', function() { 
        return view('report.index', ['slot' => '']); 
    });

    Route::delete('/management/category/{id}', 'App\Http\Controllers\Management\CategoryController@destroy');
    //Route for the delete button to function

});

require __DIR__.'/auth.php';
