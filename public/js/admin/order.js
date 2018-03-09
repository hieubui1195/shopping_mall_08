$(function () {

     // Delete promotion
    $('.delete-promotion').click(function() {
        event.preventDefault();
        var strConfirm = $('input[name="confirm"]').val();
        if (confirm(strConfirm)) {
            var promotionId = $(this).attr('data-id');
            $("#delete-form-" + promotionId).submit();
        }
    })


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Approve in index
    $('.approve-order').click(function(event) {
        event.preventDefault();
        var orderId = $(this).attr('data-id');
        $.ajax({
            url: '/admin/approve-order',
            type: 'POST',
            dataType: 'JSON',
            data: { orderId: orderId },
            success: function (data) {
                $('#orders-table').find("[data-id='" + orderId + "']").addClass('disabled');
                swal(data.msg);
            }
        })
    })

    $('#reject-order').click(function(event) {
        event.preventDefault();
        var orderId = $(this).attr('data-id');
        $.ajax({
            url: '/admin/order/' + orderId,
            type: 'DELETE',
            dataType: 'JSON',
            data: { orderId: orderId },
            success: function (data) {
                $('#order-detail').load(location.href + ' #order-detail');
                $('.box').find('.btn-success, .btn-danger').addClass('disabled');
                swal(data.msg);
            }
        })
    })

    $('.reject-order-item').click(function(event) {
        event.preventDefault();
        var orderDetailId = $(this).attr('data-id');
        $.ajax({
            url: '/admin/reject-item',
            type: 'POST',
            dataType: 'JSON',
            data: { orderDetailId: orderDetailId },
            success: function (data) {
                console.log(data);
                $('#order-items').load(location.href + ' #order-items');
                swal(data.msg);
            }
        })
    })

    $('.reject').click(function(event) {
        event.preventDefault();
        var orderId = $(this).attr('data-id');
        $.ajax({
            url: '/admin/order/' + orderId,
            type: 'DELETE',
            dataType: 'JSON',
            data: { orderId: orderId },
            success: function (data) {
                $('.reject').filter('[data-id="' + orderId + '"]').addClass('disabled');
                $('.info').filter('[data-id="' + orderId + '"]').addClass('disabled');
                swal(data.msg);
            }
        })
    })
})
