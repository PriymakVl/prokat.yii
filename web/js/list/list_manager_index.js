$(document).ready(function() {
    //list delete
    $('#list-delete').click(function() {
        var result = confirm('Вы уверены что хотите удалить список и все его элементы?');
        if (!result) return;
        var list_id = $('#list-id').val();
        location.href = 'http://' + location.host + '/lists/list/delete?list_id=' + list_id;
    });
    
})