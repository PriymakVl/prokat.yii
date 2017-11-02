$(document).ready(function() {
    //main
    $('#show-form-tab-main').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-main').show();
        $('#form-tab-dwg, #form-tab-dimensions').hide();    
    });
    
    //drawing
    $('#show-form-tab-dwg').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-dwg').show();
        $('#form-tab-main, #form-tab-dinensions').hide();   
    });
      
    //dimensions
    $('#show-form-tab-dimensions').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-dimensions').show();
        $('#form-tab-main, #form-tab-dwg').hide();   
    });
    
});