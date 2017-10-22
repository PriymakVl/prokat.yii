$(document).ready(function() {

    $('#order-acts-delete').click(function() { 
        var ids = '';
        
        $('table input:checked').each(function() {
            act_id = $(this).attr('act_id');
            if (act_id) ids += act_id + ',';
        }); 
        
        
        if (!ids) {alert('Вы не выбрали акты для удаления'); return;}
        ids = ids.slice(0, -1);
        
        var res = confirm('Вы действительно хотите удалить выбранные акты?');
        if (res) location.href = 'http://' + location.host + '/order/act/delete/list?ids=' + ids; 
    });
    
});

