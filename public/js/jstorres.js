$(document).ready(function() {

    checkTshirtArea();

    $('.img-tshirt').on('click', function() {
        $('#tshirtFacing').attr('src', $(this).attr('src'));
        $("#imageeditor").css('display', 'block');
        checkTshirtArea();
    });



});

var checkTshirtArea = function() {
    if($('#tshirtFacing').attr('src') == '') {
        $('.logoList').hide();
        $('#addToCart').attr('disabled', 'disabled');
        $('#colorList').hide();
    } else {
        $('.logoList').show();
        $('#addToCart').prop('disabled', false);
        $('#colorList').show();
    }
}