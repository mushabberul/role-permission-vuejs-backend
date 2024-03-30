@extends('admin.layout.master')
@section('content')
    <div class="card">
        <div class="module-header d-flex justify-content-between align-items-center custom-design">
            <h5 class="card-header">Module List</h5>

            <a href="{{ route('module.create') }}" class="btn btn-primary mr-4">Create</a>

        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Module Name</th>
                        <th>Module Slug</th>
                        <th>Update Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($modules as $module)
                        <tr>
                            <td><span class="fw-medium">{{ $module->module_name }}</span></td>
                            <td>{{ $module->module_slug }}</td>
                            <td>{{ $module->updated_at->format('d-M-Y') }}</td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="{{ route('module.edit', $module) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('module.destroy', $module) }}" method="post">
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
