<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Attendance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="file" name="file" id="file" class="form-control" placeholder="File">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-submit-import" onclick="submitImport()">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function showModalImport() {
            $('#importModal').modal('show');
            $("#form").trigger("reset");
        }

        function submitImport() {
            $("#btn-submit-import").attr("disabled", true).text("Loading...")
            // sweet alert loading
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            })

            
            var formData = new FormData()
            formData.append('file', $('#file').prop('files')[0] ?? '')

                $.ajax({
                url: "{{ route('employee.attendance.import') }}",
                type: "POST",
                dataType: "JSON",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#importModal').modal('hide')
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

                    if(error_message == '<ul></ul>') {
                        error_message = data.responseJSON.message
                    }

                    Swal.fire({
                        title: 'Error!',
                        html: error_message,
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            })
            $("#btn-submit-import").attr("disabled", false).text("Save")
        }
    </script>
@endpush