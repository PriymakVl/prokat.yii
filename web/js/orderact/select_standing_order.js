$(document).ready(function() {

    $('#standing-orders').change(function() { 
        var id = $('option:selected', this).val();
        var number = $('option:selected', this).attr('order_num');
        
        $('#orderactform-order_id').val(id);
        $('#orderactform-order_num').val(number);
    });
    
});

