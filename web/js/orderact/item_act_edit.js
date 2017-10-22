$(document).ready(function() {

    $('#edit-act-item').click(function() { 
        var item_id = $('table :radio:checked').attr('item_id');
        var act_id = $('table :radio:checked').attr('act_id');

        if (!item_id) {alert('Вы не выбрали элемент для редактирования'); return;}
        
        location.href = 'http://' + location.host + '/order/act/content/form?act_id=' + act_id + '&item_id=' + item_id; 
    });
    
});

