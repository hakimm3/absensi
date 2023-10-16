@push('js')
    <script>
        function create() {
            $('.modal-title').text('Input Attendance')
            $('#exampleModal').modal('show')
            $('#form').trigger('reset')
        }


        function edit(id){
            $('.modal-title').text('Edit Attendance')
            $('#exampleModal').modal('show')
            $('#form').trigger('reset')

            $.ajax({
                url: "{{ route('attendance.edit', ":id") }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#id').val(data.data.id)
                    $('#name').val(data.data.user.name)
                    $('#employee_id').val(data.data.user.employee_id)
                    $('#date-input').val(data.data.date)
                    $('#time_in').val(data.data.time_in)
                    $('#max_time').val(data.data.max_time_in)
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

        function store(){
            var formData = new FormData()
            formData.append('id', $('#id').val())
            formData.append('name', $('#name').val())
            formData.append('employee_id', $('#employee_id').val())
            formData.append('date', $('#date-input').val())
            formData.append('time_in', $('#time_in').val())
            formData.append('max_time', $('#max_time').val())


            $.ajax({
                url: "{{ route('attendance.store') }}",
                type: "POST",
                dataType: "JSON",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#exampleModal').modal('hide')
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been saved!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload()
                        }
                    })
                },
                error: function(data) {
                    let error_message = '<ul>'
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += '<li>' + value + '</li>'
                    })
                    error_message += '</ul>'
                    Swal.fire({
                        title: 'Error!',
                        html: error_message,
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            })
        }
    </script>
@endpush