<?php

namespace App\Exports;

use App\Models\Hoadons;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

use Illuminate\Support\Facades\DB;



class HoadonsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
public function collection()
    {
        //$hoadons = Hoadons::all();
        $hoadons = DB::table('hoadons')
            ->join('lops','hoadons.lop_id','=','lops.id')
            ->join('giays','hoadons.giay_id','=','giays.id')
            ->select('hoadons.*','lops.tenlop','giays.loaigiay')
            ->selectraw("(CASE WHEN (MOD(hoadons.sotrang,2)=0) THEN giays.tien * (hoadons.sotrang/2) ELSE (giays.tien * (hoadons.sotrang-1)/2) + giays.tien  END) as dongia")
            ->orderBy('created_at', 'desc')          
            ->get();        
        foreach ($hoadons as $row) {
            $hoadon[] = array(
                '0' => $row->id,
                '1' => $row->tenlop,
                '2' => date('d-m-Y',strtotime($row->ngay)),
                '3' => $row->gvbm,
                '4' => $row->noidung,
                '5' => $row->loaigiay,
                '6' => $row->sotrang, 
                '7' => $row->soluong,
                '8' => number_format($row->dongia),
                '9' => number_format($row->dongia * $row->soluong),                
                '10' => $row->ghichu,                               
            );
        }

        return (collect($hoadon));
    }

    public function headings(): array
    {
        return [
            'id',
            'lop_id',
            'Ngày',
            'GV',
            'Nội dung',
            'giay_id',
            'Số trang',
            'Số lượng',
            'Đơn giá',
            'Thành tiền',             
            'Ghi chú',                    
        ];
    }
    
    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function(AfterSheet $event) 
            {
                $cellRange = 'A1:K1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(15);
               	$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Arial');

				$event->sheet->getStyle('A1:K5')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
         		]);
   
         		
            },
        ];
    }
    

}
