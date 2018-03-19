$(document).ready(function() {

    $('#dwg-works-update').click(function() {

        var dwg = $('#dwg-works-all :checked');
        
        if (dwg.length == 0) {
            alert('Вы не выбрали чертеж');
            return;    
        }

        var dwg_id = dwg[0].getAttribute('dwg_id');

        location.href = 'http://' + location.host + '/drawing/works/form?dwg_id=' + dwg_id;
    });
});
