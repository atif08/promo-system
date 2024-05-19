<!-- start page title -->
<div class="row">
    <div class="col-md-6 col-xs-12 col-sm-12">

        <div class="page-title-box">
            <h4 class="mb-0">{{ $title }}</h4>

            <div class="page-title-left">
                <ol class="breadcrumb m-0 mt-1">
                    @isset($li_1)
                        <li class="breadcrumb-item"><a href="{{isset($route) ? $route : 'javascript: void(0);'}}">{{ $li_1 }}</a></li>
                    @endisset
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>

        </div>
    </div>

    <div class="col-md-6 col-xs-12 col-sm-12">
        @yield('extra-buttons')
    </div>

</div>
<!-- end page title -->
