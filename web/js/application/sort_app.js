$(document).ready(function() {
    
    $('#app-year').change(function() {
        var year = $(this).find('option:selected').val();
        var gets = buidGetString('year', year);
        location.href = 'http://' + location.host + '/application/list?' + gets;    
    }); 
    
    $('#app-department').change(function() {
        var department = $(this).find('option:selected').val();
        var gets = buidGetString('department', department);
        
        location.href = 'http://' + location.host + '/application/list?' + gets;    
    });
    
    $('#app-category').change(function() {
        var category = $(this).find('option:selected').val();
        var gets = buidGetString('category', category);
        location.href = 'http://' + location.host + '/application/list?' + gets;    
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
        if (key == add_key && !add_value) continue;
        if (key == add_key) get_string += '&' + key + '=' + add_value;    
        else get_string += '&' + key + '=' + params[key];   
    }
    
    if (typeof params[add_key] === "undefined") get_string += '&' + add_key + '=' + add_value;
    return get_string.slice(1);
}

