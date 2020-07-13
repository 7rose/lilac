@extends('nav')

@section('main')
<div class="column col-12">
    <div class="empty text-left">
    <div class="nav-pad"></div>
      <?php
          $users = App\User::has('tickets')->get()->count();
            // $u1 =  App\User::where(function($query))->get()->count();
            $u1 = App\User::has('tickets',1)->get()->count();
            $u2 = App\User::has('tickets',2)->get()->count();
            $u3 = App\User::has('tickets',3)->get()->count();
            $u4 = App\User::has('tickets',4)->get()->count();

            
            $t = App\Ticket::all()->count();
            $t1 = App\Ticket::whereDate('created_at', '2020-07-11')->get()->count();
            $t2 = App\Ticket::whereDate('created_at', '2020-07-12')->get()->count();
            $t3 = App\Ticket::whereDate('created_at', '2020-07-13')->get()->count();
            $t4 = App\Ticket::whereDate('created_at', '2020-07-14')->get()->count();
            
            // $t3 = App\Ticket::whereDate('created_at', '2020-07-11')->distinct('user_id')->count();
            // $t4 = App\Ticket::whereDate('created_at', '2020-07-12')->distinct('user_id')->count();

            $t5 = App\Ticket::where('expo_id',1)->get()->count();
            $t6 = App\Ticket::where('expo_id',2)->get()->count();
            
            echo '购票人数量: '.$users.'<br>购1张的: '.$u1.'<br>购2张的: '.$u2.'<br>购3张的: '.$u3.'<br>购4张的: '.$u4;
            // echo '<br>7/11买票人数: '.$t3. '<br>7/12买票人数:'.$t4;
            echo '<br>-----<br>总销售: '.$t.', 其中 :<br>7/11: '.$t1.'<br>7/12: '.$t2;
            echo '<br>7/13: '.$t3.'<br>7/14: '.$t4;

            echo '<br> 7/25票已销售: '. $t5. '<br> 7/26票已销售: '. $t6;

            $u4 = App\User::all()->count();
            $u5 = App\User::whereDate('created_at', '2020-07-11')->get()->count();
            $u6 = App\User::whereDate('created_at', '2020-07-12')->get()->count();

            echo '<br>-----<br>注册用户: '.$u4.', 其中新增 :<br>7/11: '.$u5.'<br>7/12: '.$u6;

            $log = face(Auth::user())->name. ' 正在查看统计数据';
            Log::info($log); 
      ?>
    </div>
</div>
@endsection
