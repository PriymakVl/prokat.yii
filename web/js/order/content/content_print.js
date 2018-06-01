$(document).ready(function() {

    $('#order-content-print').click(function() { 
        var item_id, order_id, page, ids = '';
        
        $('table input:visible').each(function() {
            item_id = $(this).attr('item_id');
            if (item_id) ids += item_id + ',';
        }); 
        
        page = $('#page-content-wrp a.top-menu-active-link').attr('page');
        page = page ? page : '1';
        
        order_id = $('#order-id').val();
 
        
        location.href = 'http://' + location.host + '/order/content/sheet/print?ids=' + ids + '&order_id=' + order_id + '&page=' + page; 
    });
    
});

