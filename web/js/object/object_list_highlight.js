$(document).ready(function() {
    
    $('#obj-list-highlight').click(function() { 
        var obj_id, ids = '';
        $('table input:checked').each(function() {
            obj_id = $(this).attr('obj_id');
            if (obj_id) ids += obj_id + ',';
        }); 
        if (!ids) {alert('Вы не выбрали объекты'); return;}
        ids = ids.slice(0, -1);
		
        var parent_id =  $('#parent-id').val();
        
        location.href = 'http://' + location.host + '/object/specification/highlight/list?ids=' +ids + '&parent_id=' + parent_id;  
    });
    
});
