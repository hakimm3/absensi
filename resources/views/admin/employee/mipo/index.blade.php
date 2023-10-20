@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Employee Minus Poin
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Employee Minus Poin</a></li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('boxHeader')
                    <button class="btn btn-outline-primary my-2 mx-2 btn-sm" onclick="create()">Create</button>
                    <button class="btn btn-outline-warning my-2 btn-sm" onclick="showModalImport()">Import</button>
                @endslot
                @slot('boxBody')
                    <x-admin.server-side-datatable-component id="table">
                        @slot('columns')
                            <th>Date</th>
                            <th>Employee No</th>
                            <th>Employee Name</th>
                            <th>Jenis</th>
                            <th>Minus Poin</th>
                            <th>Description</th>
                        @endslot
                    </x-admin.server-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>
    <x-admin.modal-component id="modal-form">
        @slot('modalTitle')
            Add Employee Minus Poin
        @endslot
        @slot('modalBody')
        <form action="" id="form">
            <div class="form-group">
                <label for="">Employee</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="">-- Employee --</option>
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}">{{ $item->employee_id }} - {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Jenis</label>
                <select name="mipo_setting_id" id="mipo_setting_id" class="form-control">
                    <option value="">-- Jenis --</option>
                    @foreach ($settings as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="date" id="date-input" class="form-control" placeholder="Date">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <input type="hidden" name="id" id="id">
        </form>
        @endslot
    </x-admin.modal-component>
@endsection
@push('js')
    @include('admin.employee.mipo.script')
@endpush