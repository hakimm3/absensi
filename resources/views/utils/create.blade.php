<script>
    console.log('create')
    function setCreate(modalId, formId) {
        $(modalId).modal('show')
        $(formId).trigger('reset')
    }
</script>