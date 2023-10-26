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
                    <button class="btn btn-outline-primary my-2 mx-2 btn-sm" onclick="create()">Create</button>
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
@push('js')
    @include('admin.employee.suggestion-system.script')
@endpush