<?php

namespace App\Http\Controllers\Hoadon;

use App\Models\Lops;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lops = DB::table('lops')->get();

        //$hoadons = $hoadons->get();

        $pageName = 'Tên Trang - Lớp';

        return view('/hoadon/lop_xem', compact('lops','pageName'))->with(['index'=>1]);

        //return view('/hoadon/xem');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hoadon/lop_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lops = new Lops;
        $lops->tenlop = $request->tenlop; 
        $lops->siso = $request->siso;
        $lops->noptien = $request->noptien;        
        $lops->gvcn = $request->gvcn;

        $lops->save();

        return redirect()->action('App\Http\Controllers\Hoadon\LopController@create');
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
        $lops = Lops::findOrFail($id);
        $pageName = 'Lớp - Update';
        return view('/hoadon/lop_update', compact('lops', 'pageName'));
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
        $lops = Lops::find($id);

        $lops->tenlop = $request->tenlop; 
        $lops->siso = $request->siso;
        $lops->noptien = $request->noptien; 
        $lops->gvcn = $request->gvcn;        

        $lops->save();

        return redirect()->action('App\Http\Controllers\Hoadon\LopController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lops = Lops::find($id);

        $lops->delete();
        return redirect()->action('App\Http\Controllers\Hoadon\LopController@index')->with('success','Dữ liệu xóa thành công.');
    }
}
