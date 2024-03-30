@extends('admin.layout.master')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">User Update</h5>
            <a href="{{ route('user.index') }}" class="btn btn-primary float-end">User List</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">User Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                        placeholder="Ex: Sabbir Mia">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">User Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}"
                        placeholder="Ex: sabbir@gmail.com">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">User Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Ex: Password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <select name="role_id" class="form-control">
                        <option value="">Select a Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $role->role_name == $user->role->role_name ? 'selected' : '' }}>{{ $role->role_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Store</button>
            </form>
        </div>
    </div>
@endsection
