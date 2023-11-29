@include('utils.create')
@include('utils.store')
@include('utils.destroy')
<script src="{{ asset('asset_template/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('asset_template/plugins/daterangepicker/daterangepicker.js') }}"></script>


<script>
    function create(){
        setCreate('#modal-form', '#form')
    }

    function store(){
        // enable all input before store data to database
        // $('#form-evaluasi').find('input, select, textarea').prop('disabled', false)
        let url = "{{ route('employee.suggestion-system.store') }}"
        let method = "POST"
        let formData = new FormData($('#form')[0])
        console.log(formData)
        let isServerSide = true
        procesStore(url, method, formData, "#modal-form", "#btn-save", "#table", isServerSide)
    }

    function edit(id){
        $('.modal-title').text('Edit Suggestion System')
        $('#modal-form ').modal('show')
        $('#form').trigger('reset')

        $.ajax({
            url: "{{ route('employee.suggestion-system.edit', ':id') }}".replace(':id', id),
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#id').val(data.data.id)
                $('#tanggal_pengajuan').val(data.data.tanggal_pengajuan)
                $('#tema').val(data.data.tema)
                $('#kategori').val(data.data.kategori)
                $('#text_masalah').val(data.data.text_masalah)
                if(data.data.file_masalah){
                    $('#link_masalah').removeClass('d-none')
                    $('#link_masalah').attr('href', "{{ asset('storage/suggestion-system') }}"+"/"+data.data.file_masalah)
                }
                $('#analisa').val(data.data.analisa)
                $('#perbaikan').val(data.data.perbaikan)
                $('#text_evaluasi').val(data.data.text_evaluasi)
            },
            error: function(){
                Swal.fire({
                    title: 'Error!',
                    text: 'Data not found!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                })
            }
        })
    }

    function evaluasi(id){
        $('.modal-title').text('Evaluasi Suggestion System')
        $('#modal-evaluasi ').modal('show')
        $('#form').trigger('reset')

        $.ajax({
            url: "{{ route('employee.suggestion-system.edit', ':id') }}".replace(':id', id),
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#evaluasi_id').val(data.data.id)
                $('#evaluasi_pengaju').val(data.data.pengaju.name)
                $('#evaluasi_tanggal_pengajuan').val(data.data.tanggal_pengajuan)
                $('#evaluasi_tema').val(data.data.tema)
                $('#evaluasi_kategori').val(data.data.kategori)
                $('#evaluasi_text_masalah').val(data.data.text_masalah)
                if(data.data.file_masalah){
                    $('#evaluasi_link_masalah').removeClass('d-none')
                    $('#evaluasi_link_masalah').attr('href', "{{ asset('storage/suggestion-system') }}"+"/"+data.data.file_masalah)
                }
                $('#evaluasi_analisa').val(data.data.analisa)
                $('#evaluasi_perbaikan').val(data.data.perbaikan)
                $('#evaluasi_text_evaluasi').val(data.data.text_evaluasi)
            },
            error: function(){
                Swal.fire({
                    title: 'Error!',
                    text: 'Data not found!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                })
            }
        })
    }
</script>
<script>
    $("#table").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'pengaju.name', name: 'pengaju.name'},
            { data: 'tanggal_pengajuan', name: 'tanggal_pengajuan'},
            { data: 'tema', name: 'tema'},
            { data: 'kategori', name: 'kategori'},
            { data: 'text_masalah', name: 'text_masalah'},
            { data: 'analisa', name: 'analisa'},
            { data: 'perbaikan', name: 'perbaikan'},
            { data: 'text_evaluasi', name: 'text_evaluasi', defaultContent: '-'},
            { data: 'evaluator.name', name: 'evaluator.name', defaultContent: '-'},
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    })
</script>

<script>
    let datepicker = $("#date").daterangepicker({
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
</script>
