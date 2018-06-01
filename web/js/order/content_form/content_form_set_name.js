$(document).ready(function() {
    $('#names').change(function() {
        var name = $(this).val();
        $('#ordercontentform-name').val(name);    
    });  
});