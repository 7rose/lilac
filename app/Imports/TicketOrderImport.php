<?php

namespace App\Imports;

use App\Ticket;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class TicketOrderImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $line = $rows->count();
        $ok = 0;

        foreach ($rows as $row) 
        {
            if($this->check($row)) {
                $t = Ticket::find(intval($row[0]));

                if(!empty($t)){
                    $new_logs = $t->logs;
                    $new_logs[] = ['time' => time(), 'do' => '登记入场次序: '.$row[1], 'by' => Auth::id()];
                    $t->sorted = intval($row[1]);
                    $t->logs = $new_logs;
                    $t->save();
                    // $ok++;
                }
            }
        }

        $conf = [
            'msg' => "导入文件总行数: {$line}, 操作成功: {$ok}",
            'icon_color' => 'success',
            'btn_color' => 'success',
        ];

        echo "导入文件总行数: {$line}, 操作成功: {$ok}<br>";
        // return view('note', compact('conf'));
    }

    // 检验
    private function check($row)
    {
        if(!isset($row[0]) || !isset($row[1])) return false;
        if(intval($row[0]) < 1 || intval($row[1]) < 1 ) return false;
        return true;
    }
}
