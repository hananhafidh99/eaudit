<?php

namespace App\Exports;

use App\Models\Eselon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EselonExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data->toArray();
    }

    public function headings(): array
    {
        return[
            'ID',
            'Eselon'
        ];
    }

}
