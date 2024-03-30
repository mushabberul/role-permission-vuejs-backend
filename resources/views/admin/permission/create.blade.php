@extends('admin.layout.master')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Permission Create</h5>
            <a href="{{ route('permission.index') }}" class="btn btn-primary float-end">Permission List</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('permission.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Permission Name</label>
                    <input type="text" class="form-control" name="permission_name" placeholder="Ex: Profile Management">
                    @error('permission_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Module Name</label>
                    <select name="module_id" class="form-control">
                        @foreach ($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                        @endforeach
                    </select>
                </div>



                <button type="submit" class="btn btn-primary">Store</button>
            </form>
        </div>
    </div>
@endsection
