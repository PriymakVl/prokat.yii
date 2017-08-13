$(document).ready(function() {
    //type dimensions
    $('#ordercontentform-type_dimensions').change(function() {
            var type = (this.value);
            if (type == 'nut') showNutDimensions();
            else if (type == 'bolt') showBoltDimensions();
            else if (type == 'shaft') showShaftDimensions();
            else if (type == 'bush') showBushDimensions();
            else if (type == 'bar') showBarDimensions();
    });
    
});

function showNutDimensions()
{
    $('#nut-dimensions-wrp').show();
    $('#bolt-dimensions-wrp').hide(); 
    $('#shaft-dimensions-wrp').hide();
    $('#bush-dimensions-wrp').hide();
}

function showBoltDimensions()
{
    $('#nut-dimensions-wrp').hide();
    $('#bolt-dimensions-wrp').show(); 
    $('#shaft-dimensions-wrp').hide();
    $('#bush-dimensions-wrp').hide();
    $('#bar-dimensions-wrp').hide();
}

function showShaftDimensions()
{
    $('#nut-dimensions-wrp').hide();
    $('#bolt-dimensions-wrp').hide(); 
    $('#shaft-dimensions-wrp').show();
    $('#bush-dimensions-wrp').hide();
    $('#bar-dimensions-wrp').hide();
}

function showBarDimensions()
{
    $('#nut-dimensions-wrp').hide();
    $('#bolt-dimensions-wrp').hide(); 
    $('#bar-dimensions-wrp').show();
    $('#shaft-dimensions-wrp').hide();
    $('#bush-dimensions-wrp').hide();
}

function showBushDimensions()
{
    $('#nut-dimensions-wrp').hide();
    $('#bolt-dimensions-wrp').hide(); 
    $('#shaft-dimensions-wrp').hide();
    $('#bar-dimensions-wrp').hide();
    $('#bush-dimensions-wrp').show();
}