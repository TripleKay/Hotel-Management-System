<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomtypeController;

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
    return view('welcome');
});

Route::get('admin', function () {
    return view('dashboard');
});

Route::get('admin/roomtype/{id}/delete',[RoomtypeController::class,'destroy'])->name('roomtype.delete');
Route::resource('admin/roomtype',RoomtypeController::class);

Route::get('admin/room/{id}/delete',[RoomController::class,'destroy'])->name('room.delete');
Route::resource('admin/room',RoomController::class);

Route::get('admin/customer/{id}/delete',[CustomerController::class,'destroy'])->name('customer.delete');
Route::resource('admin/customer',CustomerController::class);
