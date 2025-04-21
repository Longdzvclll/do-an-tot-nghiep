$(document).ready(function () {
    $('input[name="name"], input[name="title"]').on('input', function () {
        const slug = $(this).val()
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');

        $('input[name="slug"]').val(slug);
    });

    setTimeout(function () {
        $('.alert').alert('close');
    }, 3000);


    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});
