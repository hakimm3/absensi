@include('utils.create')
@include('utils.store')
@include('utils.destroy')

<script>
    function create(){
        setCreate('#modal-form', '#form')
    }

    function store(){
        let url = "{{ route('employee.suggestion-system.store') }}"
        let method = "POST"
        let formData = new FormData($('#form')[0])
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
                $('#date').val(data.data.date)
                $('#suggestion').val(data.data.suggestion)
                $('#benefits').val(data.data.benefits)
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
            { data: 'date', name: 'date' },
            { data: 'user.name', name: 'user.name'},
            { data: 'suggestion', name: 'suggestion' },
            { data: 'benefits', name: 'benefits' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    })
</script>