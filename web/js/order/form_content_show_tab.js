$(document).ready(function() {
    //main
    $('#show-content-form-main').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#content-form-main').show();
        $('#content-form-other, #content-form-object').hide();    
    });
    //other 
    $('#show-content-form-other').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#content-form-other').show();
        $('#content-form-main').hide(); 
        $('#content-form-object').hide();   
    });   
    //dimensions
    $('#show-content-form-dimensions').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#content-form-dimensions').show();
        $('#content-form-main, #content-form-other').hide();    
    });
});