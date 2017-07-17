$(document).ready(function() {

    $('#mech-issuer').change(function() {
        var issuer = $(this).find('option:selected').val();
        $('#orderform-issuer').val(issuer);    
    }); 
	
	$('#mech-customer').change(function() {
        var customer = $(this).find('option:selected').val();
        $('#orderform-customer').val(customer);    
    }); 
	
});