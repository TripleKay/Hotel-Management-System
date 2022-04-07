<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
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
}
