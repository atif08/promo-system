<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.title-meta')
    @include('layouts.head')
    <script>
        window.defaultSettings = {
            {{--currency: "{{ $currency ?? 'USD' }}",--}}
            {{--currencyIcon: "{{ $currency_icon ?? '$' }}",--}}
            {{--currentAccountId: "{{ $current_account?->id}}",--}}
            dateFormat: 'MM-DD-YYYY',
            baseUrl: "{{ url('/') }}",
            urlSegments: "{{ implode('/', request()->segments()) }}"
        };
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

@section('body')

    <body>
    @show

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Flash Message Alert -->
                    @if (session()->has('message'))
                        <x-alert :type="session('type')" :message="session('message')" />
                    @endif
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')

    @include('scripts.custom')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')

    </body>

</html>
