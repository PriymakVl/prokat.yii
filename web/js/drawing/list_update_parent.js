$(document).ready(function() {
    
    $('#dwg-list-update-parent').click(function() { 
        var dwg_id, ids = '';
        var controller = $('#dwg-controller').val().substr(8);
        
        $('table input:checked').each(function() {
            dwg_id = $(this).attr('dwg_id');
            if (dwg_id) ids += dwg_id + ',';
        }); 
        if (!ids) {alert('Вы не выбрали чертежи'); return;}
        ids = ids.slice(0, -1);
        parent_id = prompt('Укажите ID parent');
        if (!+parent_id) {alert('Вы ввели не число'); return;} 
        
        $.get('/drawing/' + controller + '/setparent', {ids: ids, parent_id: parent_id}, resultSetParent);  
    });
});

function resultSetParent(answer)
{ 
    alert(answer);
    return;
    if (answer == 'error') alert('Ошибка при редактировании чертежей');
    else if (answer == 'success'){
        alert('Чертежи успешно отредактированы');
        //cancel checked
        $('table :checkbox').each(function() {
            $(this).prop('checked', false);
        }); 
        location.reload();
    } 
    else  alert('Неизвестная ошибка');
}