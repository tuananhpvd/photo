<?php

namespace App\Http\Controllers\Hoadon;

use App\Models\Giays;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GiayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giays = DB::table('giays')->get(); 
               
 
        $pageName = 'Tên Trang - Loại giấy';

        return view('/hoadon/giay_xem', compact('giays','pageName'))->with(['index'=>1]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('hoadon/giay_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$input = $request->all();
        //$input['loaigiay'] = implode(', ', $request->input('loaigiay')); //tạo thành string
        //$input['loaigiay'] = json_encode($request->input('loaigiay')); //tạo thành array
        //Giays::create($input);

            $data = $request->all();

    foreach ($data['loaigiay'] as $index=>$dem) {
        Giays::create([

            'loaigiay' => $data['loaigiay'][$index],
            'tien' => $request->input('tien'),

        ]);
    }
  

        return redirect()->action('App\Http\Controllers\Hoadon\GiayController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$giays = DB::table('giays')->get();  

        $giays = Giays::findOrFail($id);
        $pageName = 'Giấy - Update';
        return view('/hoadon/giay_update', compact('giays', 'pageName'));
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
        $giays = Giays::find($id);

        $giays->loaigiay = $request->loaigiay; 
        $giays->tien = $request->tien;

        $giays->save();

        return redirect()->action('App\Http\Controllers\Hoadon\GiayController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giays = Giays::find($id);

        $giays->delete();
        return redirect()->action('App\Http\Controllers\Hoadon\GiayController@index')->with('success','Dữ liệu xóa thành công.');
    }
}
