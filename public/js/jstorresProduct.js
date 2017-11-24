$(document).ready(function () {

    $('#jersey-div').hide();
    $('#bag-div').hide();

    $('#formType').val($('#productType').val());

    if($('#productType').val() === 'jersey') {
        $('#bag-div').hide();
        $('#jersey-div').show();
    } else {
        $('#jersey-div').hide();
        $('#bag-div').show();
    }

    $('#productType').change(function () {
        var productType = $(this).val();

        $('#formType').val(productType);

        if(productType === 'jersey') {
            $('#bag-div').hide();
            $('#jersey-div').show();
        } else {
            $('#jersey-div').hide();
            $('#bag-div').show();
        }

    });
});