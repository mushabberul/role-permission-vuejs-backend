@extends('admin.layout.master')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Permission Create</h5>
            <a href="{{ route('permission.index') }}" class="btn btn-primary float-end">Permission List</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('permission.update', $permission) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Permission Name</label>
                    <input type="text" class="form-control" value="{{ $permission->permission_name }}"
                        name="permission_name" placeholder="Ex: Profile Management">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Module Name</label>

                    <select name="module_id" class="form-control">
                        @foreach ($modules as $module)
                            <option value="{{ $module->id }}"
                                {{ $module->id == $permission->module_id ? 'selected' : '' }}>
                                {{ $module->module_name }}</option>
                        @endforeach
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
