$(document).ready(function() {
    
    $('#obj-copy').click(function() {     
        var parent_id = prompt('Укажите parent_id');
        
        var obj_id = $('#obj-id').text().trim();    

        if (parent_id && obj_id) location.href = 'http://' + location.host + '/object/copy?obj_id=' + obj_id + '&parent_id=' + parent_id;
        else alert('Error not obj_id or parent_id');
    });    

});


