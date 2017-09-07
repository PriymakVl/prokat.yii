$(document).ready(function() {
    $('#orderform-sections').change(function() {
        var section_id = $(this).val(); 
        if (!section_id) {
            $('#section-equipments').html('<option>Не выбран</option>').prop('disabled', true);
            $('#equipment-units').html('<option>Не выбран</option>').prop('disabled', true);
            $('#orderform-equipment').val(''); 
            $('#orderform-unit').val('');
            return;    
        }
        else if (section_id) $.get('/equipment/data/get', {section_id: section_id}, addEquipments);    
    });  
    
    $('#section-equipments').change(function() {
        var equipment_id = $(this).val();
        var name = $('option:selected', this).attr('name_equ');
        $('#orderform-equipment').val(name);
        if (!name) {
            $('#equipment-units').html('<option>Не выбран</option>').prop('disabled', true); 
            $('#orderform-unit').val('');
            return;    
        }
        else if (equipment_id) $.get('/equipment/data/get', {equipment_id: equipment_id}, addUnits);    
    }); 
    
    $('#equipment-units').change(function() {
        var name = $('option:selected', this).attr('name_unit');
        $('#orderform-unit').val(name);     
    }); 
     
});

function addEquipments(data)
{
    var items, html;
    if (data == 'equipments_not') alert('Оборудование участка не указано');
    else {
        items = JSON.parse(data);
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" name_equ="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#section-equipments').append(html).prop( "disabled", false); 
    }    
}

function addUnits(data)
{
    var items, html;
    if (data == 'units_not') alert('Узлы оборудования не указаны');
    else {
        items = JSON.parse(data);
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" name_unit="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#equipment-units').append(html).prop( "disabled", false); 
    }    
}