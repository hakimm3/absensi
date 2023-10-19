
@include('utils.create')
@include('utils.store')
@include('utils.destroy')

<script>
    function create(){
        setCreate('#modal-form', '#form')
    }

    function store(){
        let url = "{{ route('authorization.permission.store') }}"
        let method = "POST"
        let formData = new FormData($('#form')[0])
        let isServerSide = true
        procesStore(url, method, formData, "#modal-form", "#btn-save", "#table", isServerSide)
    }

    function edit(id){
        $('.modal-title').text('Edit Permission')
        $('#modal-form ').modal('show')
        $('#form').trigger('reset')

        $.ajax({
            url: "{{ route('authorization.permission.edit', ':id') }}".replace(':id', id),
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#id').val(data.data.id)
                $('#name').val(data.data.name)
            },
            error: function() {
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
    let table = $('#table').DataTable({
        responsive: true,
        autoWidth: false,
        serverSide: true,
        ajax: '',
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    })
</script>