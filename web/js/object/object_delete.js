$(document).ready(function() {
    
    $('#obj-delete').click(function() { 
        var res = confirm('Вы действительно хотите удалить объект?');
        if (res) {
            var obj_id = $('#obj-id').attr('data-id');    
            location.href = 'http://' + location.host + 'object/delete?obj_id=' + obj_id; 
        }    
    });
});
