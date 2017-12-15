$(document).ready(function() {
    $('#orderform-sections').change(function() {
        var section_id = $(this).val(); 
        if (!section_id) {
            $('#section-equipments').html('<option value="">Не выбран</option>').prop('disabled', true);
            $('#equipment-units').html('<option value="">Не выбран</option>').prop('disabled', true);
            $('#orderform-equipment, #orderform-equipment_blank').val('');  
            $('#orderform-unit, #orderform-unit_blank').val('');
            $('#orderform-inventory').val('');
            return;    
        }
        else if (section_id) $.get('/equipment/data/get', {section_id: section_id}, addEquipments);    
    });  
    
    $('#section-equipments').change(function() {
        var equipment_id = $(this).val();
        var name = $('option:selected', this).attr('name_equ');
        var inventory = $('option:selected', this).attr('inventory');
        
        if (!name || !equipment_id) {
            $('#equipment-units').html('<option value="">Не выбран</option>').prop('disabled', true); 
            $('#orderform-unit, #orderform-unit_blank, #orderform-inventory').val('');
            return;    
        }
        else {
            $('#orderform-equipment, #orderform-equipment_blank').val(name);
            if (inventory != 'null') $('#orderform-inventory').val(inventory);
            $.get('/equipment/data/get', {equipment_id: equipment_id}, addUnits);    
        }     
    }); 
    
    $('#equipment-units').change(function() {
        var name = $('option:selected', this).attr('name_unit');
        $('#orderform-unit, #orderform-unit_blank').val(name);     
    }); 
     
});

function addEquipments(data)
{
    var items, html;
    if (data == 'equipments_not') {
        alert('Оборудование участка не указано');
        $('#section-equipments, #equipment-units').html('<option>Не выбран</option>').prop('disabled', true); 
        $('#orderform-equipment, #orderform-unit, #orderform-inventory').val('');
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" inventory="' + items[i].inventory + '" name_equ="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#section-equipments').html(html).prop( "disabled", false); 
        $('#equipment-units').html('<option value="">Не выбран</option>').prop( "disabled", true);
    }    
}

function addUnits(data)
{
    var items, html;
    if (data == 'units_not') {
        alert('Узлы оборудования не указаны');
        $('#equipment-units').html('<option>Не выбран</option>').prop('disabled', true);    
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" name_unit="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#equipment-units').html(html).prop( "disabled", false); 
    }    
}