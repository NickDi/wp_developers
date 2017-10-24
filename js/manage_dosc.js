(function ($) {

$(document).on('ready', function () {
    var controls = $("<div>", {
        css: {
            display: 'none'
        }
    });
    //$('.wrap h2:first').after(controls);
    $('.wrap').prepend(controls);
    controls.html($('#template-post-menu').html());
    $('.actions-menu', controls).kendoMenu({
        openOnClick: true
    });
    controls.fadeIn();

    var uploaderEnabled = false;
    var uploader = $('.uploader', controls);
    $("#load-csv", controls)
        .on('click', function () {
            uploaderEnabled = !uploaderEnabled;
            if (uploaderEnabled) {
                uploader.fadeIn();
            } else {
                uploader.fadeOut();
            }
        });

    var params = [
        'action=uploader',
        'MAX_FILE_SIZE=5000000'
    ];
    $('.uploader input[type="file"]', controls).kendoUpload({
        async: {
            saveUrl: window.ajaxurl + '?' + params.join('&'),
            autoUpload: true
        },
        localization: {
            select: "Укажите файл..."
        },
        success: function (out) {
            var data = out.response;
            console.log('OUT', data);
            window.location.href = [
                window.location.origin,
                window.location.pathname
            ].join('') + '?post_type=document';
        }
    });

});

}(jQuery));