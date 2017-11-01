$(document).ready(function() {

    $('#productType').change(function () {
        if ($(this).val() === 'bag') {
            $('#leftImageForm').hide();
            $('#rightImageForm').hide();
        } else {
            $('#leftImageForm').show();
            $('#rightImageForm').show();
        }
    });

});
