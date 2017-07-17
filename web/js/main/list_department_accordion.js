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
        var url = 'http://' + location.host + '/object/specification?obj_id=' + obj_id;
        location.href = url;
        return;
    }  
    else data = JSON.parse(data);
    
    var code, name, item, item_name;
    var ulHtml = '<ul class="department-list-item">';
    for (var i = 0; i < data.length; i++) {
        code = '<a target="_blank" class="department-code-link" href="object/drawing?obj_id=' + data[i].id + '">' + data[i].code + '</a>';
        
        if (data[i].item != '0') item = '<a target="_blank" style="color:#494949;" href="object?obj_id=' + data[i].id + '">' + data[i].item + '</a>&nbsp;&nbsp;&nbsp;';
        else item = '';

        if (data[i].order == '1') name = '<a href="#" style="color:green;" onclick="sublist(this);">' + data[i].name + '</a>';
        else if (data[i].color == '1') name = '<a href="#" style="color:red;" onclick="sublist(this);">' + data[i].name + '</a>';
        else if (data[i].parent == '0') name = '<a href="#" style="color:#494949;" onclick="sublist(this);">' + data[i].name + '</a>';
        else name = '<a href="#" onclick="sublist(this);">' + data[i].name + '</a>';
        
        ulHtml += '<li class="departmen-list-item" obj_id="' + data[i].id + '">' + item + name + '&nbsp;&nbsp;&nbsp;' + code + '</li>';    
    }
    ulHtml += '</ul>';
    $(link_obj).parent().append(ulHtml);
}	