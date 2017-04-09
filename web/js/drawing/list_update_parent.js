$(document).ready(function() {
    
    $('#dwg-list-update-parent').click(function() { 
        var dwg_id, ids = '';
        var category = $('#dwg-category').val();
        
        $('table input:checked').each(function() {
            dwg_id = $(this).attr('dwg_id');
            if (dwg_id) ids += dwg_id + ',';
        }); 
        if (!ids) {alert('Вы не выбрали чертежи'); return;}
        ids = ids.slice(0, -1);
        parent_id = prompt('Укажите ID parent');
        if (!parent_id) return; 
        if (!+parent_id) {alert('Вы ввели не число'); return;}
        
        location.href = 'http://' + location.host + '/drawing/' + category + '/set/parent?ids=' + ids + '&parent_id=' + parent_id;
    });
});
