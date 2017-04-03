$(document).ready(function() {
	
    $('#list-sort-menu').change(function() {
       var type = $(this).val();
       if (type) location.href = 'http://' + location.host + '/lists?type=' + type;
       else location.href = 'http://' + location.host + '/lists';
	});
    
});