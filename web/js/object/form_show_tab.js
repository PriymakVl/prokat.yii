$(document).ready(function() {
    //main
    $('#show-form-tab-main').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-main').show();
        $('#form-tab-dwg, #form-tab-dimensions, #form-tab-material, #form-tab-other').hide();
    });
    
    //drawing
    $('#show-form-tab-dwg').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-dwg').show();
        $('#form-tab-main, #form-tab-dinensions, #form-tab-material, #form-tab-other').hide();
    });

    //material
    $('#show-form-tab-material').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-material').show();
        $('#form-tab-main, #form-tab-dinensions, #form-tab-dwg, #form-tab-other').hide();
    });

    //other
    $('#show-form-tab-other').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-other').show();
        $('#form-tab-main, #form-tab-dinensions, #form-tab-dwg, #form-tab-material').hide();
    });
      
    //dimensions
    $('#show-form-tab-dimensions').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-dimensions').show();
        $('#form-tab-main, #form-tab-dwg, #form-tab-material, #form-tab-other').hide();
    });
    
});