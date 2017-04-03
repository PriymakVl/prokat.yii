$(document).ready(function() {
    
    $('#dwg-file-delete').click(function() { 
        var file_id = $('#file-list-wrp :checked').attr('file_id');
        if (!file_id) {
            alert('Вы не выбрали файл'); 
            return;     
        } 
        var res = confirm('Вы действительно хотите удалить файл?');    
        if (res) location.href = 'http://' + location.host + '/drawing/works/file/delete?file_id=' + file_id ;
    });
})