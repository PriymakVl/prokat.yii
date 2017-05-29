$(document).ready(function() {
    
    $('#dwg-add-note').click(function() { 
        var dwg_id = $('#dwg-list-wrp :checked').attr('dwg_id');
        var dwg_cat = $('#dwg-list-wrp :checked').attr('dwg_cat');
        var obj_id = $('#dwg-list-wrp :checked').attr('obj_id');
        if (dwg_cat == 'works') file_id = $('#dwg-list-wrp :checked').attr('file_id');

        if (!dwg_id || !dwg_cat || !obj_id) {
            alert('Вы не выбрали чертеж'); 
            return;     
        }    
        if (dwg_cat == 'works')location.href = 'http://' + location.host + '/object/drawing/note?dwg_id=' + dwg_id + '&file_id=' + file_id + '&dwg_cat=' + dwg_cat + '&obj_id=' + obj_id;
        else location.href = 'http://' + location.host + '/object/drawing/note?dwg_id=' + dwg_id + '&dwg_cat=' + dwg_cat + '&obj_id=' + obj_id;
    });
    
    /* show full note drawign */
/*
     $('.note-cut').click(function() {
        var note = $(this).attr('note');
        $('.note-full p').text(note);
        $('.note-full').show();
        $('#dwg-list-wrp').hide();
     });
     
      $('#note-hide').click(function() {
        $('.note-full').hide();
        $('#dwg-list-wrp').show();    
     });
 */
})