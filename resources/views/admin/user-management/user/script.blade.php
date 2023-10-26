@include('utils.create')
@include('utils.store')
@include('utils.destroy')

{{-- select2 --}}
<script src="{{ asset('asset_template/plugins/select2/js/select2.min.js') }}"></script>

<script>
    function create() {
        setCreate('#modal-form', '#form')
    }

    function store(){
        let url = "{{ route('user-management.users.store') }}"
        let method = "POST"
        let formData = new FormData($('#form')[0])
        let isServerSide = true
        procesStore(url, method, formData, "#modal-form", "#btn-save", "#table", isServerSide)
    }

    function edit(id){
        $('.modal-title').text('Edit User')
        $('#modal-form ').modal('show')
        $('#form').trigger('reset')

        $.ajax({
            url: "{{ route('user-management.users.edit', ':id') }}".replace(':id', id),
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#id').val(data.data.id)
                $('#employee_id').val(data.data.employee_id)
                $('#name').val(data.data.name)
                $('#username').val(data.data.username)
                $('#email').val(data.data.email)
                $('#department').val(data.data.department_id).trigger('change')
                $('#role').val(data.data.roles).trigger('change')
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
                data: 'employee_id',
                name: 'employee_id',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'roles',
                name: 'roles'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,

            }
        ]
    })


    // select 2
    $('#role').select2({
        theme: 'bootstrap4',
        placeholder: 'Select Role',
        allowClear: true
    })

    $('#department').select2({
        theme: 'bootstrap4',
        placeholder: 'Select Department',
        allowClear: true
    })
</script>
