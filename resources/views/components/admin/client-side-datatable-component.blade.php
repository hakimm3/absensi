<table id="{{ $id }}" class="table table-bordered table-hover overflow-scroll">
    <thead class="bg-secondary">
        <tr>
            <th style="width: 5%">No</th>
            {{ $columns }}
            <th style="width: 10%" class="text-center" id="data-table-action">Action</th>
        </tr>
    </thead>
    <tbody>
        {{ $rowData }}
    </tbody>
</table>

@push('css')
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('asset_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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

    <script>
        $("#{{ $id }}").DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: false,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:last-child)'
                },
                title: '{{ $title }}'
            }]
        });
    </script>
@endpush
