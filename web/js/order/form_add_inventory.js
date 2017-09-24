$(document).ready(function() {

    $(':radio[name="inventory"]').click(function() {
        inv_num = $(this).attr('inv_num');
        $('#orderform-inventory').val(inv_num);
    });
    
    $('#inventory-sort').change(function() {
       var sort = $(this).val();
       $(':radio[name="inventory"]').each(function() {
            var category = $(this).attr('category');
            $(this).parent().parent().show();
            if (sort == 'all') $(this).parent().parent().show();
            else if (category != sort) $(this).parent().parent().hide();
       })
	});
    
});