$(document).ready(function() {
    var item_num, input_all;
    input_all = $('input[name="content"]:not(#checked-all)');
    
    //show all
    $('#page-all').click(function() {
        $('#page-content-wrp a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        
        input_all.each(function() {
            $(this).parent().parent().show();    
        });   
    });
    
    //show page 1
    $('#page-1').click(function() {
        $('#page-content-wrp a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        
        input_all.each(function() {
            item_num = $(this).attr('number');
            if (item_num < 11) $(this).parent().parent().show();
            else $(this).parent().parent().hide();    
        });   
    });
    
    //show page 2
    $('#page-2').click(function() {
        $('#page-content-wrp a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        
        input_all.each(function() {
            item_num = $(this).attr('number');
            if (item_num > 10 && item_num < 21) $(this).parent().parent().show();
            else $(this).parent().parent().hide();    
        });   
    });
    
    //show page 3
    $('#page-3').click(function() {
        $('#page-content-wrp a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        
        input_all.each(function() {
            item_num = $(this).attr('number');
            if (item_num > 20 && item_num < 31) $(this).parent().parent().show();
            else $(this).parent().parent().hide();    
        });   
    });
    
    //show page 4
    $('#page-4').click(function() {
        $('#page-content-wrp a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        
        input_all.each(function() {
            item_num = $(this).attr('number');
            if (item_num > 30 && item_num < 41) $(this).parent().parent().show();
            else $(this).parent().parent().hide();    
        });   
    });
    
    //show page 5
    $('#page-5').click(function() {
        $('#page-content-wrp a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        
        input_all.each(function() {
            item_num = $(this).attr('number');
            if (item_num > 40 && item_num < 51) $(this).parent().parent().show();
            else $(this).parent().parent().hide();    
        });   
    });
    
    //show page 6
    $('#page-6').click(function() {
        $('#page-content-wrp a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        
        input_all.each(function() {
            item_num = $(this).attr('number');
            if (item_num > 50 && item_num < 61) $(this).parent().parent().show();
            else $(this).parent().parent().hide();    
        });   
    });
    
});