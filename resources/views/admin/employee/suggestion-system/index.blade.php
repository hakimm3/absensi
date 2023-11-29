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
                            <th>Diajukan Oleh</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tema</th>
                            <th>Kategori</th>
                            <th>Masalah</th>
                            <th>Analisa</th>
                            <th>Perbaikan</th>
                            <th>Evaluasi</th>
                            <th>Evalusai Oleh</th>
                        @endslot
                    </x-admin.server-side-datatable-component>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>
    <x-admin.modal-component id="modal-form" size="modal-xl">
        @slot('modalTitle')
            Add Suggestion System
        @endslot
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="date" class="required">Date</label>
                    <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tema">Tema</label>
                    <input type="text" name="tema" id="tema" class="form-control">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="standard">Standard</option>
                        <option value="modifikasi">Modifikasi</option>
                        <option value="inovasi">Inovasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="text_masalah">Masalah</label>
                    <textarea name="text_masalah" id="text_masalah" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="file_masalah">Attachment Masalah</label>
                    <input type="file" name="file_masalah" id="file_masalah" class="form-control">
                    <a href="#" id="link_masalah" class="d-none"> <i class="fa fa-download"></i> Download</a>
                </div>
                <div class="form-group">
                    <label for="analisa">Analisa</label>
                    <textarea name="analisa" id="analisa" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="perbaikan">Perbaikan</label>
                    <textarea name="perbaikan" id="perbaikan" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="pengaju_id" name="pengaju_id" value="{{ auth()->user()->id }}">
            </form>
        @endslot
    </x-admin.modal-component>

    {{-- evaluasi --}}
    <x-admin.modal-component id="modal-evaluasi" size="modal-xl">
        @slot('modalTitle')
            Add Suggestion System
        @endslot
        @slot('modalBody')
            <form action="" id="form-evaluasi">
                <div class="form-group">
                    <label>Diajukan Oleh</label>
                    <input type="text" name="pengaju" id="evaluasi_pengaju" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="date" class="required">Date</label>
                    <input type="date" name="tanggal_pengajuan" id="evaluasi_tanggal_pengajuan" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="tema">Tema</label>
                    <input type="text" name="tema" id="evaluasi_tema" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="evaluasi_kategori" class="form-control" disabled>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="standard">Standard</option>
                        <option value="modifikasi">Modifikasi</option>
                        <option value="inovasi">Inovasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="text_masalah">Masalah</label>
                    <textarea name="text_masalah" id="evaluasi_text_masalah" class="form-control" disabled cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="file_masalah">Attachment Masalah</label>
                    <a href="#" id="evaluasi_link_masalah" class="d-none"> <i class="fa fa-download"></i> Download</a>
                </div>
                <div class="form-group">
                    <label for="analisa">Analisa</label>
                    <textarea name="analisa" id="evaluasi_analisa" class="form-control" disabled cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="perbaikan">Perbaikan</label>
                    <textarea name="perbaikan" id="evaluasi_perbaikan" class="form-control" disabled cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="text_evaluasi">Evaluasi</label>
                    <textarea name="text_evaluasi" id="evaluasi_text_evaluasi" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="file_evaluasi">Attachment Evaluasi</label>
                    <input type="file" name="file_evaluasi" id="file_evaluasi" class="form-control">
                    <a href="#" id="link_evaluasi" class="d-none"> <i class="fa fa-download"></i> Download</a>
                </div>
                <input type="hidden" id="evaluasi_id" name="id">
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