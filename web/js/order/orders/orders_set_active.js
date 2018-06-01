$(document).ready(function() {

    $('#order-active').click(function() {
        var order_id;

        var order = $('table :checked');

        if (order.length == 0) {
            alert('Вы не выбрали заказ');
            return;
        }
        else if (order.length > 1) {
            alert('Сделать активным можно только один заказ');
            return;
        }

        order_id = order[0].getAttribute('order_id');

        location.href = 'http://' + location.host + '/order/set-active?order_id=' + order_id;
    });
    
});

