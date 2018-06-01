$(document).ready(function () {
    $('#change-dwg-object').click(function (event) {
        event.preventDefault();
        var name_column = $(this).text();
        if (name_column == 'Чертеж') {
            $(this).text('Код');
            $('.drawing-wrp').fadeOut();
            $('.object-wrp').fadeIn();
        }
        else {
            $(this).text('Чертеж');
            $('.object-wrp').fadeOut();
            $('.drawing-wrp').fadeIn();
        }
    })
})