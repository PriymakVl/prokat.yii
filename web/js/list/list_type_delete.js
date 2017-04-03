$(document).ready(function() {
    /* list description */
	$('#list-type-delete').click(function() {
       var id = $('#list-type-all :radio:checked').val();
       
       if (!id) {
            alert('Вы не выбрали тип'); 
            return; 
       }
       
       var res = confirm ('Вы уверены что хотите удалить выбранный тип?');
       
       if (res) location.href = 'http://' + location.host + '/listtype/delete?id=' + id;
	});
    
});s