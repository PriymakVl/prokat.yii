$(document).ready(function() {
     var index_copy = 1;
    $('#letter-whom-select').change(function() {
        var name = $('#letter-whom-select option:selected').val();
        var position = $('#letter-whom-select option:selected').text(); 
        var type = $('#letter-whom-wrp :radio:checked').val();
        if (type == 'whom') {
             $('#letterform-whom_position').val(position);
             $('#letterform-whom_name').val(name);       
        }
        else {
            $('#letter-whom-wrp').append('<label class="label-copy-position">копия должность:</label><input type="text" class="copy-position" id="copy_position_' + index_copy + '" name="LetterForm[copy_position_' + index_copy + ']">');
            $('#letter-whom-wrp').append('<label class="label-copy-name">копия имя:</label><input class="copy-name" type="text" id="copy_name_' + index_copy + '" name="LetterForm[copy_name_' + index_copy + ']"><br><br>');
            $('#copy_position_'+index_copy).val(position);
            $('#copy_name_' + index_copy).val(name);
            index_copy++;
        }
    });    
});