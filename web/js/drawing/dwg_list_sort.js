$(document).ready(function() {
    
    $('#year-create-dwg').change(function() { 

        var year = $(this).val();
        year = year ? year : 0;
        
        var url = 'http://' + location.host + '/drawing/department/list';
        
        location.href = url + '?year=' + year;
    });
  
})














