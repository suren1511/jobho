$(document).ready( function () {
    var form = $('#popupcontact');

    // form.find('input[name="form_text_331"]').attr('placeholder','Имя *');
    $('input[name="form_text_332"]').attr('placeholder','+7(___) ___-__-__');
    //$('input[name="form_text_332"]').mask("+7(999) 999-99-99");

    $('#order_pit').click( function () {
        var itogo = $('#all_stoim').html();
        $('#itogo').html(itogo+' руб');
    });

    form.find('a.close').click( function () {
        $('#popupcontact_wrap').hide();
        form.fadeOut();
    })

    form.find('#red_link').click( function () {
        $('#popupcontact_wrap').hide();
        form.fadeOut();
    })

    /*form.find('.web_form_submit').click( function (e) {
        e.preventDefault();

        var name = form.find('input[name="form_text_331"]').val().length;
        var tel = form.find('input[name="form_text_332"]').val().length;

        var err_mess = $('#errors_text');

        if (name<3 || tel<17) {
            if (name<3) {
                err_mess.html( 'Не заполнено обязательное поле "Имя"' );
            }
            return false;
        }
        else return true;
    })*/
})