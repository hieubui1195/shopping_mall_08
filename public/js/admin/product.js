$(function () {

    var formType = $('input[name="formType"]').val();

    // Delete product
    $('.delete-product').click(function() {
        event.preventDefault();
        var strConfirm = $('input[name="confirm"]').val();
        if (confirm(strConfirm)) {
            var productId = $(this).attr('data-id');
            $("#delete-form-" + productId).submit();
        }
    })

    // Check form type
    // If type is reuse then disabled
    if (formType != 'reuse') {
        $('[data-quantity="plus"]').click(function(e){
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            if (!isNaN(currentVal)) {
                $('input[name='+fieldName+']').val(currentVal + 1);
            } else {
                $('input[name='+fieldName+']').val(0);
            }
        });
        $('[data-quantity="minus"]').click(function(e) {
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            if (!isNaN(currentVal) && currentVal > 0) {
                $('input[name='+fieldName+']').val(currentVal - 1);
            } else {
                $('input[name='+fieldName+']').val(0);
            }
        });
    }

    $("#image").change(function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#image-preview");
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("src", e.target.result);
                        img.attr("class", "col-xs-4 img img-thumbnail");
                        dvPreview.append(img);
                    }
                    reader.readAsDataURL(file[0]);

                    var imgHidden = $("<input />")
                    imgHidden.val(file[0].name);
                    imgHidden.attr("name", "imgHidden[]");
                    imgHidden.attr("type", "file");
                    imgHidden.attr("class", "img-hidden");
                    imgHidden.attr("style", "display: none");
                    dvPreview.append(imgHidden);
                } else {
                    alert(file[0].name + " is not a valid image file.");
                    dvPreview.html("");
                    return false;
                }
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });

    // Ajax

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Reuse product
    if (formType == 'reuse') {
        // Disable form element
        $('#form-edit-product').find('select, input, textarea, span').attr('disabled', 'disabled');
        // Enable button reuse
        $('#btn-reuse').removeAttr('disabled');

        // Request reuse
        $('#form-edit-product').submit(function(event) {
            event.preventDefault();
            var name = $('#name').val();
            $.ajax({
                url: '/admin/reuse-product',
                type: 'POST',
                dataType: 'JSON',
                data: { name: name },
                success: function (data) {
                    console.log(data.statusReuse);
                    if (data.statusReuse == 1) {
                        $('.alert-success').removeAttr('style');
                        $('.alert-success').children().next().text('The item has been reuse');
                        $('.alert-success').addClass('alert-blink');
                        $('#box-edit-product').load(location.href + ' #box-edit-product');
                        $('input').select2();
                    }

                }
            })
        })
    }
});
