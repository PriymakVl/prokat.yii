$(document).ready(function() {

    //main
    $('#show-app-form-main').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#app-form-main').show();
        $('#app-form-other, #app-form-doc').hide();    
    });
    
    //other 
    $('#show-app-form-other').click(function() {

        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#app-form-other').show();
        $('#app-form-main').hide(); 
        $('#app-form-doc').hide();   
    });
       
    //documents
    $('#show-app-form-doc').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#app-form-doc').show();
        $('#app-form-main, #app-form-other').hide();    
    });
});