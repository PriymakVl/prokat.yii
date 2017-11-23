$(document).ready(function() {
    $('#code-update').click(function() { 
       
        chosen = $('#dwg-list-wrp :checked');
        var dwg_id = chosen.attr('dwg_id');
        var dwg_cat = chosen.attr('dwg_cat');
        var obj_id = chosen.attr('obj_id');

        if (!dwg_id || !dwg_cat || !obj_id) {
            alert('Вы не выбрали чертеж'); 
            return;     
        }
  
        location.href = 'http://' + location.host + '/object/drawing/code/update?dwg_id=' + dwg_id + '&obj_id=' + obj_id + '&dwg_cat=' + dwg_cat;
    });
})