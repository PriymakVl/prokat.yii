$(document).ready(function() {
    $('#orderform-sections').change(function() {
        var section_id = $(this).val();
        if (!section_id) {
            $('#section-equipments').html('<option value="">Не выбран</option>').prop('disabled', true);
            $('#equipment-units').html('<option value="">Не выбран</option>').prop('disabled', true);
            //$('#orderform-equipment_blank').val('');
            //$('#orderform-unit_blank').val('');
            $('#orderform-inventory').val('');
            return;    
        }
        else $.get('/equipment/equipments/get/ajax', {section_id: section_id}, setEquipments);
    });  
    
    $('#section-equipments').change(function() {
        var equipment_id = $(this).val();
        var inventory = $('option:selected', this).attr('inventory');
        
        if (!equipment_id) {
            $('#equipment-units').html('<option value="">Не выбран</option>').prop('disabled', true); 
            $('#orderform-inventory').val('');
            return;    
        }
        else {
            //$('#orderform-equipment_blank').val(name);
            if (inventory != 'null') $('#orderform-inventory').val(inventory);
            $.get('/equipment/unitsequipment/get/ajax', {equipment_id: equipment_id}, setUnits);
        }     
    });
     
});

function setEquipments(data)
{
    var items, html;
    if (!data) {
        alert('Оборудование участка не указано');
        $('#section-equipments, #equipment-units').html('<option>Не выбран</option>').prop('disabled', true); 
        $('#orderform-inventory').val('');
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) {
            html += '<option value="' + items[i].id + '" inventory="' + items[i].inventory + '">' + (items[i].alias ? items[i].alias : items[i].name) + '</option>';
        }
        $('#section-equipments').html(html).prop( "disabled", false); 
        $('#equipment-units').html('<option value="">Не выбран</option>').prop( "disabled", true);
    }    
}

function setUnits(data)
{
    var items, html;
    if (!data) {
        alert('Узлы оборудования не указаны');
        $('#equipment-units').html('<option>Не выбран</option>').prop('disabled', true);    
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) {
            html += '<option value="' + items[i].id + '">' + (items[i].alias ? items[i].alias : items[i].name) + '</option>';
        }
        $('#equipment-units').html(html).prop( "disabled", false); 
    }    
}