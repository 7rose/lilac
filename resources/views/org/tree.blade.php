<?php

$nodes = App\Org::get()->toTree();

$traverse = function ($rogs, $prefix = '') use (&$traverse) {
    foreach ($rogs as $org) {
        echo PHP_EOL.$prefix.
        ' <span><a class="text-dark" href="/role/'.show($org->conf, 'roles_id', 0).'">'.show($org->info, 'name', $org->key).
        '</a> &nbsp <a class="text-success" href="/org/create/'.$org->id.'"> + </a><br>';

        $traverse($org->children, $prefix.'|--');
    }
};

?>
@extends('../nav')

@section('main')
<div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <div class="hero bg-gray">
        <p><i class="fa fa-code-fork" aria-hidden="true"></i> 组织结构</p>
    {!! $traverse($nodes) !!}
    </span>
    </div>
</div>

@endsection
