@extends('layouts.master')
@section('title')
    @lang('translation.Create_User')
@endsection
@section('content')
    @component('components.page-title',['route'=>route('users.index')])
        @slot('li_1') {{ __('User List') }} @endslot
        @slot('title') {{ __('User Detail') }} @endslot
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
