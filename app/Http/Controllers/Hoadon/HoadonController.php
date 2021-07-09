<?php

namespace App\Http\Controllers\Hoadon;

use App\Models\Hoadons;
use App\Models\Lops;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Request;
//use Request; 

class HoadonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$hoadons = DB::table('hoadons')->select('*');
        $hoadons = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.tenlop','giays.loaigiay')
            //->selectraw('giays.tien * hoadons.sotrang as dongia')
            ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN giays.tien * (hoadons.sotrang/2) ELSE (giays.tien * (hoadons.sotrang-1)/2) + giays.tien  END) as dongia")
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        //    ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN hoadons.soluong * giays.tien * (hoadons.sotrang/2) ELSE hoadons.soluong * ((giays.tien * (hoadons.sotrang-1)/2) + giays.tien)  END) as thanhtien")            
            //->get();
        $lops = DB::table('lops')->get();
        $pageName = 'Tên Trang - Hóa đơn';

        return view('/hoadon/hoadon_xem', compact('hoadons', 'lops','pageName'))->with(['index'=>1]);

        //return view('/hoadon/xem');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $lops = DB::table('lops')->get();
        $giays = DB::table('giays')->get();        
        //$hoadons = $hoadons->get();

        $pageName = 'Tên Trang - Hóa đơn';

        return view('/hoadon/hoadon_create', compact('lops','giays','pageName'));
        //return view('hoadon/hoadon_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->all();

    foreach ($data['idlop'] as $index=>$dem) {
        $ss = DB::table('lops')->select('siso')->where('id','=',$dem)->first(); 

//dd($ss);
        Hoadons::create([

            'lop_id' => $data['idlop'][$index],
            'ngay' => $request->input('ngay'),
            'gvbm' => $request->input('gvbm'),            
            'noidung' => $request->input('noidung'),
            'giay_id' => $request->input('loaigiay'),
            'sotrang' => $request->input('sotrang'),
    
            'soluong' => $ss->siso,

            'ghichu' => $request->input('ghichu'), 
                       
        ]);


        }

        return redirect()->action('App\Http\Controllers\Hoadon\HoadonController@create');
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
        $lops = DB::table('lops')->get();
        $giays = DB::table('giays')->get();  

        $hoadons = Hoadons::findOrFail($id);
        $pageName = 'Hóa đơn - Update';
        return view('/hoadon/hoadon_update', compact('hoadons', 'lops','giays', 'pageName'));
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
        $hoadons = Hoadons::find($id);

        $hoadons->lop_id = $request->malop;
 
        $hoadons->ngay = $request->ngay;
        $hoadons->gvbm = $request->gvbm;
        $hoadons->noidung = $request->noidung; 
        $hoadons->giay_id = $request->loaigiay;
        $hoadons->sotrang = $request->sotrang;
        $hoadons->soluong = $request->soluong; 
        $hoadons->ghichu = $request->ghichu;

        $hoadons->save();

        return redirect()->action('App\Http\Controllers\Hoadon\HoadonController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hoadons = Hoadons::find($id);

        $hoadons->delete();
        return redirect()->action('App\Http\Controllers\Hoadon\HoadonController@index')->with('success','Dữ liệu xóa thành công.');
    }

    public function xemlop(Request $request)
    {
        //$hoadons = DB::table('hoadons')->select('*');
        $hoadons = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.*','giays.*')

            ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN giays.tien * (hoadons.sotrang/2) ELSE (giays.tien * (hoadons.sotrang-1)/2) + giays.tien  END) as dongia")
            ->orderBy('ngay', 'desc') 
            //->where('lop_id', Request::input('lopid')) 
            ->where('lop_id', $request->lopid )            
            ->get();
        $lops = DB::table('lops')->get(); 

        //$rows = DB::table('hoadons')->select('hoadons.*')->where('lop_id', Request::input('lopid'))->get();

        $pageName = 'Tên Trang - Hóa đơn từng lớp';

        return view('/hoadon/hoadon_xemlop', compact('hoadons', 'lops','pageName'))->with(['index'=>1]);

        //return view('/hoadon/xem');
    }
    public function search(Request $request){
    // Get the search value from the request
        $search = $request->input('search');

    // Search in the title and body columns from the posts table
        $hoadons = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.tenlop','giays.loaigiay')
//            ->where('tenlop', 'LIKE', "%{$search}%")  
            ->where('lop_id', $search)
            //->selectraw('giays.tien * hoadons.sotrang as dongia')
            ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN giays.tien * (hoadons.sotrang/2) ELSE (giays.tien * (hoadons.sotrang-1)/2) + giays.tien  END) as dongia")
            ->orderBy('ngay', 'desc')        
            ->get();
        $lops = DB::table('lops')->get();             
//        $hoadons = Hoadons::query()
//            ->where('gvbm', 'LIKE', "%{$search}%")
//            ->get();
        $pageName = 'Tên Trang - Hóa đơn từng lớp';
    // Return the search view with the resluts compacted
        return view('/hoadon/search', compact('hoadons','lops','pageName'))->with(['index'=>1]);
    }

    public function xoahet()
    {
        Hoadons::truncate();

        return redirect()->action('App\Http\Controllers\Hoadon\HoadonController@index')->with('success','Dữ liệu xóa thành công.');
    }

}
