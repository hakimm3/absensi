@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Suggestion System
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb">Home</li>
            <li class="breadcrumb active">Suggestion System</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('boxHeader')
                <div class="row">
                    <div class="col-lg-2 col-md-12 col-sm-12">
                        <button class="btn btn-outline-primary my-2 btn-sm" onclick="create()">Create</button>
                    </div>
                    <div class="col-lg-10 col-md-12 col-sm-12">
                        <form action="">
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <select name="user_id" id="filter_user_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}" {{ request()->user_id == $item->id ? 'selected' : '' }}>{{ $item->employee_id }} - {{ $item->name }}</option>
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
                            <th>Name</th>
                            <th>Suggestion</th>
                            <th>Benefits</th>
                        @endslot
                    </x-admin.server-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>
    <x-admin.modal-component id="modal-form">
        @slot('modalTitle')
            Add Suggestion System
        @endslot
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="suggestion">Suggestion</label>
                    <textarea name="suggestion" id="suggestion" cols="30" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="benefits">Benefits</label>
                    <textarea name="benefits" id="benefits" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
            </form>
        @endslot
    </x-admin.modal-component>
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
    @include('admin.employee.suggestion-system.script')
@endpush