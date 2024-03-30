@extends('admin.layout.master')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Module Create</h5>
            <a href="{{ route('module.index') }}" class="btn btn-primary float-end">Module List</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('module.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Module Name</label>
                    <input type="text" class="form-control" name="module_name" placeholder="Ex: Profile Management">
                    @error('module_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Store</button>
            </form>
        </div>
    </div>
@endsection
