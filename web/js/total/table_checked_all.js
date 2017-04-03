$(document).ready(function() {
    //checked all checkbox
    $('#checked-all').click(function() {
        if($(this).is(':checked'))$("table input[type=checkbox]").prop('checked', true);   
        else $("table input[type=checkbox]").prop('checked', false);
    });
     
});