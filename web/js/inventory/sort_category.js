$(document).ready(function() {

    $('#inventory-sort').change(function() {
       var category = $(this).val();
       
       if (category == 'all') location.href = 'http://' + location.host + '/inventory/list';
       else if (category) location.href = 'http://' + location.host + '/inventory/list?cat=' + category;
	});
    
});