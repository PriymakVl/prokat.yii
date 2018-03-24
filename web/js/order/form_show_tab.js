$(document).ready(function() {
    //main
    $('#show-order-form-main').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-main').show();
        $('#order-form-other, #order-form-work, #order-form-inventory, #order-form-filters, #inventory-menu').hide();
    });

    //filters
    $('#show-order-form-filters').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-filters').show();
        $('#order-form-inventory, #order-form-work, #order-form-main, #inventory-menu, #order-form-other').hide();
    });

    //other 
    $('#show-order-form-other').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-other').show();
        $('#order-form-inventory, #order-form-work, #order-form-main, #order-form-filters, #inventory-menu').hide();
    });
      
    //work
    $('#show-order-form-work').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-work').show();
        $('#order-form-main, #order-form-other, #order-form-inventory, #order-form-filters, #inventory-menu').hide();
    });
    
    //inventory
    $('#show-order-form-inventory').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#order-form-inventory, #inventory-menu').show();
        $('#order-form-other, #order-form-work, #order-form-main, #order-form-filters').hide();
    });
});