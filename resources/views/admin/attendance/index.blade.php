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
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-outline-primary my-2 btn-sm" onclick="create()">Create</button>
                    <button class="btn btn-outline-warning my-2 btn-sm" onclick="showModalImport()">Import</button>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Status --</option>
                                    <option value="">All</option>
                                    <option value="present" {{ (request()->status == 'present') ? 'selected' : '' }}>Present</option>
                                    <option value="late" {{ (request()->status == 'late') ? 'selected' : '' }}>Late</option>
                                    <option value="absent" {{ (request()->status == 'absent') ? 'selected' : '' }}>Absent</option>
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

                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee No</th>
                                <th>Employee Name</th>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Max Time In</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->employee_id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                    <td>{{ $item->time_in }}</td>
                                    <td>{{ $item->max_time_in }}</td>
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
                                    <td> @include('admin.attendance.action') </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endslot
    </x-admin.layout-component>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="form" enctype="multipart/form-data">
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
                            <label for="">Time In</label>
                            <input type="time" name="time_in" id="time_in" class="form-control" placeholder="Time In">
                        </div>
                        <div class="form-group">
                            <label for="">Max Time In</label>
                            <input type="time" name="max_time" id="max_time" class="form-control" placeholder="Max Time In">
                        </div>
                       <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="status_attendance">
                            <option value="">-- Status --</option>
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="late">Late</option>
                            <option value="halfday">Halfday</option>
                        </select>
                       </div>
                        <input type="hidden" name="id" id="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="store()">Save</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.attendance.import')
@endsection


@push('css')
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('asset_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    {{-- daterange --}}
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset_template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    {{-- export datatable to excel --}}
    <script src="{{ asset('asset_template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('asset_template/plugins/select2/js/select2.min.js') }}"></script>

    {{-- daterange --}}
    <script src="{{ asset('asset_template/plugins/moment/moment.min.js') }}"></script>
    <script  src="{{ asset('asset_template/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        let table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: false,
            // export to excel except last column and file name is attendance
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    },
                    title: 'Attendance'
                }
            ]
        });

       let datepicker =  $("#date").daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            allowClear: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        @if (request()->date)
            let initialDate = "{{ request()->date }}".split(' - ')
            let date = initialDate[0] + ' - ' + initialDate[1]  
            datepicker.data('daterangepicker').setStartDate(initialDate[0])
            datepicker.data('daterangepicker').setEndDate(initialDate[1])
        @endif


        $("#employee_id").select2({
            theme: 'bootstrap4',
            placeholder: '-- Employee --',
            allowClear: true,
        });
        

        function destroy(id) {
            Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('attendance.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        $.ajax({
                            url: url,
                            type: "DELETE",
                            data: {
                                "id": id
                            },
                            dataType: "JSON",
                            success: function(data) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: "Data Succesfully Deleted",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        location.reload()
                                    }
                                })
                                
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error deleting data');
                            }
                        });
                    }
                });
        }
    </script>
@endpush


@include('admin.attendance.create')