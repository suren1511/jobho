$(document).ready( function () {
    $('#politics').change( function () {
        if ($(this).attr('checked')=='checked') $('input[name="OK"]').attr('disabled',false);
        else $('input[name="OK"]').attr('disabled',true);
    });
})