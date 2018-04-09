$(document).ready(function() {
    $('#orderform-groups').change(function() {
        var group_id = $(this).val();
        if (!group_id) {
            $('#orderform-subgroups, #orderform-subgroup-units').html('<option value="">Не выбран</option>').prop('disabled', true);
            return;
        }
        else if (group_id) $.get('/equipment/group/subgroups/get/ajax', {group_id: group_id}, addSubgroups);
    });  
    
    $('#orderform-subgroups').change(function() {
        var sub_id = $(this).val();
        if (!sub_id) {
            $('#orderform-subgroup-units').html('<option value="">Не выбран</option>').prop('disabled', true);
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
        $('#orderform-subgroups, #orderform-subgroup-units').html('<option>Не выбран</option>').prop('disabled', true);
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" name="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#orderform-subgroups').html(html).prop( "disabled", false);
        $('#orderform-subgroup-units').html('<option value="">Не выбран</option>').prop( "disabled", true);
    }    
}

function addUnits(data)
{
    var items, html;
    if (!data) {
        alert('В подгруппе еще нет узлов');
        $('#orderform-subgroup-units').html('<option>Не выбран</option>').prop('disabled', true);
    }
    else {
        items = JSON.parse(data);
        html = '<option value="">Не выбран</option>';
        for (var i = 0; i < items.length; i++) { 
            html += '<option value="' + items[i].id + '" name="' + items[i].name + '">' + items[i].alias + '</option>';
        }
        $('#orderform-subgroup-units').html(html).prop( "disabled", false);
    }    
}