<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\LopsExport;

use Maatwebsite\Excel\Facades\Excel;

class XuatLopController extends Controller
{
    public function export() 
    {
        return Excel::download(new LopsExport, 'Lop.xlsx');
    } 
}
