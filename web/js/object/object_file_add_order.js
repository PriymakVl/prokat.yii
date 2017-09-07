$(document).ready(function() {

    $('#obj-dwg-add-order').click(function() { 
        var obj_id = $('radio:checked').attr('obj_id');
        var file = $(':radio:checked').attr('file');
        alert(obj_id, file); return;
        if (!obj_id || !file) {
            alert('Вы не выбрали файл');
            return;
        }
        else {
            location.href = 'http://' + location.host + '/order/content/item/add?obj_id=' + obj_id + '&file=' + file;     
        }
        
         
    });
    
});
