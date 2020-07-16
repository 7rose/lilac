<?php

namespace App\Exports;

use App\Ticket;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Ticket26Export implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ticket::select('id', 'created_at')->where('expo_id', 2)->orderBy('id')->get();
    }

    public function headings(): array
    {
        return[
            '票号',
            '日期',                      
        ];
    }
}
