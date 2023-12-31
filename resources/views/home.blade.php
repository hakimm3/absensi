@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Dashboard
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        @endslot
        @slot('content')
        <div class="row">
            <div class="col-12 mt-4">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <input type="text" id="date" name="date" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12 mb-2">
                        <x-admin.box-component>
                            @slot('boxHeader')
                                Report Attendance
                            @endslot
                            @slot('boxBody')
                                @include('admin.dashboard.attendance')
                            @endslot
                        </x-admin.box-component>
                    </div>
                    <div class="col-12">
                        <x-admin.box-component>
                            @slot('boxHeader')
                                Report Mipo
                            @endslot
                            @slot('boxBody')
                                @include('admin.dashboard.mipo')
                            @endslot
                        </x-admin.box-component>
                    </div>
                    <div class="col-12">
                        <x-admin.box-component>
                            @slot('boxHeader')
                                Report Suggestion System
                            @endslot
                            @slot('boxBody')
                                @include('admin.dashboard.suggestion_system')
                            @endslot
                        </x-admin.box-component>
                    </div>
                </div>
            </div>
        </div>
        @endslot
    </x-admin.layout-component>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset_template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $("#date").daterangepicker({
            singleDatePicker: false,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        // if request()->date is not null then set the value
        @if (request()->date)
            $('#date').daterangepicker({
                startDate: '{{ request()->date }}'.split(' - ')[0],
                endDate: '{{ request()->date }}'.split(' - ')[1]
            });
        @endif
    </script>
@endpush
