$(document).ready(function(event) {
    $('.logout').click(function(event) {
        event.preventDefault();
        $('#logout-form').submit();
    })
})
