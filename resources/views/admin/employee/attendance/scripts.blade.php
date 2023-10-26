    {{-- select2 --}}
    <script src="{{ asset('asset_template/plugins/select2/js/select2.min.js') }}"></script>
    {{-- daterange --}}
    <script src="{{ asset('asset_template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('asset_template/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script>
        function create() {
            setCreate('#modal-form', '#form')
        }

        function store() {
            let url = "{{ route('employee.attendance.store') }}"
            let method = "POST"
            let formData = new FormData($('#form')[0])
            let isServerSide = true
            procesStore(url, method, formData, "#modal-form", "#btn-save", "#table", isServerSide)
        }

        function edit(id) {
            $('.modal-title').text('Edit Attendance')
            $('#modal-form ').modal('show')
            $('#form').trigger('reset')

            $.ajax({
                url: "{{ route('employee.attendance.edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.data.id)
                    $('#employee_id').val(data.data.user.employee_id).trigger('change')
                    $('#date-input').val(data.data.date)
                    $('#time_in').val(data.data.time_in)
                    $('#max_time').val(data.data.max_time_in)
                    $('#time_out').val(data.data.time_out)
                    $('#status_attendance').val(data.data.status).trigger('change')
                    $('#description').val(data.data.description)
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
        $("#table").DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'date', name: 'date'},
                {data: 'user.employee_id', name: 'employee_id'},
                {data: 'user.name', name: 'name'},
                {data: 'time_in', name: 'time_in'},
                {data: 'max_time_in', name: 'max_time_in'},
                {data: 'time_out', name: 'time_out'},
                {data: 'status', name: 'status'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
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


        $("#employee_id").select2({
            theme: 'bootstrap4',
            placeholder: '-- Employee --',
            allowClear: true,
        });
    </script>
