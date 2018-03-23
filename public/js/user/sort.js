$(document).ready(function() {
    $('.sort-filter').on('change', '.sort-price', function(event) {
        var type = parseInt($(this).val());
        var pathname = window.location.pathname;
        $('.sort-price').val(type);
        var page = 0;
        sortPrice(type, pathname, page);

        $(document).on('click','.pagination a', function(e){
            e.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            sortPrice(type, pathname, page);
        });
    })


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function sortPrice(type, pathname, page) {
        $.ajax({
            url: pathname + '?page=' + page,
            type: 'GET',
            datatype: 'JSON',
            data: { type: type },
            success: function(data) {
                $('body').html(data);
            }
        })
    }
});
