$(document).ready(function() {

	$('#list-type-update').click(function() {
       var id = $('#list-type-all :radio:checked').val();
       
       if (!id) {
            alert('Вы не выбрали тип'); 
            return; 
       }

       location.href = 'http://' + location.host + '/listtype/form?id=' + id;
	});
    
});