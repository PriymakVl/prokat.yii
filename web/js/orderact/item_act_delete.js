$(document).ready(function() {

    $('#delete-act-item').click(function() { 
        
        var item_id = $('table :radio:checked').attr('item_id');

        if (!item_id) {alert('Вы не выбрали элемент для удаления'); return;}
        
        var res = confirm('Вы действительно хотите удалить выбранный элемент?');
        if (res) location.href = 'http://' + location.host + '/order/act/content/delete?item_id=' + item_id; 
    });
    
});

