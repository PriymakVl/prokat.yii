$(document).ready(function() {
    //add equipment
    $('#add-equipment').click(function() { 
        var area_id, name
		var area_id = $('#orderform-area).val();
	
        if (!area_id) {alert('Вы не выбрали участок'); return;}
		
        name = prompt('Введите назавние агрегата, механизма');
        if (!equipmen_id) {alert('Вы не указали агрегат, механизм'); return;} 
        $.get('http://' + location.host + '/equipment/add', {parent_id: area_id, name: name, type: 'equipment'}, addEquipment);
    });
    
	//add unit
	$('#add-unit').click(function() { 
        var equipmen_id
		var equipmen_id = $('#area-mechanism').val();
	
        if (!equipmen_id) {alert('Вы не выбрали агрегат, механизм'); return;}
		
        name = prompt('Введите назавние узла');
        if (!unit_id) {alert('Вы не указали узел'); return;} 
        
        $.get('http://' + location.host + '/equipment/add', {parent_id: equipment_id, name: name, type: 'unit'}, addUnnt);
    });
});

function addEquipment(data)
{
	if (+data) {
		alert('Агрегат, механизм успешно добавлен');
		location.reload();
	}
	else alert('При добавлении произошла ошибка');
}

function addUnit(data)
{
	if (+data) {
		alert('Узел успешно добавлен');
		location.reload();
	}
	else alert('При добавлении произошла ошибка');
}