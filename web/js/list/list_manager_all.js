$(document).ready(function() {
    //set list active
	$('#list-active').click(function(event) {
        event.preventDefault();
        var list_id = getListId();
        if (list_id) location.href = 'http://' + location.host + '/list/set-active?list_id=' + list_id;
	});

	//list delete
    $('#list-delete').click(function(event) {
        event.preventDefault();
        var list_id = getListId();
        if (list_id) location.href = 'http://' + location.host + '/list/delete?list_id=' + list_id;
    });

    //list update
    $('#list-update').click(function(event) {
        event.preventDefault();
        var list_id = getListId();
        if (list_id) location.href = 'http://' + location.host + '/list/form?list_id=' + list_id;
    });
});

function getListId()
{
    var list_id = $('#list-all :radio:checked').attr('list_id');
    if (!list_id) {
        alert('Вы не выбрали список');
        return false;
    }
    return list_id;
}