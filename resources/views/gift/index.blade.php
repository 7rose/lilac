<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>MOOI幸运转轮</title>
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('gift/css/index.css') }}">

</head>
<body>

<div class="box-lottery">
	<div class="lottery-wrap" style="transform: rotate(-45deg);">
		<span class="lottery-span1" data-id="8">
			<i>MOOI卡<br>10元</i><img src="{{ asset('gift/img/lottery_01.png') }}" alt="MOOI卡10">
		</span>
		<span class="lottery-span2" data-id="7">
			<i>MOOI卡<br>20元</i><img src="{{ asset('gift/img/lottery_02.png') }}" alt="MOOI卡20">
		</span>
		<span class="lottery-span3" data-id="6">
			<i>MOOI卡<br>50元</i><img src="{{ asset('gift/img/lottery_03.png') }}" alt="MOOI卡50">
		</span>
		<span class="lottery-span4" data-id="5">
			<i>MOOI卡<br>100元</i><img src="{{ asset('gift/img/lottery_04.png') }}" alt="MOOI卡100">
		</span>
		<span class="lottery-span5" data-id="1">
			<i>谢谢参与</i><img src="{{ asset('gift/img/lottery_05.png') }}" alt="谢谢参与">
		</span>
		<span class="lottery-span6" data-id="4">
			<i>MOOI卡<br>200元</i><img src="{{ asset('gift/img/lottery_06.png') }}" alt="MOOI卡200">
		</span>
		<span class="lottery-span7" data-id="3">
			<i>MOOI卡<br>500元</i><img src="{{ asset('gift/img/lottery_07.png') }}" alt="MOOI卡500">
		</span>
		<span class="lottery-span8" data-id="2">
			<i>iQOO Pro<br>手机</i><img src="{{ asset('gift/img/lottery_08.png') }}" alt="iQOO Pro">
		</span>
	</div>
	<a class="lottery-btn" href="javascript:void(0);"><i></i>立即抽奖</a>
</div>
<div class="text-center">
<a href="/me" class="btn btn-primary">返回个人中心</a>
</div>

<script src="{{ asset('gift/js/jquery.min.js') }}"></script>
<script src="{{ asset('gift/js/lib/anime.min.js') }}"></script>
<script src="{{ asset('gift/js/app/lottery.js') }}"></script>
<script>
	var Lottery = Turntable.create();
	$('.lottery-btn').on('click', function(){
		var num = Math.floor(Math.random() * 8);
		Lottery.start(num, function(index){
			alert($('span').eq(index).find('i').text());
			console.log('index', index, 'lottery-span', 'lottery-span'+(index+1));
		});
	});
</script>

</body>
</html>