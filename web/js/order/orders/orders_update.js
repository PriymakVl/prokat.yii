$(document).ready(function() {

    $('#order-update').click(function() {
        var order_id;

        var order = $('table :checked');

        if (order.length == 0) {
            alert('Вы не выбрали заказ');
            return;
        }
        else if (order.length > 1) {
            alert('Отредактировать можно только один заказ');
            return;
        }

        order_id = order[0].getAttribute('order_id');

        location.href = 'http://' + location.host + '/order/form?order_id=' + order_id;
    });
    
});

