$(document).ready(function() {
    //main
    $('#show-form-tab-main').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-act-form-tab-main').show();
        $('#order-act-form-tab-items, #order-act-form-tab-additional').hide();
    });
    
    //items
    $('#show-form-tab-items').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-act-form-tab-items').show();
        $('#order-act-form-tab-main, #order-act-form-tab-additional').hide();
    });

    //items
    $('#show-form-tab-additional').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');
        });
        $(this).addClass('top-menu-active-link');
        $('#order-act-form-tab-additional').show();
        $('#order-act-form-tab-main, #order-act-form-tab-items').hide();
    });
    
});