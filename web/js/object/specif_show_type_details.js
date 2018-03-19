$(document).ready(function() {

    $('#show-units-box').click(function() {
        $('.top-menu a').removeClass('top-menu-active-link');
        $(this).addClass('top-menu-active-link');
        $('#standards-box').hide();
        $('#units-box, #categories-box').show();
    });

    $('#show-standards-box').click(function() {
        $('.top-menu a').removeClass('top-menu-active-link');
        $(this).addClass('top-menu-active-link');
        $('#standards-box').show();
        $('#units-box, #categories-box').hide();
    });

    $('#show-all').click(function() {
        $('.top-menu a').removeClass('top-menu-active-link');
        $(this).addClass('top-menu-active-link');
        $('#units-box, #categories-box, #standards-box').show();
    });
    
});