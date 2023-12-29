<script>
    $(document).ready(function(){
        $('.delele-btn-item').click(function(e){
            e.preventDefault();
            let deleteRoute = $(this).data('delete-route');
            console.log(deleteRoute);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
                
                }).then((result) => {
                if (result.isConfirmed) {
                     $.ajax({
                        url: deleteRoute,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            swalWithBootstrapButtons.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success",
                                timer: 1000
                                }).then(() => {
                                        location.reload();
                                    });
                                },
                        error: function(error) {
                            swalWithBootstrapButtons.fire({
                                title: 'Error processing!',
                                text: 'Please try again!',
                                icon: 'error'
                            });
                        }
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                    });
                }
                });
        });
    })
</script>