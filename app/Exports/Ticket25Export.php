<?php

namespace App\Exports;

use App\Ticket;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class Ticket25Export implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ticket::select('id', 'created_at')->where('expo_id', 1)->orderBy('id')->get();
    }

    public function headings(): array
    {
        return[
            '票号',
            '日期',                      
        ];
    }
}
