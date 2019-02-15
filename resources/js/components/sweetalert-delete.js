$('.delete-alert').click(function(e) {
    e.preventDefault();

    let action = $(this).data('action');
    let form   = $(this).closest("form");

    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this action!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, ' + action + ' it!'
    }).then(function(result) {
        if (result.value) {
            form.submit();
        }
    });
});