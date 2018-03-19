$(document).ready(function() {

    $('#inventory-delete').click(function() { 
        
        var inv_id = $('table :radio:checked').attr('inv_id');

        if (!inv_id) {
            alert('Вы не выбрали номер для удаления'); 
            return;
        }
        
        var res = confirm('Вы действительно хотите удалить выбранный номер?');
        if (res) location.href = 'http://' + location.host + '/inventory/delete?inv_id=' + inv_id; 
    });
    
});

