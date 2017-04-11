$(document).ready(function() {
    $('.search-order :radio').change(function() {
        var name = $(this).val();
        var placeholder = $(this).attr('holder');
        console.log(name);
        console.log(placeholder);
        $('.search-order input[type="text"]').attr('name', name).attr('placeholder', placeholder);    
    });    
});