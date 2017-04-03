$(document).ready(function() {
    
	$('#list-item-update').click(function() {
       var id = $('.list-content :radio:checked').val();
       if (!id) {
            alert('Вы не выбрали елемент'); 
            return; 
       }
       location.href = 'http://' + location.host + '/list/item/update?id=' + id;
	});
    
});