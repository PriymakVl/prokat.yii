$(document).ready(function() {

    $('#dwg-works-delete').click(function() {

        var dwg = $('#dwg-works-all :checked');
        
        if (dwg.length == 0) {
            alert('Вы не выбрали чертеж');
            return;    
        }
        
        $confirm = confirm('Вы действительно хотите удалить чертеж');
        if (!$confirm) return;
        
        var dwg_id = dwg[0].getAttribute('dwg_id');

        location.href = 'http://' + location.host + '/drawing/works/delete?dwg_id=' + dwg_id;
    });
});
