$(document).ready(function() {
    $('#order-content-item-material').change(function() {
        var material = $(this).find('option:selected').val();
        $('#item-material').val(material);    
    });   
});