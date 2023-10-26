@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            User
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('boxHeader')
                    <button class="btn btn-outline-primary my-2 btn-sm" onclick="create()">Create</button>
                @endslot
                @slot('boxBody')
                    <x-admin.server-side-datatable-component id="table">
                        @slot('columns')
                            <th>Employee No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Roles</th>
                        @endslot
                    </x-admin.server-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-component id="modal-form">
        @slot('modalTitle')
            Create User
        @endslot
        @slot('modalBody')
            <form action="" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Employee No</label>
                    <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Department</label>
                    <select name="department_id" id="department" class="form-control">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="roles[]" id="role" class="form-control" multiple>
                        <option value="">--Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-component>
@endsection

@push('css')
    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('js')
    @include('admin.user-management.user.script')
@endpush
