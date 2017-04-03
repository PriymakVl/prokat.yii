$(document).ready(function() {
    //main
    $('#show-order-form-main').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-main').show();
        $('#order-form-other, #order-form-work').hide();    
    });
    //other 
    $('#show-order-form-other').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-other').show();
        $('#order-form-main').hide(); 
        $('#order-form-work').hide();   
    });   
    //work
    $('#show-order-form-work').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-work').show();
        $('#order-form-main, #order-form-other').hide();    
    });
});