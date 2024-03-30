@extends('admin.layout.master')
@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
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
                    <input type="file" class="dropify" name="image"
                        data-default-file="{{ asset('admin/img/profile/' . $user->image) }}" />
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>



                <button type="submit" class="btn btn-primary">Store</button>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('.dropify').dropify();
    </script>
@endpush
