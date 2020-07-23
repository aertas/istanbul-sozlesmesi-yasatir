var app = {
    debug: false,
    cropper: function () {
        var cropperOptions = {
            cropUrl: '/',
            processInline: true,
            imgEyecandy: true,
            imgEyecandyOpacity: 0.2,
            customUploadButtonId: 'upload-image',
            onAfterImgUpload: function () {
                $('.cropImgWrapper').addClass('uploaded')
            },
            onAfterImgCrop: function () {
                $('a.download').remove();
                $('#croppic').append('<a class="download" target="_blank" href="' + $('img.croppedImg').attr('src') + '" download>&nbsp;</a>');
                $('a.download').click(function (e) {
                    $(this).remove();
                })
            },
            onBeforeImgUpload: function () {
                $('a.download').remove();
            },
            onBeforeImgCrop: function () {
                $('#croppic').append('<div class="loading"></div>');
            },
            //outputUrlId:'myOutputId'
            doubleZoomControls: false,
            rotateControls: false
        }
        var cropperHeader = new Croppic('croppic', cropperOptions);

    },
    initializing: function () {
        console.log("App Started");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    },
    fixes: function () {
        /** Fix links inside of labels. */
        $('label a[href]').click(function (e) {
            e.preventDefault();
            window.open(this.href, '_blank');
        });
    },
    formValidations: function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    }
};

/** Start App */
(function ($) {
    app.initializing();
    app.fixes();
    app.formValidations();
    app.cropper();
})(jQuery);
