$(document).ready(function() {
    var hide = true;
    $('#dwg-revision-toggle').click(function() {
        $('.dwg-revision-hide').toggleClass('row-hide');
        hide = hide ? false : true;
        if (hide) $('#dwg-revision-toggle').text('Показать все доработки Danieli');
        else  $('#dwg-revision-toggle').text('Скрыть старые доработки Danieli');
    });    
});