$(document).ready(function() {
    $('#dwg-vendor-update').click(function() { 
       
        chosen = $('#dwg-list-wrp :checked');
        var dwg_id = chosen.attr('dwg_id');
        var dwg_cat = chosen.attr('dwg_cat');
        var obj_id = chosen.attr('obj_id');

        if (!dwg_id || !dwg_cat || !obj_id) {
            alert('Вы не выбрали чертеж'); 
            return;     
        }
        
        if (dwg_cat != 'vendor') {
            alert('Выберите чертеж производителя');
            return;
        } 
           
        location.href = 'http://' + location.host + '/object/drawing/vendor/update?dwg_id=' + dwg_id + '&obj_id=' + obj_id;
    });
})