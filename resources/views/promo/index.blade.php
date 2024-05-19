@extends('layouts.master')
@section('title')
    Promo Codes
@endsection

@section('css')
    <link href="{{ URL::asset('/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('extra-buttons')
    <a type="button" href="{{route('promo-codes.create')}}" class="btn btn-primary float-end">
        <i class="fa fa-plus"></i> | {{ __('Add Promo Code') }}
    </a>
@endsection

@section('content')
    @component('components.page-title')
        @slot('li_1') {{ __('Management') }} @endslot
        @slot('title') {{ __('Promo Code List') }} @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th data-priority="1">Code</th>
                                <th data-priority="3">Gender</th>
                                <th data-priority="1">Type</th>
                                <th data-priority="1">Start Date</th>
                                <th data-priority="1">End Date</th>
                                <th data-priority="1">Amount</th>
                                <th data-priority="1">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @foreach($promo_codes as $promo_code)
                                <tr id="user-{{$promo_code->id}}">
                                    <th>{{$promo_code->promo_code}}</th>
                                    <td>{{$promo_code->gender}}</td>
                                    <td>{{$promo_code->type}}</td>
                                    <td>{{$promo_code->amount}}</td>
                                    <td>{{$promo_code->start_date}}</td>
                                    <td>{{$promo_code->end_date}}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{route('promo-codes.edit',$promo_code)}}" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">

                                                <a href="javascript:void(0);" data-id="{{$promo_code->id}}"  class="px-2 text-danger delete-user"><i
                                                        class="uil uil-trash-alt font-size-18"></i></a>
                                            </li>

                                        </ul>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0">Showing {{ $promo_codes->firstItem() }} to {{ $promo_codes->lastItem() }} of {{ $promo_codes->total() }} entries
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                {{ $promo_codes->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-user').on('click', function(event) {
                event.preventDefault();

                const userId = $(this).data('id');
                const row = $(`#user-${userId}`);

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/promo-codes/${userId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.status === 200) {
                                    // Remove the row from the table
                                    row.remove();
                                    Swal.fire("Deleted!", "The promo code has been deleted.", "success");
                                } else {
                                    Swal.fire("Failed!", "Failed to delete the promo code.", "error");
                                }
                            },
                            error: function(xhr) {
                                console.error('There was an error deleting the promo code!', xhr);
                                Swal.fire("Error!", "There was an error deleting the promo code.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>


@endsection
