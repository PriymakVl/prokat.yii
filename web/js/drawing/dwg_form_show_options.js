$(document).ready(function() {

    $('#objectdrawingform-category, #objectform-categorydwg').change(function() {
        var category = $(this).val();
        
        if (category == 'department') {
            $('#dwg-department-options-wrp').show();
            $('#dwg-works-options-wrp, #dwg-danieli-options-wrp, #dwg-standard-danieli-options-wrp').hide();
        }
        else if (category == 'works') {
            $('#dwg-works-options-wrp').show();
            $('#dwg-department-options-wrp, #dwg-danieli-options-wrp, #dwg-standard-danieli-options-wrp').hide();    
        }
        else if (category == 'danieli') {
            $('#dwg-danieli-options-wrp').show();
            $('#dwg-department-options-wrp, #dwg-works-options-wrp, #dwg-standard-danieli-options-wrp').hide();    
        }
        else if (category == 'standard_danieli') {
            $('#dwg-standard-danieli-options-wrp').show();
            $('#dwg-department-options-wrp, #dwg-works-options-wrp, #dwg-danieli-options-wrp').hide();    
        }
        else {
            $('#dwg-department-options-wrp, #dwg-works-options-wrp, #dwg-danieli-options-wrp, #dwg-standard-danieli-options-wrp').hide();   
        }
        
            
    });
    
    
});