$(document).ready(function() {
    
    $('#obj-list-delete').click(function() { 
        var obj_id, parent_id, ids = '';
        
        $('table input:checked').each(function() {
            obj_id = $(this).attr('obj_id');
            if (obj_id) ids += obj_id + ',';
        }); 
        
        parent_id = $('#parent-id').val();
        
        if (!ids) {alert('Вы не выбрали объекты для удаления'); return;}
        ids = ids.slice(0, -1);
        
        var res = confirm('Вы действительно хотите удалить выбранные объекты?');
        if (res) location.href = 'http://' + location.host + '/object/specification/delete/list?ids=' + ids + '&parent_id=' + parent_id; 
    });
    
});

