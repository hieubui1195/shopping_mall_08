$(function () {
    // Categories
    // $('#categories-table').DataTable({
    //     "language": {
    //         "lengthMenu"    : "Hiển thị _MENU_ hàng mỗi trang",
    //         "zeroRecords"   : "Không tìm thấy",
    //         "info"          : "Hiển thị _PAGE_ của _PAGES_ trang",
    //         "search"        : "Tìm kiếm:",
    //         "infoEmpty"     : "Không có gì để hiển thị",
    //         "infoFiltered"  : "(lọc từ _MAX_ hàng)",
    //         "paginate"      : {
    //             "first"     : "Đầu tiên",
    //             "last"      : "Cuối cùng",
    //             "next"      : "Tiếp",
    //             "previous"  : "Trước"
    //         },
    //     }
    // })
    $('#categories-table').DataTable();

    // Confirm delete
    
    function confirmDelete() {
        event.preventDefault();
        if (confirm("Are?")) {
            alert($(location).attr('href'););
        }
    }
    

});