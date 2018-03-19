$(document).ready(function() {

    $('#obj-list-copy').click(function() {
        var obj_id, ids = '';

        $('table input:checked').each(function() {
            obj_id = $(this).attr('obj_id');
            if (obj_id) ids += obj_id + ',';
        }); 
        if (!ids) {alert('Вы не выбрали объекты для копирования'); return;}
        ids = ids.slice(0, -1);
        parent_id = prompt('Укажите ID parent');
        if (!+parent_id) {alert('Вы ввели не число'); return;} 
        
        location.href = 'http://' + location.host + '/object/specification/copy/list?ids=' +ids + '&parent_id=' + parent_id;  
    });
    
});
