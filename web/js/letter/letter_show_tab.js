$(document).ready(function() {
    //data
    $('#show-letter-data').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#letter-data').show();
        $('#letter-text, #letter-file').hide();    
    });
    //text
    $('#show-letter-text').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#letter-text').show();
        $('#letter-data, #letter-file').hide();   
    });   
    //files
    $('#show-letter-files').click(function() {
        $('.top-menu a').each(function() {
            $(this).removeClass('top-menu-active-link');    
        });
        $(this).addClass('top-menu-active-link');
        $('#letter-file').show();
        $('#letter-data, #letter-text').hide();    
    });
});