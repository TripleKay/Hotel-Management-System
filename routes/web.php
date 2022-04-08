<?php

use App\Http\Controllers\AdminController;
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

//Adminlogin
Route::get('admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('admin/login',[AdminController::class,'checkLogin'])->name('admin.login');
Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');

//dashboard
Route::get('admin', function () {
    return view('dashboard');
});

//roomtype
Route::get('admin/roomtype/{id}/delete',[RoomtypeController::class,'destroy'])->name('roomtype.delete');
Route::resource('admin/roomtype',RoomtypeController::class);

//room
Route::get('admin/room/{id}/delete',[RoomController::class,'destroy'])->name('room.delete');
Route::resource('admin/room',RoomController::class);

//customer
Route::get('admin/customer/{id}/delete',[CustomerController::class,'destroy'])->name('customer.delete');
Route::resource('admin/customer',CustomerController::class);

//to delete roomtypeImages
Route::get('admin/roomtypeimage/delete/{id}',[RoomtypeController::class,'destroyImage'])->name('roomtypeimage.delete');
