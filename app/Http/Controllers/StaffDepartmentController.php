<?php

namespace App\Http\Controllers;

use App\Models\StaffDepartment;
use Illuminate\Http\Request;

class StaffDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StaffDepartment::all();
        return view('department.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
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
            'title' => 'required',
            'detail' => 'required',
        ]);
        $data = new StaffDepartment;
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->save();



        return redirect()->route('department.create')->with('success','Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = StaffDepartment::find($id);
        return view('department.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = StaffDepartment::find($id);
        return view('department.edit',['data'=>$data]);
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
        $data = StaffDepartment::find($id);
        $data->title = $request->title;
        $data->detail = $request->detail;
        $data->update();
        return redirect()->route('department.edit',$id)->with('success','Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = StaffDepartment::find($id);
        $data->delete();
        return redirect()->route('department.index',)->with('success','Data has been deleted');
    }

}
