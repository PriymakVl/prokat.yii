$(document).ready(function() {
    
    $('#dwg-add-order-item').click(function() { 
        chosen = $('#dwg-list-wrp :checked');
        var file = chosen.attr('file');
        var cat_dwg = chosen.attr('dwg_cat');
        var obj_id = chosen.attr('obj_id');

        if (!file || !cat_dwg || !obj_id) {
            alert('Вы не выбрали чертеж'); 
            return;     
        } 
        location.href = 'http://' + location.host + '/order/content/item/file/add?file=' + file + '&cat_dwg=' + cat_dwg + '&obj_id=' + obj_id;
    });
})