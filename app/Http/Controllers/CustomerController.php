<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();
        return view('customer.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'photo'=>'required'
        ]);
        $data = new Customer;
        $file = $request->file('photo');
        $newFileName = uniqid()."-".$file->getClientOriginalName();
        $filePath = $file->storeAs('public/imgs',$newFileName);
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->password = sha1($request->password);
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->photo = $newFileName;
        $data->save();
        return redirect()->route('customer.create')->with('success','Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Customer::find($id);
        return view('customer.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Customer::find($id);
        return view('customer.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'address'=>'required',
        ]);

        $data = Customer::find($id);


        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newFileName = uniqid()."-".$file->getClientOriginalName();
            $filePath = $file->storeAs('public/imgs',$newFileName);
            $data->photo = $newFileName;
        }else{
            $data->photo = $request->prev_photo;
        }
        $data->full_name = $request->full_name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->update();
        return redirect()->route('customer.edit',$id)->with('success','Data has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->delete();
        return redirect()->route('customer.index',)->with('success','Data has been deleted');
    }
}
