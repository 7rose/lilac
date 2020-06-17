@extends('nav')

@section('main')
<div class="nav-pad"></div>
<div class="form-group">
<label class="form-label" for="input-example-1">code</label>
<input class="form-input" type="number" id="code" placeholder="code" onchange="javascript:cut()">
<button class="btn btn-primary" onclick="javascript:cut()">okok</button>
</div>

<script>
    window.onload = function(){
        　counter = setInterval(cut, 500);
    }

     function cut()
     {
         console.log("fuck");

         var code = $("#code").val();
         if(code.length > 6) {
             var new_code = code.substring(0,5);
             $("#code").val(new_code);
         }
     }
</script>

@endsection
