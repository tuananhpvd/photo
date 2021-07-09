<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use App\Models\Hoadons;
use App\Models\Lops;
use Illuminate\Support\Facades\DB;

class XuatHoaDonLopController extends Controller
{
    	public function export(Request $request) {

        $xuatlop = $request->input('xuatlop');    
        $tungay = $request->input('tungay');
        $denngay = $request->input('denngay');
		
        $hoadons = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.*','giays.loaigiay')
            ->where('lop_id', $xuatlop)  
            ->whereBetween('ngay', [$tungay.' 00:00:00',$denngay.' 23:59:59'])          
            ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN giays.tien * (hoadons.sotrang/2) ELSE (giays.tien * (hoadons.sotrang-1)/2) + giays.tien  END) as dongia")
            ->orderBy('ngay', 'asc')         
            ->get();
		
            
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();		

		// Định dạng trang
		$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
		$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.5);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.5);
		// hết
		$spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(10);
		$spreadsheet->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(6, 6);//cố định hàng đầu tiên

        $sheet->setCellValue('C1','BẢNG KÊ TIỀN PHOTOCOPY LỚP: ');
		foreach($hoadons as $hoadon){
        	$sheet->setCellValue('H1', $hoadon->tenlop);
			$sheet->setCellValue('D2', $hoadon->gvcn);	        
        	$sheet->setCellValue('I2', $hoadon->noptien);   //tiền NỘP
		} 

		$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(16);
		$sheet->setCellValue('I1','Đến ngày:');
		$sheet->setCellValue('J1', date('d/m/Y',strtotime($denngay)));		  
        $sheet->setCellValue('H2','Tiền nộp:');
        $sheet->setCellValue('H3','Tiền photo:');
        $sheet->setCellValue('H4','Tiền còn:');
        $sheet->setCellValue('I4','=I2-I3');   //tiền còn     
        $sheet->getStyle('C1:J4')->getFont()->setBold(true); 
		$sheet->getStyle('H2:I4')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
        ]); 

        foreach (range('A','C') as $col1) {
   			$sheet->getColumnDimension($col1)->setAutoSize(true);
		}   
        foreach (range('E','J') as $col2) {
   			$sheet->getColumnDimension($col2)->setAutoSize(true);
		}
		$spreadsheet->getActiveSheet()->getDefaultColumnDimension('D')->setWidth(12);		

        $sheet->getStyle('C1:H1')->getFont()->setBold(true);
        $sheet->getStyle('C1:J1')->getFont()->setSize(12); 
        $sheet->getStyle('C2:I4')->getFont()->setSize(11);               
        $spreadsheet->getActiveSheet()->mergeCells('C1:G1');
		$sheet->setCellValue('C2','GVCN:');        

		$sheet->getStyle('A:C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('E:G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);		
		$sheet->getStyle('A6:J6')->getFont()->setBold(true);		
		
        $sheet->getStyle('H')->getNumberFormat()->setFormatCode('#,###');	
        $sheet->getStyle('I')->getNumberFormat()->setFormatCode('#,###');


		$sheet->setCellValue('A6', 'TT');
		//$sheet->setCellValue('B6', 'Lớp');	
		$sheet->setCellValue('B6', 'Ngày');
		$sheet->setCellValue('C6', 'Giáo viên');
		$sheet->setCellValue('D6', 'Nội dung');
		$sheet->setCellValue('E6', 'Giấy');	
		$sheet->setCellValue('F6', 'Số trang');
		$sheet->setCellValue('G6', 'Số lượng');
		$sheet->setCellValue('H6', 'Đơn giá');
		$sheet->setCellValue('I6', 'Thành tiền');		
		$sheet->setCellValue('J6', 'Ghi chú');		

		$rows = 7;
		$stt = 1;

		foreach($hoadons as $hoadon){
			$sheet->setCellValue('A' . $rows, $stt);
			//$sheet->setCellValue('B' . $rows, $hoadon->tenlop);
			$sheet->setCellValue('B' . $rows, date('d/m',strtotime($hoadon->ngay)));
			$sheet->setCellValue('C' . $rows, $hoadon->gvbm);
			$sheet->setCellValue('D' . $rows, $hoadon->noidung);
			$sheet->setCellValue('E' . $rows, $hoadon->loaigiay);		
			$sheet->setCellValue('F' . $rows, $hoadon->sotrang);
			$sheet->setCellValue('G' . $rows, $hoadon->soluong);
			$sheet->setCellValue('H' . $rows, $hoadon->dongia);
			$sheet->setCellValue('I' . $rows, $hoadon->dongia * $hoadon->soluong);		
			$sheet->setCellValue('J' . $rows, $hoadon->ghichu);			

			$stt++;

			$sheet->getStyle('A6:J'.$rows)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
        	]);	

			$rows++;

        	$sheet->setCellValue('I3','=SUM(I6:I'.$rows.')');//Công thức tổng tiền foto

		}
	if($hoadons->isNotEmpty()){
		foreach($hoadons as $hoadon){
		$fileName = "XuatHoaDonLop-".$hoadon->tenlop.".xlsx";
		$writer = new Xlsx($spreadsheet);
		$writer->save($fileName);
		}
    }
    else
    {

		$fileName = "XuatHoaDonLop.xlsx";
		$writer = new Xlsx($spreadsheet);
		$writer->save($fileName);

    }		
		/*
		//$fileName = "XuatHoaDonLop.".$type;		
		//luu file
		
		if($type == 'xlsx') {
			$writer = new Xlsx($spreadsheet);
			$writer->save($fileName);
		} 
		else if($type == 'xls') {
			$writer = new Xls($spreadsheet);
			$writer->save($fileName);
		}*/
		
		//$writer->save("/hoadon/".$fileName);

		// download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

