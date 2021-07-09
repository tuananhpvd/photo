<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use App\Models\Hoadons;
use Illuminate\Support\Facades\DB;

class XuatHoaDonController extends Controller
{
//	public function index(){
//	$hoadons = Hoadons::paginate(5);
//	return view('welcome', ['hoadons' => $hoadons]);
//	}

	public function export($type) {
//		$hoadons = Hoadons::all();
        $hoadons = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.tenlop','giays.loaigiay')
            ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN giays.tien * (hoadons.sotrang/2) ELSE (giays.tien * (hoadons.sotrang-1)/2) + giays.tien  END) as dongia")
            ->orderBy('created_at', 'desc')          
            ->get();
            
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Định dạng trang
		$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
		$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.25);
		// hết
		$spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(10);
		$spreadsheet->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);//cố định hàng đầu tiên

		$sheet->getStyle('A:H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		
        $sheet->getStyle('I')->getNumberFormat()->setFormatCode('#,###');	
        $sheet->getStyle('J')->getNumberFormat()->setFormatCode('#,###');


		$sheet->setCellValue('A2', 'Id');
		$sheet->setCellValue('B2', 'Lớp');	
		$sheet->setCellValue('C2', 'Ngày');
		$sheet->setCellValue('D2', 'Giáo viên');
		$sheet->setCellValue('E2', 'Nội dung');
		$sheet->setCellValue('F2', 'Giấy');	
		$sheet->setCellValue('G2', 'Số trang');
		$sheet->setCellValue('H2', 'Số lượng');
		$sheet->setCellValue('I2', 'Đơn giá');
		$sheet->setCellValue('J2', 'Thành tiền');		
		$sheet->setCellValue('K2', 'Ghi chú');		

		$rows = 3;

		foreach($hoadons as $hoadon){
			$sheet->setCellValue('A' . $rows, $hoadon->id);
			$sheet->setCellValue('B' . $rows, $hoadon->tenlop);
			$sheet->setCellValue('C' . $rows, date('d-m-Y',strtotime($hoadon->ngay)));
			$sheet->setCellValue('D' . $rows, $hoadon->gvbm);
			$sheet->setCellValue('E' . $rows, $hoadon->noidung);
			$sheet->setCellValue('F' . $rows, $hoadon->loaigiay);		
			$sheet->setCellValue('G' . $rows, $hoadon->sotrang);
			$sheet->setCellValue('H' . $rows, $hoadon->soluong);
			$sheet->setCellValue('I' . $rows, $hoadon->dongia);
			$sheet->setCellValue('J' . $rows, $hoadon->dongia * $hoadon->soluong);		
			$sheet->setCellValue('K' . $rows, $hoadon->ghichu);			

			$rows++;

			$sheet->getStyle('A1:K'.$rows)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
        	]);	

        	$sheet->setCellValue('J1','=SUM(J3:J'.$rows.')');//Công thức tổng tiền

		}

		$fileName = "XuatHoaDon.".$type;
		//luu file
		if($type == 'xlsx') {
			$writer = new Xlsx($spreadsheet);
			$writer->save($fileName);
		} 
		else if($type == 'xls') {
			$writer = new Xls($spreadsheet);
			$writer->save($fileName);
		}
		
		//$writer->save("/hoadon/".$fileName);
		// download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

//		return redirect(url('/'));//ve trang chu
	}
}
