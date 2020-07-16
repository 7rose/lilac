<?php

namespace App\Exports;

use App\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;

class Ticket26Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ticket::select('id', 'created_at')->where('expo_id', 2)->orderBy('id')->get();
    }
}