//		return redirect(url('/'));//ve trang chu
	}


    	public function gvcn(Request $request) {

        $tyle = $request->input('tyle');    
        $tungay = $request->input('tungay');
        $denngay = $request->input('denngay');
		
        $hoadons = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.*','giays.loaigiay')
            //->where('lop_id', $tyle)  
            ->whereBetween('ngay', [$tungay.' 00:00:00',$denngay.' 23:59:59'])          
            ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN giays.tien * (hoadons.sotrang/2) ELSE (giays.tien * (hoadons.sotrang-1)/2) + giays.tien  END) as dongia")
            ->orderBy('ngay', 'asc')         
            ->get();
		
        $lops = DB::table('lops')->get();

            
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Định dạng trang
		$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
		$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.5);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.25);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.5);
		// hết
		$spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(11);
		$spreadsheet->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(6, 6);//cố định hàng đầu tiên

        $sheet->setCellValue('B1','DANH SÁCH GVCN NHẬN TIỀN % PHOTOCOPY ');
        /*
		foreach($hoadons as $hoadon){
        	$sheet->setCellValue('J1', $hoadon->tenlop);
			$sheet->setCellValue('D2', $hoadon->gvcn);	        
        	$sheet->setCellValue('I2', $hoadon->noptien);   //tiền NỘP
		} */

		$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(16);
		$sheet->setCellValue('G1','Đến:');
		$sheet->setCellValue('H1', date('d/m/Y',strtotime($denngay)));		  
    
        $sheet->getStyle('A1:I2')->getFont()->setBold(true); 
        $sheet->getStyle('A1:I1')->getFont()->setSize(12); 

        foreach (range('A','I') as $col) {
   			$sheet->getColumnDimension($col)->setAutoSize(true);
		}   
		
		$spreadsheet->getActiveSheet()->getDefaultColumnDimension('D')->setWidth(12);		
		$sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); 
		$sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);		             
        $spreadsheet->getActiveSheet()->mergeCells('B1:F1');   

		$sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

		$sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('D:G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);						
		$sheet->getStyle('A2:I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);		
        $sheet->getStyle('D:G')->getNumberFormat()->setFormatCode('#,###');	

		$sheet->setCellValue('A2', 'TT');	
		$sheet->setCellValue('B2', 'Họ và tên');
		$sheet->setCellValue('C2', 'Lớp');
		$sheet->setCellValue('D2', 'Tiền nộp');
		$sheet->setCellValue('E2', 'Tiền photo');	
		$sheet->setCellValue('F2', 'Thừa/Thiếu');
		$sheet->setCellValue('G2', 'Tiền %');
		$sheet->setCellValue('H2', 'Ký nhận');
		//$sheet->setCellValue('I2', 'Ghi chú');	

		$rows = 3;
		$stt = 1;

	foreach ($lops as $lop) {

		$tongtien = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.*','giays.loaigiay')
            ->where('lop_id', '=',$lop->id)
            ->whereBetween('ngay', [$tungay.' 00:00:00',$denngay.' 23:59:59'])          
  			->selectraw(('SUM((CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN hoadons.soluong * giays.tien * (hoadons.sotrang/2) ELSE hoadons.soluong * ((giays.tien * (hoadons.sotrang-1)/2) + giays.tien)  END)) AS tongtien'))                 
            ->first();
//dd($tongtien);

			$sheet->setCellValue('A' . $rows, $stt);
			$sheet->setCellValue('B' . $rows, $lop->gvcn);
			$sheet->setCellValue('C' . $rows, $lop->tenlop);
			$sheet->setCellValue('D' . $rows, $lop->noptien);
			$sheet->setCellValue('E' . $rows, $tongtien->tongtien);		
			$sheet->setCellValue('F' . $rows, $lop->noptien - $tongtien->tongtien);
			$sheet->setCellValue('G' . $rows, (($tongtien->tongtien)*$tyle)/100);			

			$stt++;

			$sheet->getStyle('A2:H'.$rows)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
        	]);	

			$rows++; 
	}

    $sheet->setCellValue('D'.$rows,'=SUM(D3:D'.$rows.')');//Công thức tổng tiền gvcn nộp
    $sheet->setCellValue('E'.$rows,'=SUM(E3:E'.$rows.')');//Công thức tổng tiền photo
    $sheet->setCellValue('F'.$rows,'=SUM(F3:F'.$rows.')');//Công thức tổng tiền thừa/thiếu
    $sheet->setCellValue('G'.$rows,'=SUM(G3:G'.$rows.')');//Công thức tổng tiền % gvcn

	if($hoadons->isNotEmpty()){
		foreach($hoadons as $hoadon){
		$fileName = "GVCN.xlsx";
		$writer = new Xlsx($spreadsheet);
		$writer->save($fileName);
		}
    }
    else
    {

		$fileName = "GVCN0.xlsx";
		$writer = new Xlsx($spreadsheet);
		$writer->save($fileName);

    }		

		// download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

//		return redirect(url('/'));//ve trang chu
	}


}
