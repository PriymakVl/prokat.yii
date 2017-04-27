$(document).ready(function() {
        //data
        $('#show-letter-form-data').click(function() {
            $('.top-menu a').each(function() {
                $(this).removeClass('top-menu-active-link');    
            });
            $(this).addClass('top-menu-active-link');
            $('#letter-form-data').show();
            $('#letter-form-text').hide();    
        });
        
        //text 
        $('#show-letter-form-text').click(function() {
            $('.top-menu a').each(function() {
                $(this).removeClass('top-menu-active-link');    
            });
            $(this).addClass('top-menu-active-link');
            $('#letter-form-text').show();
            $('#letter-form-data').hide();   
        });   
   
});