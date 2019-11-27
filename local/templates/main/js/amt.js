$(function () {
    $(document).on('click','.js_odobrit',function (e) {
        e.preventDefault();
        var tut = $(this);
        var  idtovar = $(this).parents('.vacancy__item-bottom').data('id');
        console.log(idtovar);
        $.ajax({
            type: "POST",
            url: '/ajax/vakansy/forms.php',
            data: {
                ODOBRIT: 'Y',
                ID:idtovar

            },
            success: function (data) {
                tut.parents('.vacancy__item-bottom').find('.vacancy__item-status .red').html('Одобрено');
            }
        });

    });
    $(document).on('click','.js_otclon',function (e) {
        e.preventDefault();
        var tut = $(this).parents('.formotkl');
        var forma = $(this).parents('.formotkl').data('form');
        var formData = new FormData($('#'+forma)[0]);
        $.ajax({
            url: '/ajax/vakansy/forms.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType:'json',
            type: 'POST',
            success: function (data) {
                $('.close-current-popup').click();
                tut.parents('.vacancy__item-bottom').find('.vacancy__item-status').html(data.MESS);
            }
        });

    });




});