<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Users;
use App\Http\Livewire\Profile;
use App\Http\Controllers\HomeController;
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
    return view('home');
});

Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(["auth"])->group(function(){
    
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/users', Users::class)->name('users');
    Route::get('/verification',[HomeController::class,'verification'])->name('verification')->middleware('verified');
});

/*
Route::get("/exportPDF",[App\Http\Controllers\HomeController::class,'exportPDF'])->name('exportPDF');
*/