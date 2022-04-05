$(document).ready(function () {
    $(".import").on('change', function () {
        let redirect = $(this).data('redirect');
        let formData = new FormData();
        formData.append('file', $(this)[0].files[0]);

        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        }).done(function (data) {
            document.location.href = redirect;
        }).error(function (data) {
            console.log(data)
        });
    });
});

