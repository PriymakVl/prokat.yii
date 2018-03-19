$(document).ready(function() {

    $('#show-filters').click(function(event) {
        event.preventDefault();
        $.get('/order/act/show/filters', {'test':'test'}, show_filters);
    });


    function show_filters(result) {
        if (!result) alert('error');
        else $('.top-menu').toggleClass('hidden');
    }

    
});

