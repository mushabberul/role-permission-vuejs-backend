@extends('admin.layout.master')
@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endpush
@section('content')
    <div class="card">
        <div class="module-header d-flex justify-content-between align-items-center custom-design">
            <h5 class="card-header">User List</h5>

            <a href="{{ route('user.create') }}" class="btn btn-primary mr-4">Create</a>

        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Role</th>
                        <th>Update Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                        <tr>
                            <td><span class="fw-medium">{{ $user->name }}</span></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->role_name }}</td>
                            <td>{{ $user->updated_at->format('d-M-Y') }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input userStatus" type="checkbox" role="switch"
                                        data-id="{{ $user->id }}" {{ $user->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                </div>
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="{{ route('user.edit', $user) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('user.destroy', $user) }}" method="post">
                                            @csrf
                                            <i class="bx bx-trash"></i>
                                            <button type="submit" class="delete-btn confirmDelete">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $('.userStatus').change(function() {
            let user_id = $(this).data('id');
            $.ajax({
                url: "{{ route('user.status') }}",
                type: "POST",
                dataType: 'JSON',
                data: {
                    _token: _token,
                    user_id: user_id
                },
                success: function(success) {
                    toastr.success(success.message);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush
