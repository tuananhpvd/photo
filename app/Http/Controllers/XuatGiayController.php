<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\GiaysExport;

use Maatwebsite\Excel\Facades\Excel;

class XuatGiayController extends Controller
{  
    public function export() 
    {
        return Excel::download(new GiaysExport, 'Giay.xlsx');
    }  
}
