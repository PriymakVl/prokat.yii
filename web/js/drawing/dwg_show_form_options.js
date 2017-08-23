$(document).ready(function() {
    //main
    $('#objectdrawingform-category').change(function() {
        var category = $(this).val();
        if (category == 'works') $('#dwg-options-wrp').show();
        else $('#dwg-options-wrp').hide();   
    });
    
});