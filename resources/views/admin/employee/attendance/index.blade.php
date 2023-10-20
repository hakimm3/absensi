@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Employee Attendance
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee Attendance</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('boxHeader')
                    <div class="row">
                        <div class="col-2">
                            <button class="btn btn-outline-primary my-2 mx-2 btn-sm" onclick="create()">Create</button>
                            <button class="btn btn-outline-warning my-2 btn-sm" onclick="showModalImport()">Import</button>
                        </div>
                        <div class="col-10">
                            <form action="">
                                <div class="row my-2">
                                    <div class="col-md-3 mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option value="">-- Status --</option>
                                            <option value="">All</option>
                                            <option value="present" {{ request()->status == 'present' ? 'selected' : '' }}>Present </option>
                                            <option value="late" {{ request()->status == 'late' ? 'selected' : '' }}>Late</option>
                                            <option value="absent" {{ request()->status == 'absent' ? 'selected' : '' }}>Absent</option>
                                            <option value="skd" {{ request()->status == 'skd' ? 'selected' : '' }}>SKD</option>
                                            <option value="cuti tahunan" {{ request()->status == 'cuti tahunan' ? 'selected' : '' }}>Cuti Tahunan</option>
                                            <option value="cuti istimewa" {{ request()->status == 'cuti istimewa' ? 'selected' : '' }}>Cuti Istimewa</option>
                                            <option value="rawat inap" {{ request()->status == 'rawat inap' ? 'selected' : '' }}>Rawat Inap</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <input type="text" id="date" name="date" class="form-control">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endslot
                @slot('boxBody')
                    <x-admin.client-side-datatable-component id="table" title="Employee Attendance">
                        @slot('columns')
                            <th>Date</th>
                            <th>Employee No</th>
                            <th>Employee Name</th>
                            <th>Absen In</th>
                            <th>Maximal Absen In</th>
                            <th>Absen Out</th>
                            <th>Status</th>
                            <th>Description</th>
                        @endslot
                        @slot('rowData')
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                    <td>{{ $item->user->employee_id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->time_in }}</td>
                                    <td>{{ $item->max_time_in }}</td>
                                    <td>{{ $item->time_out }}</td>
                                    <td>
                                        @if ($item->status == 'late')
                                            <span class="badge badge-warning">Late</span>
                                        @elseif ($item->status == 'present')
                                            <span class="badge badge-success">Present</span>
                                        @elseif ($item->status == 'absent')
                                            <span class="badge badge-danger">Absent</span>
                                        @else
                                            <span class="badge badge-info"> {{ $item->status }} </span>
                                        @endif
                                    </td>
                                    <td>{{ $item->description }}</td>
                                    <td> @include('admin.employee.attendance.action') </td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-admin.client-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>
    <x-admin.modal-component id="modal-form">
        @slot('modalTitle')
            Add Employee Attendance
        @endslot
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control">
                        <option value="">-- Employee --</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->employee_id }}">{{ $item->employee_id }} - {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="date" id="date-input" class="form-control" placeholder="Date">
                </div>
                <div class="form-group">
                    <label for="">Absen In</label>
                    <input type="time" name="time_in" id="time_in" class="form-control" placeholder="Time In">
                </div>
                <div class="form-group">
                    <label for="">Maximal Absen In</label>
                    <input type="time" name="max_time_in" id="max_time" class="form-control" placeholder="Max Time In">
                </div>
                <div class="form-group">
                    <label for="">Absen Out</label>
                    <input type="time" name="time_out" id="time_out" class="form-control" placeholder="Absen Out">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="status_attendance">
                        <option value="">-- Status --</option>
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                        <option value="late">Late</option>
                        <option value="skd">SKD</option>
                        <option value="sakit kecelakaan kerja">Sakit Kecelakaan Kerja</option>
                        <option value="cuti tahunan">Cuti Tahunan</option>
                        <option value="cuti istimewa">Cuti Istimewa</option>
                        <option value="rawat inap">Rawat Inap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-component>

    @include('admin.employee.attendance.import')
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
    @include('utils.create')
    @include('utils.store')
    @include('utils.destroy')
    @include('admin.employee.attendance.scripts')
@endpush
