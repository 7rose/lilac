<?php

$nodes = App\Org::get()->toTree();

$traverse = function ($categories, $prefix = '') use (&$traverse) {
    foreach ($categories as $category) {
        echo PHP_EOL.$prefix.' '.show($category->info, 'name', $category->key).'<br>';

        $traverse($category->children, $prefix.'|--');
    }
};

?>
@extends('../nav')

@section('main')
<div class="nav-pad"></div>
<div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <div class="hero bg-gray">
{{ $traverse($nodes) }}
    </div>
</div>

@endsection
