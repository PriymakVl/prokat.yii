$(document).ready(function() {
    //delete item list
	$('#list-item-delete').click(function() {
       var id = $('.list-content :radio:checked').val();
       if (!id) {
            alert('Вы не выбрали елемент'); 
            return; 
       }
       var res = confirm ('Вы уверены что хотите удалить выбранный елемент?');
       if (res) location.href = 'http://' + location.host + '/list/item/delete?id=' + id;
       return false;
	});

	//update item list
    $('#list-item-update').click(function() {
        var id = $('.list-content :radio:checked').val();
        if (!id) {
            alert('Вы не выбрали елемент');
            return;
        }
        location.href = 'http://' + location.host + '/list/item/form?id=' + id;
        return false;
    });
});