<?php
namespace App;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\StaffDepartmentController;

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

//staffDepartment
Route::get('admin/department/{id}/delete',[StaffDepartmentController::class,'destroy'])->name('department.delete');
Route::resource('admin/department',StaffDepartmentController::class);

//staff
Route::get('admin/staff/{id}/delete',[StaffController::class,'destroy'])->name('staff.delete');
Route::resource('admin/staff',StaffController::class);

//staffPayment
Route::get('admin/staff-payment/{id}/',[StaffController::class,'allPayment'])->name('staffPayment.all');
Route::get('admin/staff-payment/{id}/add',[StaffController::class,'createPayment'])->name('staffPayment.create');
Route::post('admin/staff-payment/{id}/add',[StaffController::class,'storePayment'])->name('staffPayment.store');
Route::get('admin/staff-payment/{id}/{staffId}/delete',[StaffController::class,'destroyPayment'])->name('staffPayment.delete');

//Booking
Route::get('admin/booking/avaiable-rooms/{checkinDate}',[BookingController::class,'avaiableRooms'])->name('booking.avaiableRooms');
Route::get('admin/booking/{id}/delete',[BookingController::class,'destroy'])->name('booking.delete');
Route::resource('admin/booking',BookingController::class);
