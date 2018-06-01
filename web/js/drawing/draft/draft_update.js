$(document).ready(function() {

    $('#draft-update').click(function() { 

        var drafts = $('#department-dwg-all :checked');
        
        if (drafts.length == 0) {
            alert('Вы не выбрали эскиз'); 
            return;    
        }

        var dwg_id = drafts[0].getAttribute('dwg_id');   

        location.href = 'http://' + location.host + '/drawing/department/form?dwg_id=' + dwg_id;
    });
});
