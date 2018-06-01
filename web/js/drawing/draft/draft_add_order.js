$(document).ready(function() {

    $('#draft-add-order').click(function() {

        var drafts = $('#department-dwg-all :checked');
        
        if (drafts.length == 0) {
            alert('Вы не выбрали эскиз'); 
            return;    
        }
        else if (drafts.length > 1) {
            alert('Добавить в заказ можно только один эскиз');
            return;
        }
        
        var dwg_id = drafts[0].getAttribute('dwg_id');   

        location.href = 'http://' + location.host + '/order/content/add-draft?dwg_id=' + dwg_id;
    });
});
