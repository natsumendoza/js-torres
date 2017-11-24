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

    $('.dropdown-submenu a.test').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });

});
