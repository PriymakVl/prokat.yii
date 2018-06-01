$(document).ready(function() {
    $('#groups').change(function() {
        var group_id = $(this).val();
        if (!group_id) {
            $('#subgroups, #units-subgroup').html('<option value="">Не выбран</option>').prop('disabled', true);
            return;
        }
        else if (group_id) $.get('/equipment/group/subgroups/get/ajax', {group_id: group_id}, addSubgroups);
    });  
    
    $('#subgroups').change(function() {
        var sub_id = $(this).val();
        if (!sub_id) {
            $('#units-subgroup').html('<option value="">Не выбран</option>').prop('disabled', true);
        }
        else {
            $.get('/equipment/group/subgroupunits/get/ajax', {subgroup_id: sub_id}, addUnits);
        }     
    });
     
});

function addSubgroups(data)
{
    var items, html;
    if (!data) {
        alert('В группе еще нет подгрупп');
        $('#subgroups, #units-subgroup').html('<option>Не выбран</option>').prop('disabled', true);
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" name="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#subgroups').html(html).prop( "disabled", false);
        $('#units-subgroup').html('<option value="">Не выбран</option>').prop( "disabled", true);
    }    
}

function addUnits(data)
{
    var items, html;
    if (!data) {
        alert('В подгруппе еще нет узлов');
        $('#units-subgroup').html('<option>Не выбран</option>').prop('disabled', true);
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" name="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#units-subgroup').html(html).prop( "disabled", false);
    }    
}