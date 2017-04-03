$(document).ready(function() {
    
    $('#dwg-file-update').click(function() { 
        var file_id = $('#file-list-wrp :checked').attr('file_id');
        var dwg_id = $('#file-list-wrp :checked').attr('dwg_id');
        
        if (!file_id) {
            alert('Вы не выбрали файл'); 
            return;     
        }    
        location.href = 'http://' + location.host + '/drawing/works/file/form?dwg_id=' + dwg_id + '&file_id=' + file_id;
    });
})