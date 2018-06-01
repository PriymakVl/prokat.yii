$(document).ready(function() {

    $('#add-object').click(function() { 
        var order_id = $(this).attr('order_id');
        var code = prompt('Укажите код объекта');
        if (!code) {alert('Вы не указали код'); return;} 
        location.href = 'http://' + location.host + '/order/content/object/add?order_id=' + order_id + '&code=' + code; 
        //location.href = 'http://' + location.host + '/order/content/object/add?code=test&order_id=test';  
    });
    
});
