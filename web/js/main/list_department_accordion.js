var link_obj;

function sublist(obj)
{
    link_obj = obj;
    if ($(obj).parent().is( ".exit-sublist" ) ) {
        $(obj).removeClass('current-item');
        $(obj).parent().removeClass('exit-sublist');
        $(obj).parent().children('ul').remove();
        return;
    } else {
        $(obj).parent().addClass('exit-sublist');
        $(obj).addClass('current-item');
    }
    var obj_id = $(obj).parent().attr('obj_id');
    $(obj).attr('li_content', 'full');
    $.get('main/sublist', {obj_id: obj_id}, addSublist);  
}

function addSublist(data)
{  
    if (+data) {
        var obj_id = data;
        var url = 'http://' + location.host + '/object?obj_id=' + obj_id;
        location.href = url;
        return;
    }  
    else data = JSON.parse(data);
    
    var code, name;
    var ulHtml = '<ul class="department-list-item">';
    for (var i = 0; i < data.length; i++) {
        if (data[i].code) code = '<a target="_blank" class="department-code-link" href="object/drawing?obj_id=' + data[i].id + '">' + data[i].code + '</a>';
        else code = '<a target="_blank" class="department-code-link" href="object/specification?obj_id=' + data[i].id + '">код не указан</a>';
        
        name = '<a href="#" onclick="sublist(this);"><span>' + (data[i].item == 0 ? "" : data[i].item + '&nbsp;&nbsp;&nbsp;') + '</span>' + data[i].name + '</a>';
        ulHtml += '<li class="departmen-list-item" obj_id="' + data[i].id + '">' + name + '&nbsp;&nbsp;&nbsp;' + code + '</li>';    
    }
    ulHtml += '</ul>';
    $(link_obj).parent().append(ulHtml);
}	