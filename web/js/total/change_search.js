$(document).ready(function() {
    $('.search-box :radio').change(function() {
        var name = $(this).val();
        var placeholder = $(this).attr('holder');
        var action = $(this).attr('action');
        if (action) $('form.search-header').attr('action', action);
        $('.search-box input[type="text"]').attr('name', name).attr('placeholder', placeholder);    
    });    
});