// Main js
$(function () {

    // Rember login
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });


});

$(document).ready(function() {
    $('.delete-category').click(function() {
        event.preventDefault();
        var strConfirm = $('input[name="confirm"]').val();
        if (confirm(strConfirm)) {
            var categoryId = $(this).attr('data-id');
            $("#delete-form-" + categoryId).submit();
        }
    })

    var categoriesTable = $('#categories-table').DataTable();

    $('#filter-category').change(function() {
        categoriesTable.search(this.value).draw();   
    })

    $('.alert').fadeOut('slow');
    $('.alert').fadeOut(5000);
    setInterval(function() {
        $('.alert').remove();
    }, 5000);
})

