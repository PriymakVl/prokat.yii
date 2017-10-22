$(document).ready(function() {

    $('#order-act-passed').click(function() { 
        var ids = '';
        
        $('table input:checked').each(function() {
            item_id = $(this).attr('act_id');
            if (item_id) ids += item_id + ',';
        }); 
        
        if (!ids) {
            alert('Вы не выбрали элементы');
            return;
        }
        ids = ids.slice(0, -1);
        
        location.href = 'http://' + location.host + '/order/act/edit/state?ids=' + ids; 
    });
    
});

