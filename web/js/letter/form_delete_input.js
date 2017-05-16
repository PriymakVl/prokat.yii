$(document).ready(function() {
    $('#delete-input-copy').click(function() {
        $('.label-copy-position, .copy-position, .label-copy-name, .copy-name').remove();    
    }); 
    
    $('#delete-input-from').click(function() {
        $('.label-from-position, .from-position, .label-from-name, .from-name, br').remove();    
    });
    
//    $(':radio[value="copy"]').change(function() {
//        if ($(this).prop('checked')) $('#delete-input-copy').show();
//    });  
    
   // $(':radio[value="whom"]').change(function() {
//        if ($(this).prop('checked')) $('#delete-input-copy').hide();
//    });  
});