@extends('admin.layout.master')
@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Role Create</h5>
            <a href="{{ route('role.index') }}" class="btn btn-primary float-end">Role List</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('role.update', $role) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Role Name</label>
                    <input type="text" class="form-control" value="{{ $role->role_name }}" name="role_name"
                        placeholder="Ex: Profile Management">
                </div>
                <div class="mb-3">
                    <h5>Permission Management</h5>
                    <input type="checkbox" id="all-permission">
                    <label for="all-permission">All Permission</label>
                    <div class="row">
                        @foreach ($modules->chunk(2) as $items)
                            <div class="col-md-6">
                                @foreach ($items as $module)
                                    <h6 class="pt-3 mb-2">{{ $module->module_name }}</h6>
                                    @foreach ($module->permissions as $permission)
                                        <div class="mb-1">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                @foreach ($role->permissions as $rPermission)
                                                {{ $rPermission->id == $permission->id ? 'checked' : '' }} @endforeach>
                                            <label>{{ $permission->permission_name }}</label>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#all-permission').on('click', function() {
            if (this.checked == true) {
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
