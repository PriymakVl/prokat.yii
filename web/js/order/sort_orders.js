$(document).ready(function() {
    $('#order-period').change(function() {
        var period = $(this).find('option:selected').val();
        var gets = buidGetString('period', period);
        location.href = 'http://' + location.host + '/order/list?' + gets;    
    }); 
    
    $('#order-customer').change(function() {
        var customer = $(this).find('option:selected').val();
        var gets = buidGetString('customer', customer);
        location.href = 'http://' + location.host + '/order/list?' + gets;    
    });
    
    $('#order-area').change(function() {
        var area = $(this).find('option:selected').val();
        var gets = buidGetString('area', area);
        location.href = 'http://' + location.host + '/order/list?' + gets;    
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

function buidGetString(add_key, add_value)
{
    var params = getObjectGetParams();
    var get_string = '';
    
    if (params === false) return  add_key + '=' + add_value;
        
    for (key in params){
        if (key == add_key) get_string += '&' + key + '=' + add_value;
        else get_string += '&' + key + '=' + params[key];   
    }
    
    if (typeof params[add_key] === "undefined") get_string += '&' + add_key + '=' + add_value;
    return get_string.slice(1);
}

