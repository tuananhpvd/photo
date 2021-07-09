<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\HoadonsExport;

//use Maatwebsite\Excel\Facades\Excel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XuatHoaDonController extends Controller
{
    public function export() 
    {
     //   return Excel::download(new HoadonsExport, 'Hoadon.xlsx');


		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World !');

		$writer = new Xlsx($spreadsheet);
		$writer->save('hello world A.xlsx');

		return view('welcome');
 	}
}
