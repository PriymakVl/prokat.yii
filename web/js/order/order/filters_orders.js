$(document).ready(function() {
    $('#order-period').change(function() {
        var period = $(this).find('option:selected').val();
        var gets = buidGetString('period', period);
        if (period) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    }); 
    
    $('#order-customer').change(function() {
        var customer = $(this).find('option:selected').val();
        var gets = buidGetString('customer', customer);
        if (customer) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });
    
    $('#order-section').change(function() {
        var section_id = $(this).find('option:selected').val();
        //var gets = buidGetString('section', section_id);
        var gets = 'period=all&state=all&section=' + section_id;
        if (section_id) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });
    
    $('#order-equipment').change(function() {
        var equipment_id = $(this).find('option:selected').val();
        var gets = buidGetString('equipment', equipment_id);
        if (equipment_id) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });
    
    $('#order-unit').change(function() {
        var unit_id = $(this).find('option:selected').val();
        var gets = buidGetString('unit', unit_id);
        if (unit_id) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });
    
    $('#order-type').change(function() {
        var type = $(this).find('option:selected').val();
        var gets = buidGetString('type', type);
        if (type) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });
    
    $('#order-kind').change(function() {
        var kind = $(this).find('option:selected').val();
        var gets = buidGetString('kind', kind);
        if (kind == 2) location.href = 'http://' + location.host + '/orders?kind=2&period=all';
        else if (kind) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });
    
    $('#order-state').change(function() {
        var state = $(this).find('option:selected').val();
        var gets = buidGetString('state', state);
        if (state) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });

    $('#order-group').change(function() {
        var group = $(this).find('option:selected').val();
        var gets = buidGetString('group', group);
        if (group) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });

    $('#order-subgroup').change(function() {
        var sub = $(this).find('option:selected').val();
        var gets = buidGetString('subgroup', sub);
        if (sub) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
    });

    $('#order-group-unit').change(function() {
        var unit = $(this).find('option:selected').val();
        var gets = buidGetString('unit_subgroup', unit);
        if (unit) location.href = 'http://' + location.host + '/orders?' + gets;
        else location.href = 'http://' + location.host + '/orders';
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

