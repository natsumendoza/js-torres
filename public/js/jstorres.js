$(document).ready(function() {

    checkTshirtArea();

    $('.img-tshirt').on('click', function() {

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

var getShirtId = function(fileName) {
    return fileName.substr(0, fileName.indexOf('_'));
}