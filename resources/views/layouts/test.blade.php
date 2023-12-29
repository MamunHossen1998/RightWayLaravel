<script>
    $.ajax({
        url: deleteRoute,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            Swal.fire({
                title: 'Deleted successfully!',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000
            }).then(() => {
                location.reload();
            });
        },
        error: function(error) {
            Swal.fire({
                title: 'Error processing!',
                text: 'Please try again!',
                icon: 'error'
            });
        }
    });

</script>