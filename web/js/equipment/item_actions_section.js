$(document).ready(function() {

    //delete
    $('#item-delete').click(function() {
        var item_id;
        item_id = $('table input:checked').attr('item_id');
        if (!item_id) {
            alert('Вы не выбрали элементы для удаления');
            return;
        }
        var res = confirm('Вы действительно хотите удалить выбранный элемент?');
        if (res) location.href = 'http://' + location.host + '/equipment/delete?item_id=' + item_id;
    });

    //add
    $('#item-add').click(function() {
        var parent_id  = $('.breadcrumbs-wrp span').attr('item_id');
        if (parent_id) location.href = 'http://' + location.host + '/equipment/form?parent_id=' + parent_id;
        else location.href = 'http://' + location.host + '/equipment/form';
    });

    //update
    $('#item-update').click(function() {
        var item_id;
        item_id = $('table input:checked').attr('item_id');
        if (!item_id) {
            alert('Вы не выбрали элементы для редактирования');
            return;
        }
        location.href = 'http://' + location.host + '/equipment/form?item_id=' + item_id;
    });
    
});

