$(document).ready(function() {

    $('#obj-list-add-order').click(function() { 
        var obj_id, parent_id, ids = '';
        
        parent_id = $('#parent-id').val();

        $('table input:checked').each(function() {
            obj_id = $(this).attr('obj_id');
            if (obj_id) ids += obj_id + ',';
        }); 
        if (!ids) {alert('Вы не выбрали объекты для копирования'); return;}
        ids = ids.slice(0, -1);
        
        location.href = 'http://' + location.host + '/order/content/list/add?parent_id=' + parent_id + '&ids=' +ids;  
    });
    
});
