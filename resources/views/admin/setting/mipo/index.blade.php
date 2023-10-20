@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Mipo
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Setting</a></li>
            <li class="breadcrumb-item active"><a href="#">Mipo</a></li>
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
                            <th>Value</th>
                        @endslot
                    </x-admin.server-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-component id="modal-form">
        @slot('modalTitle')
            Add Mipo
        @endslot
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="value">Value</label>
                    <input type="number" name="value" id="value" class="form-control" placeholder="Value">
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-component>
@endsection
@push('js')
    @include('admin.setting.mipo.script')
@endpush
