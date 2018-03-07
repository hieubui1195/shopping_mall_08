// Main js
$(function () {

    // Rember login
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

    function checkExists(sel) {
        var status = false;
        if ($(sel).length) status = true;
        return status;
    }

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

    $('select').select2();

    var productsTable = $('#products-table').DataTable();


    $('#filter-product').change(function() {
        productsTable.search(this.value).draw();   
    })

    var ordersTable = $('#orders-table').DataTable();

    $('#filter-order').change(function() {
        ordersTable.search(this.value).draw();   
    })

    $('.alert-blink').fadeOut('slow');
    $('.alert-blink').fadeOut(5000);
    setInterval(function() {
        $('.alert-blink').remove();
    }, 5000);
})
