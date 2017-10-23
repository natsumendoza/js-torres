$(document).ready(function() {
    $('.img-tshirt').on('click', function() {
        $('#tshirtFacing').attr('src', $(this).attr('src'));
        $("#imageeditor").css('display', 'block');
    });
});