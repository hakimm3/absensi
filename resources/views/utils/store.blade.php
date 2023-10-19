<script>
    function procesStore(url, method, formData, modalId = "#modal-form", btnId = "#btn-save", tableid = "#table", isServerSide = true) {
        $(btnId).html('<i class="fa fa-spinner fa-spin"></i> Loading...').attr("disabled", true)
        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $(modalId).modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        isServerSide ? $(tableid).DataTable().ajax.reload() : location.reload();
                    }
                })
               
            },
            error: function(data) {
                let error_message = '<ul>'
                $.each(data.responseJSON.errors, function(key, value) {
                    error_message += '<li>' + value + '</li>'
                });
                error_message += '</ul>'

                if (error_message == '<ul></ul>') {
                    error_message = data.responseJSON.message
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error_message,
                });
            }
        });
        $(btnId).html('Save').attr('disabled', false)
    }
</script>
