<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\RoomtypeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RoomType::all();
        return view('roomtype.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roomtype.create');
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
            'price' => 'required',
            'detail' => 'required',
        ]);
        $data = new RoomType;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->detail = $request->detail;
        $data->save();

        //multiple imgs
        foreach($request->file('imgs') as $img){
            $imgName = uniqid()."-".$img->getClientOriginalName();
            $imgPath = $img->storeAs('public/imgs',$imgName);
            $imgData = new RoomtypeImage;
            $imgData->img_src = $imgName;
            $imgData->img_alt = $request->title;
            $imgData->room_type_id = $data->id;
            $imgData->save();
        }

        return redirect()->route('roomtype.create')->with('success','Data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = RoomType::find($id);
        return view('roomtype.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = RoomType::find($id);
        return view('roomtype.edit',['data'=>$data]);
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
        $data = RoomType::find($id);
        $data->title = $request->title;
        $data->price = $request->price;
        $data->detail = $request->detail;
        $data->update();

        //to add new multiple imgs
        if($request->hasFile('imgs')){
            foreach($request->file('imgs') as $img){
                $imgName = uniqid()."-".$img->getClientOriginalName();
                $imgPath = $img->storeAs('public/imgs',$imgName);
                $imgData = new RoomtypeImage;
                $imgData->img_src = $imgName;
                $imgData->img_alt = $request->title;
                $imgData->room_type_id = $data->id;
                $imgData->save(); // to add new row to database (not update on existing row) so use save()
            }
        }
        return redirect()->route('roomtype.edit',$id)->with('success','Data has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RoomType::find($id);
        $data->delete();
        return redirect()->route('roomtype.index',)->with('success','Data has been deleted');
    }

    //to delete roomtypesImages
    public function destroyImage($id)
    {
        $data = RoomtypeImage::find($id);
        Storage::disk('public')->delete("imgs/".$data->img_src);//to delete img from storage
        $data->delete();//to delete from database
        return response()->json(['bool'=>true]);
    }
}
