$(document).ready(function() {
    $('.field-orderform-area').change(function() {
        var area_id = $(this).attr('area_id');
        console.log(area_id); return;
        if (area_id) $.get('/order/form/area/equipment', {area_id: area_id}, addSelectEquipment);    
    });    
});

function addSelectEquipment(data)
{
    alert(data);
}