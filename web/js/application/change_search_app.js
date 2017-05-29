$(document).ready(function() {
    $('.search-app :radio').change(function() {
        var name = $(this).val();
        var placeholder = $(this).attr('holder');
        $('.search-app input[type="text"]').attr('name', name).attr('placeholder', placeholder);    
    });    
});