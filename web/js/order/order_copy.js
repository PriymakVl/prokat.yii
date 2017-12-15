$(document).ready(function() {

    $('#order-copy').click(function() { 
    
        var order_num = prompt('Укажите номер заказа');
  
        var get = getObjectGetParams();
        var order_id = get.order_id;

        if (!order_id) alert('Error not order_id'); 
        else location.href = 'http://' + location.host + '/order/copy?order_id=' + order_id + '&number=' + order_num;
    });  
    
    function getObjectGetParams()
    {
        var search = window.location.search.substr(1),
        params = {};
        if (search == '') return false;   
        search.split('&').forEach(function(item) {
            item = item.split('=');
            params[item[0]] = item[1];
        });
        return params;
    }  

});


