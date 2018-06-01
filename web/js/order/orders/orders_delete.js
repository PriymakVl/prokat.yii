$(document).ready(function() {

    $('#order-delete').click(function() {
        var order_id;

        var order = $('table :checked');

        if (order.length == 0) {
            alert('Вы не выбрали заказ');
            return;
        }
        else if (order.length > 1) {
            alert('Удалить можно только один заказ');
            return;
        }

        $confirm = confirm('Вы действительно хотите удалить заказ');
        if (!$confirm) return;

        order_id = order[0].getAttribute('order_id');

        location.href = 'http://' + location.host + '/order/delete?order_id=' + order_id;
    });
    
});

