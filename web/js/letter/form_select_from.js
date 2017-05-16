$(document).ready(function() {
     var index_from = 1;
    $('#letter-from-select').change(function() {
        var name = $('#letter-from-select option:selected').val();
        var position = $('#letter-from-select option:selected').text(); 

        $('#letter-from-wrp').append('<label class="label-from-position">должность:</label><input type="text" class="from-position" id="from_position_' + index_from + '" name="LetterForm[from_position_' + index_from + ']">');
        $('#letter-from-wrp').append('<label class="label-from-name">имя:</label><input class="from-name" type="text" id="from_name_' + index_from + '" name="LetterForm[from_name_' + index_from + ']"><br><br>');
        $('#from_position_'+index_from).val(position);
        $('#from_name_' + index_from).val(name);
        index_from++;
    });    
});