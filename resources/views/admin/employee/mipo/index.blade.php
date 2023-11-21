@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Employee Minus Poin
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active"><a href="#">Employee Minus Poin</a></li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('boxHeader')
                    <div class="row">
                        <div class="col-lg-2 col-md-12 col-sm-12">
                            <button class="btn btn-outline-primary my-2 btn-sm" onclick="create()">Create</button>
                            <button class="btn btn-outline-warning my-2 mx-2 btn-sm" onclick="showModalImport()">Import</button>
                            <button class="btn btn-outline-success my-2 btn-sm"><a href="{{ route('employee.attendance.export', request()->query()) }}" class="text-decoration-none text-dark">Export</a></button>
                        </div>
                        <div class="col-lg-10 col-md-12 col-sm-12">
                            <form action="">
                                <div class="row my-2">
                                    <div class="col-md-3">
                                        <select name="user_id" id="filter_user_id" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request()->user_id == $item->id ? 'selected' : '' }}>{{ $item->employee_id }}
                                                    - {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="date" name="date" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
    @include('admin.employee.mipo.import')
@endsection
@push('css')
    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('asset_template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    {{-- daterange --}}
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/daterangepicker/daterangepicker.css') }}">
@endpush
@push('js')
    @include('admin.employee.mipo.script')
@endpush
