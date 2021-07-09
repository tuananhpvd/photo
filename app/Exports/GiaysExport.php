<?php

namespace App\Exports;

use App\Models\Giays;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GiaysExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $giays = Giays::all();
        foreach ($giays as $row) {
            $giay[] = array(
                '0' => $row->id,
                '1' => $row->loaigiay,
                '2' => $row->tien,

            );
        }

        return (collect($giay));
    }

    public function headings(): array
    {
        return [
            'id',
            'Loại giấy',
            'Tiền',

        ];
    }
}
