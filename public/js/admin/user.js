$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Delete user
    $('.delete-user').click(function(event) {
        event.preventDefault();
        swal({
            title: 'Do you want delete this user?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                var userId = $(this).attr('data-id');
                $.ajax({
                    url: '/admin/user/' + userId,
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: { userId: userId },
                    success: function(data) {
                        swal({
                            text: data.msg,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })
                    }
                })
            }
        })
    })
})
