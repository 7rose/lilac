@extends('../nav')

@section('main')
<div class="container col-4 col-md-6 col-sm-10 col-xs-12 p-centered">
    <div class="nav-pad"></div>
    <input type="radio" id="tab1" name="tabs" class="tab-locator" hidden checked />
    <input type="radio" id="tab2" name="tabs" class="tab-locator" hidden />
    <input type="radio" id="tab3" name="tabs" class="tab-locator" hidden />

    <div class="panel">
        <div class="panel-header text-center">
        <div class="panel-title h5 mt-10">Bruce Banner</div>
        <div class="panel-subtitle">THE HULK</div>
        </div>
        <nav class="panel-nav">
            <ul class="tab tab-block" data-tabs="main_tab">
                @can('customer-qrcode')
                <li class="tab-item active"><a href="#">客户</a></li>
                @endcan
                @can('supplier-qrcode')
                <li class="tab-item"><a href="#">商户</a></li>
                @endcan
                @can('partner-qrcode')
                <li class="tab-item"><a href="#">合作</a></li>
                @endcan
            </ul>
        </nav>
        <div class="panel-body">
            <ul data-tabs-content="main_tab">

                @can('customer-qrcode')
                <li>Lorem ipsum dolor sit amet.</li>
                @endcan
                @can('supplier-qrcode')
                <li>Lorem ipsum dolor 2</li>
                @endcan
                @can('partner-qrcode')
                <li>Lorem ipsum 3</li>
                @endcan
            </ul>
        </div>
        <div class="panel-footer">
        <button class="btn btn-primary btn-block">刷新</button>
        </div>
    </div>
</div>
{{ print_r($urls) }}
@endsection
