@extends('layouts.master')
@section('title')
    Create Promo Code
@endsection
@section('content')
    @component('components.page-title',['route'=>route('users.index')])
        @slot('li_1') {{ __('Promo Code List') }} @endslot
        @slot('title') {{ __('Promo Code Detail') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
{{--                    <h4 class="card-title"> User Detail</h4>--}}
                    {!! form($basic_info_form) !!}

                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
@endsection
