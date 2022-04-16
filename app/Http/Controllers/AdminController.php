<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    //login
    public function login(){
        return view('login');
    }
    //checkLogin
    public function checkLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $admin = Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->count();
        if($admin>0){
            $adminData = Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->get();
            session(['adminData'=>$adminData]);

            //remember me
            if($request->has('remember_me')){
                Cookie::queue('adminUserName',$request->username,1440);
                Cookie::queue('adminPassword',$request->password,1440);
            };
            return redirect('admin');
        }else{
            return redirect()->route('admin.login')->with('message','Invalid username or password!!');
        }
    }

    //logout
    public function logout(){
        session()->forget('adminData');
        return redirect()->route('admin.login');
    }

    //dashboard
    public function dashboard(){
        //get total_booking for each checkin_date
        $bookings = Booking::selectRaw('count(id) as total_bookings,checkin_date')->groupBy('checkin_date')->get();

        //for line chart
        $labels = [];
        $data = [];
        foreach($bookings as $booking){
            $labels[] = $booking['checkin_date'];
            $data[] = $booking['total_bookings'];
        }

        //for pie chart
        $rtBookings = DB::table('room_types as rt')
            ->join('rooms as r','r.room_type_id','=','rt.id')
            ->join('bookings as b','b.room_id','=','r.id')
            ->select('rt.*','r.*','b.*',DB::raw('count(b.id) as total_bookings'))
            ->groupBy('r.room_type_id')
            ->get();

        $plabels = [];
        $pdata = [];
        foreach($rtBookings as $rtbooking){
            $id = $rtbooking->room_type_id;
            $roomtype = RoomType::find($id)->title;
            $plabels[] = $roomtype;
            $pdata[] = $rtbooking->total_bookings;
        };

        return view('dashboard',['labels'=>$labels,'data'=>$data,'plabels'=>$plabels,'pdata'=>$pdata]);
    }
}

