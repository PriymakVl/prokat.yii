$(document).ready(function() {

    $('#order-items-delete').click(function() { 
        var item_id, order_id, ids = '';
        
        $('table input:checked').each(function() {
            item_id = $(this).attr('item_id');
            if (item_id) ids += item_id + ',';
        }); 
        
        order_id = $('#order-id').val();
        
        if (!ids) {alert('Вы не выбрали элементы для удаления'); return;}
        ids = ids.slice(0, -1);
        
        var res = confirm('Вы действительно хотите удалить выбранные элементы?');
        if (res) location.href = 'http://' + location.host + '/order/content/delete/list?ids=' + ids + '&order_id=' + order_id; 
    });
    
});

