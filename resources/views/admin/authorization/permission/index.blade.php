@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Permission
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Permission</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('boxHeader')
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <button class="btn btn-outline-primary my-2 btn-sm" onclick="create()">Create</button>
                @endslot
                @slot('boxBody')
                    <x-admin.server-side-datatable-component id="table">
                        @slot('columns')
                            <th>Name</th>
                        @endslot
                    </x-admin.server-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-component id="modal-form">
        @slot('modalTitle')
            Add Permission
        @endslot
        @slot('modalBody')
            <form action="" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <input type="hidden" name="id" id="id">
            @endslot
    </x-admin.modal-component>
@endsection

@push('js')
    @include('admin.authorization.permission.script')
@endpush