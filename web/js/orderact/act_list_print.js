$(document).ready(function() {

    $('#act-list-print').click(function() {
        var act_id, ids = '';
        
        $('table input:checked').each(function() {
            act_id = $(this).attr('act_id');
            if (act_id) ids += act_id + ',';
        });

        // var get_page = buildStingGetPages();
        
        if (!ids) {alert('Вы не выбрали акты'); return;}
        ids = ids.slice(0, -1); 
        
        location.href = 'http://' + location.host + '/orderact/list/file/save?ids=' + ids;
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


