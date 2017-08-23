$(document).ready(function() {

    //department
    $('#show-form-tab-department').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-department').show();
        $('#form-tab-object, #form-tab-dimensions').hide();    
    });
    
    //object
    $('#show-form-tab-object').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-object').show();
        $('#form-tab-department, #form-tab-dimensions').hide();  
    }); 
      
    //dimensions
    $('#show-form-tab-dimensions').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#form-tab-dimensions').show();
        $('#form-tab-department, #form-tab-object').hide();    
    });
});