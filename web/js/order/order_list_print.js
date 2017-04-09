$(document).ready(function() {

    $('#order-list-print').click(function() { 
        var order_id, ids = '';
        
        $('table input:checked').each(function() {
            order_id = $(this).attr('order_id');
            if (order_id) ids += order_id + ',';
        });

        var get_page = buildStingGetPages(); 
        
        if (!ids) {alert('Вы не выбрали заказы'); return;}
        ids = ids.slice(0, -1); 
        
        location.href = 'http://' + location.host + '/order/list/file/save?ids=' + ids + get_page; 
    });
    
});

function getObjectGetParams()
{
    var search = window.location.search.substr(1),
    params = {};
    if (search == '') return false;   
    search.split('&').forEach(function(item) {
        item = item.split('=');
        params[item[0]] = item[1];
    });
    return params;
}

function buildStingGetPages()
{
    var get = getObjectGetParams();
    var string = '';
    if (get.page) string += '&page' + get.page;
    if (get.pages) string += '&pages' + get.pages;
    return string; 
}


