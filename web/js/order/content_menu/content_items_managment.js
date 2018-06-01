$(document).ready(function() {

    //delete or add items for content order
    $('#order-items-managment').click(function() { 
        var item_id, order_id, ids = '';
        
        $('table input:checked').each(function() {
            item_id = $(this).attr('item_id');
            if (item_id) ids += item_id + ',';
        }); 
        
        order_id = $('#order-id').val();
        
        if (!ids) {alert('Вы не выбрали элементы'); return;}
        ids = ids.slice(0, -1);
        
        location.href = 'http://' + location.host + '/order/content/delete-or-add-item-for-content?ids=' + ids + '&order_id=' + order_id;
    });
    
});

