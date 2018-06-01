$(document).ready(function() {

    $('#ordercontentform-type_dwg').click(function() { 
        
        if(document.getElementById('ordercontentform-type_dwg').checked) {
            $('.field-ordercontentform-file').show();
            $('.field-ordercontentform-filename').hide();
            var number = $(this).attr('department_number');
            category = $('#ordercontentform-cat_dwg').val();
            if (category == 'department') {
                alert ('Номер нового эскиза: ' + number);
                $('#ordercontentform-drawing').val(number);
            }
        }
        else {
            $('.field-ordercontentform-file').hide();
            $('.field-ordercontentform-filename').show();    
        }
    });
    
});

