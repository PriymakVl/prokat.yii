$(document).ready(function() {
	
    $('#obj-list-sort').change(function() {
       var sort = $(this).val();
       var obj_id = $('#parent-id').val();
       if (sort) location.href = 'http://' + location.host + '/object/specification?obj_id=' + obj_id + '&sort=' + sort;
       else location.href = 'http://' + location.host + '/object/specification?obj_id=' + obj_id;
	});
    
});