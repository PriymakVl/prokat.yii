$(document).ready(function() {
    $('#material-form-wrp .order-content-item-material').change(function() {
        var material = $(this).find('option:selected').val();
        $('#ordercontentform-material').val(material);    
    }); 
    
     $('#material-add-form-wrp .order-content-item-material').change(function() {
        var material = $(this).find('option:selected').val();
        $('#ordercontentform-material_add').val(material);    
    });  
});