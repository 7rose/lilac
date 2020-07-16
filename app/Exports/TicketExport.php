<?php

namespace App\Exports;

use App\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;

class TicketExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ticket::select('id', 'created_at')->orderBy('id')->get();
    }

    public function headings(): array
    {
        return[
            '票号',
            '日期',                      
        ];
    }
}
