@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Department
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Department</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('boxHeader')
                    <button class="btn btn-outline-primary my-2 btn-sm" onclick="create()">Create</button>
                @endslot
                @slot('boxBody')
                    <x-admin.server-side-datatable-component id="table">
                        @slot('columns')
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                        @endslot
                    </x-admin.server-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-component id="modal-form">
        @slot('modalTitle')
            Create Department
        @endslot
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Code</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Code">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        placeholder="Description"></textarea>
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-component>
@endsection

@push('js')
    @include('admin.user-management.department.script')
@endpush
