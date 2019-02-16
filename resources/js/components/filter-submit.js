$(document).ready(function () {
    $('.filter-select').on('change', function () {
        $(this).closest('form').submit();
    });
});