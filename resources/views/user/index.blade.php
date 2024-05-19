@extends('layouts.master')
@section('title')
    @lang('translation.Users')
@endsection

@section('css')
    <link href="{{ URL::asset('/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('extra-buttons')
    <a type="button" href="{{route('users.create')}}" class="btn btn-primary float-end">
        <i class="fa fa-plus"></i> | {{ __('Add User') }}
    </a>
@endsection

@section('content')
    @component('components.page-title')
        @slot('li_1') {{ __('Management') }} @endslot
        @slot('title') {{ __('Users List') }} @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th data-priority="1">Email</th>
                                <th data-priority="3">Type</th>
                                <th data-priority="1">Created At</th>
                                <th data-priority="1">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @foreach($users as $user)
                                <tr id="user-{{$user->id}}">
                                    <th>{{$user->name}}</th>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->user_type}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="{{route('users.edit',$user)}}" class="px-2 text-primary"><i
                                                        class="uil uil-pen font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">

                                                <a href="javascript:void(0);" data-id="{{$user->id}}"  class="px-2 text-danger delete-user"><i
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
                                <p class="mb-sm-0">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                {{ $users->links() }}

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
                            url: `/users/${userId}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.status === 200) {
                                    // Remove the row from the table
                                    row.remove();
                                    Swal.fire("Deleted!", "The user has been deleted.", "success");
                                } else {
                                    Swal.fire("Failed!", "Failed to delete the user.", "error");
                                }
                            },
                            error: function(xhr) {
                                console.error('There was an error deleting the user!', xhr);
                                Swal.fire("Error!", "There was an error deleting the user.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>


@endsection
