$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.reject-promotion-item').click(function(event) {
        event.preventDefault();
        var promotionDetailId = $(this).attr('data-id');
        $.ajax({
            url: '/admin/reject-promotion-item',
            type: 'POST',
            dataType: 'JSON',
            data: { promotionDetailId: promotionDetailId },
            success: function (data) {
                $('#promotion-items').load(location.href + ' #promotion-items');
                $('.alert-success').removeAttr('style');
                $('.alert-success').children().next().text(data.msg);
                $('.alert-success').addClass('alert-blink');
            }
        })
    })
})
