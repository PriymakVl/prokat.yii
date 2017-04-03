$(document).ready(function() {
    $('.sidebar-menu h5').click(function() {
        $(this).next('ul').toggleClass('hide-menu');    
    });
})