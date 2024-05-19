@extends('layouts.master')

@section('title') {{ __('Profile Settings') }} @endsection

@section('content')
    @component('components.page-title')
        @slot('li_1') {{ __('Management') }} @endslot
        @slot('title') {{ __('Company Details') }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Profile') }}</h4>
                </div>
                <div class="card-body">
                    {!! form($basic_info_form) !!}
                </div>
            </div>
        </div>

        @if($password_form)
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ __('Change Password') }}</h4>
                    </div>
                    <div class="card-body">
                        {!! form($password_form) !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
