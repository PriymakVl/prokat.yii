$(document).ready(function() {
    $('.search-box :radio').change(function() {
        var name = $(this).val();
        var placeholder = $(this).attr('holder');
        $('.search-box input[type="text"]').attr('name', name).attr('placeholder', placeholder);    
    });    
});