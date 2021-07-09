<?php

namespace App\Exports;

use App\Models\Lops;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LopsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
public function collection()
    {
        $lops = Lops::all();
        foreach ($lops as $row) {
            $lop[] = array(
                '0' => $row->id,
                '1' => $row->tenlop,
                '2' => $row->siso,
                '3' => $row->gvcn,
            );
        }

        return (collect($lop));
    }

    public function headings(): array
    {
        return [
            'id',
            'Lớp',
            'Sĩ số',
            'Giáo viên chủ nhiệm',
        ];
    }
}
