$(document).ready(function() {

    $('#order-act-registr').click(function() { 
        var item_id, order_id, number, ids = '';
        
        $('table input:checked').each(function() {
            item_id = $(this).attr('item_id');
            if (item_id) ids += item_id + ',';
        }); 
        
        order_id = $('#order-id').val();
        
        number = prompt('Введите номер заказа');
        
        if (!number) {
            alert('Вы не ввели номер заказа');
            return;
        } 
        if (!+number) {
            alert('Номер заказа должен быть числом');
            return;    
        }
        
        if (!ids) {
            alert('Вы не выбрали элементы');
            return;
        }
        ids = ids.slice(0, -1);
        
        location.href = 'http://' + location.host + '/order/act/registr?ids=' + ids + '&order_id=' + order_id + '&number=' + number; 
    });
    
});

