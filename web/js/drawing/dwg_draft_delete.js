$(document).ready(function() {

    $('#draft-delete').click(function() { 

        var drafts = $('#department-dwg-all :checked');
        
        if (drafts.length == 0) {
            alert('Вы не выбрали эскиз'); 
            return;    
        }
        
        $confirm = confirm('Вы действительно хотите удалить эскиз');
        if (!$confirm) return;
        
        var dwg_id = drafts[0].getAttribute('dwg_id');   

        location.href = 'http://' + location.host + '/drawing/department/delete?dwg_id=' + dwg_id;
    });
});
