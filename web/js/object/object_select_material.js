$(document).ready(function() {
    $('.object-material').change(function() {
        var material = $(this).find('option:selected').val();
        $('#objectform-material').val(material);    
    }); 
    
     $('.object-analog').change(function() {
        var analog = $(this).find('option:selected').val();
        $('#objectform-analog').val(analog);    
    });  
});