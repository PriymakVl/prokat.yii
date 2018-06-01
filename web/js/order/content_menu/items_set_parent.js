$(document).ready(function() {

    $('#order-items-set-parent').click(function() { 
        var item_id, order_id, ids = '';
        
        $('table input:checked').each(function() {
            item_id = $(this).attr('item_id');
            if (item_id) ids += item_id + ',';
        }); 
        
        order_id = $('#order-id').val();
        
        if (!ids) {alert('Вы не выбрали элементы'); return;}
        ids = ids.slice(0, -1);
        
        parent_id = prompt('Укажите ID сборного элемента');
        if (!+parent_id) {alert('Вы ввели не число'); return;} 
        
        location.href = 'http://' + location.host + '/order/content/set-parent?ids=' + ids + '&order_id=' + order_id + '&parent_id=' + parent_id;
    });
    
});

