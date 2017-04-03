$(document).ready(function() {
    
    $('#dwg-delete-obj').click(function() { 
        chosen = $('#dwg-list-wrp :checked');
        var dwg_id = chosen.attr('dwg_id');
        var dwg_cat = chosen.attr('dwg_cat');
        var obj_id = chosen.attr('obj_id');

        if (!dwg_id || !dwg_cat || !obj_id) {
            alert('Вы не выбрали чертеж'); 
            return;     
        }
        
        if (dwg_cat == 'vendor') {
            alert('Вы не можете удалить чертеж производителя');
            return;
        } 
        
        var res = confirm('Вы действительно хотите удалить чертеж?');    
        if (res) location.href = 'http://' + location.host + '/object/drawing/delete?dwg_id=' + dwg_id + '&dwg_cat=' + dwg_cat + '&obj_id=' + obj_id;
    });
})