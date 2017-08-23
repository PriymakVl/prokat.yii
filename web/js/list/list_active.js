$(document).ready(function() {
    
	$('#list-active').click(function() {
       var list_id = $('#list-all :radio:checked').attr('list_id');
       if (!list_id) {
            alert('Вы не выбрали список'); 
            return; 
       }
       location.href = 'http://' + location.host + '/list/active/set?list_id=' + list_id;
	});
    
});