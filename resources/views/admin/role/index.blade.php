@extends('admin.layout.master')
@section('content')
    <div class="card">
        <div class="module-header d-flex justify-content-between align-items-center custom-design">
            <h5 class="card-header">Role List</h5>
            <a href="{{ route('role.create') }}" class="btn btn-primary mr-4">Create</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Role Slug</th>
                        <th>Permission</th>
                        <th>Update Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($roles as $role)
                        <tr>
                            <td><span class="fw-medium">{{ $role->role_name }}</span></td>
                            <td>{{ $role->role_slug }}</td>
                            <td>{{ $role->updated_at->format('d-M-Y') }}</td>
                            <td>
                                @foreach ($role->permissions->chunk(5) as $items)
                                    <div class="row">
                                        <div class="col mb-1">
                                            @foreach ($items as $permission)
                                                <span
                                                    class="bg-success rounded text-white p-1">{{ $permission->permission_name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="{{ route('role.edit', $role) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('role.destroy', $role) }}" method="post">
                                            @csrf
                                            <i class="bx bx-trash"></i>
                                            <button type="submit" class="delete-btn deleteConfirm">Delete</button>
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
