<?php

namespace App\Exports;

use App\Ticket;
use App\Exports\Ticket25Export;
use App\Exports\Ticket26Export;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TicketExport implements FromArray, WithHeadings, WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Ticket::select('id', 'created_at')->orderBy('id')->get();
    // }

    public function headings(): array
    {
        return[
            '票号',
            '日期',                      
        ];
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [
            new Ticket25Export($this->sheets['7/25']),
            new Ticket26Export($this->sheets['7/26']),
        ];

        return $sheets;
 
    }
}
