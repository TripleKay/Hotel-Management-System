<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\StaffDepartment;
use App\Models\StaffPayment;
use Illuminate\Support\Facades\Request as FacadesRequest;

use function PHPSTORM_META\map;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Staff::all();
        return view('staff.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = StaffDepartment::all();
        return view('staff.create',['departments'=>$departments]);
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
            'department_id'=>'required',
            'photo'=>'required',
            'bio'=>'required',
            'salary_type'=>'required',
            'salary_amt'=>'required'
        ]);

        $data = new Staff;
        $data->full_name = $request->full_name;
        $data->department_id = $request->department_id;

        //for photo
        $file = $request->file('photo');
        $newFileName = uniqid()."-".$file->getClientOriginalName();
        $filePath = $file->storeAs('public/imgs',$newFileName);
        $data->photo = $newFileName;

        $data->bio = $request->bio;
        $data->salary_type = $request->salary_type;
        $data->salary_amt = $request->salary_amt;
        $data->save();
        return redirect()->route('staff.create')->with('success','Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Staff::find($id);
        return view('staff.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Staff::find($id);
        $departments = StaffDepartment::all();
        return view('staff.edit',['data'=>$data,'departments'=>$departments]);
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
            'department_id'=>'required',
            'bio'=>'required',
            'salary_type'=>'required',
            'salary_amt'=>'required'
        ]);

        $data = Staff::find($id);
        $data->full_name = $request->full_name;
        $data->department_id = $request->department_id;

        //for photo
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $newFileName = uniqid()."-".$file->getClientOriginalName();
            $filePath = $file->storeAs('public/imgs',$newFileName);
            $data->photo = $newFileName;
        };

        $data->bio = $request->bio;
        $data->salary_type = $request->salary_type;
        $data->salary_amt = $request->salary_amt;
        $data->update();
        return redirect()->route('staff.edit',$id)->with('success','Data has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Staff::find($id);
        $data->delete();
        return redirect()->route('staff.index',)->with('success','Data has been deleted');
    }


    //to show all payment by staff
    public function allPayment($staffId){
        $data = StaffPayment::where('staff_id',$staffId)->get();
        $staff = Staff::find($staffId);
        return view('staffPayment.index',['staffId'=>$staffId,'data'=>$data,'staff'=>$staff]);//staffId for action(delete,create) , data for to show
    }

    //create staff Payment
    public function createPayment($staffId){
        return view('staffPayment.create',['staffId'=>$staffId]);
    }

    //to store staff Payment
    public function storePayment(Request $request,$staffId){
        $data = new StaffPayment;
        $data->staff_id = $staffId;
        $data->amount = $request->amount;
        $data->payment_date = $request->payment_date;
        $data->save();
        return redirect()->route('staffPayment.create',$staffId)->with('success','Data has been added');
    }

    //to delete payment for each staff
    public function destroyPayment($id,$staffId){
        $payment = StaffPayment::find($id);
        $payment->delete();
        return redirect()->route('staffPayment.all',$staffId);
    }

}
