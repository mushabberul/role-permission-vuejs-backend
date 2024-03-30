@extends('admin.layout.master')
@push('style')
@endpush
@section('content')
    <div class="card p-4">
        <div class="module-header d-flex justify-content-between align-items-center custom-design">
            <h5 class="card-header">Permission List</h5>
            <a href="{{ route('permission.create') }}" class="btn btn-primary mr-4">Create</a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table dataTablePermission" id="myTable">
                <thead>
                    <tr>
                        <th>Permission Name</th>
                        <th>Permission Slug</th>
                        <th>Module</th>
                        <th>Update Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($permissions as $permission)
                        <tr>
                            <td><span class="fw-medium">{{ $permission->permission_name }}</span></td>
                            <td>{{ $permission->permission_slug }}</td>
                            <td>{{ $permission->module->module_name }}</td>
                            <td>{{ $permission->updated_at->format('d-M-Y') }}</td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="{{ route('permission.edit', $permission) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('permission.destroy', $permission) }}" method="post">
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
@push('script')
    <script>
        let table = new DataTable('.dataTablePermission');
    </script>
@endpush
