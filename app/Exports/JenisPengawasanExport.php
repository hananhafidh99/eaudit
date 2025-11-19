<?php

namespace App\Exports;

use App\Models\Jenis_Pengawasan;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JenisPengawasanExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jenis_Pengawasan::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Jenis Pengawasan'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:D1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
