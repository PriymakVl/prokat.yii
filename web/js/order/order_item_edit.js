$(document).ready(function() {

    $('#order-item-update').click(function() {
        var items = $('table :checkbox:checked');

        if (!items) {alert('Вы не выбрали элемент для редактирования'); return;}

        var item_id = items[0].getAttribute('item_id');
        var order_id = items[0].getAttribute('item_id');


        
        location.href = 'http://' + location.host + '/order/content/form?item_id=' + item_id + '&order_id=' + order_id;
    });
    
});

