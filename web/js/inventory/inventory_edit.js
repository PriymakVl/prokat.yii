$(document).ready(function() {

    $('#inventory-edit').click(function() { 
        
        var inv_id = $('table :radio:checked').attr('inv_id');

        if (!inv_id) {
            alert('Вы не выбрали номер для редактирования'); 
            return;
        }
        
        location.href = 'http://' + location.host + '/inventory/form?inv_id=' + inv_id; 
    });
    
});

