$(function () {
  $(document).on('change', 'select[name="PROPERTY[REGION]"]', function () {
    var region = $(this).val();

    $.ajax({
      type: "POST",
      url: '/ajax/locations/loc_edit.php',
      data: {
        REQUEST: 'REGION',
        REGION: region
      },
      success: function (data) {
        $('select[name="PROPERTY[SYTI]"]').html(data);
      }
    });

  });

  $(document).on('focus','.input-group input,.input-group select',function () {
    $(this).parent().find('.error').remove();
    $('.vertical-form .form-bottom .error').remove();
  });
//первый шаг
  $(document).on('submit','#step_one',function (e) {
    var formData = new FormData($('#step_one')[0]);
    var gotovnost=1;
    $('.vertical-form .form-group label.required').each(function () {
      if ($(this).parent().find('select').val() || $(this).parent().find('input').val() || $(this).parent().find('textarea').val()){
        gotovnost=1;
      }
      else{
        gotovnost=false;
        if (!$(this).parent().find('.input-group .error').legend){
          $(this).parent().find('.input-group').append('<div class="error">Поле обязательно для заполнения</div>');
        }
        if (!$('.vertical-form .form-bottom .error').length){
          $('.vertical-form .form-bottom').prepend('<div class="error">Не заполнены обязательные поля формы</div>')
        }
      }
    });
    if (gotovnost) {
      $.ajax({
        url: '/ajax/vakansy/forms.php',
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
          $('.js_block_nev_vac').html(data);
        }
      });
    }
    e.preventDefault();
  });
//второй шаг
  $(document).on('submit','#step_two',function (e) {
    $('input[name="STEP_NAZAD"]').remove();
    var formData = new FormData($('#step_two')[0]);
    var gotovnost=1;
    $('.vertical-form .form-group label.required').each(function () {
      if ($(this).parent().find('select').val() || $(this).parent().find('input').val() || $(this).parent().find('textarea').val()){
        gotovnost=1;
      }
      else{
        gotovnost=false;
        if (!$(this).parent().find('.input-group .error').legend){
          $(this).parent().find('.input-group').append('<div class="error">Поле обязательно для заполнения</div>');
        }
        if (!$('.vertical-form .form-bottom .error').length){
          $('.vertical-form .form-bottom').prepend('<div class="error">Не заполнены обязательные поля формы</div>')
        }
      }
    });
    if (gotovnost) {
      $.ajax({
        url: '/ajax/vakansy/forms.php',
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
          $('.js_block_nev_vac').html(data);
        }
      });
    }
    e.preventDefault();
  });
  //третий шаг
  $(document).on('submit','#step_tree',function (e) {
    e.preventDefault();
    $('input[name="STEP_NAZAD"]').remove();
    $('input[name="STEP"]').val('SUCSS');
    $('input[name="PROPERTY[CHERNOVIK]"]').val('');
    var formData = new FormData($('#step_tree')[0]);
    $.ajax({
      url: '/ajax/vakansy/forms.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        $('.js_block_nev_vac').html('<div class="gotovo">Ваша вакансия добавлена. После одобрения вакансии она станет доступной для просмотра</div>' +
            '<div class="gotovo"><a href="/personal/">Вернуться в кабинет</a> </div>');
/*        setTimeout(function(){
          window.location.href = '/personal/vacancy/';
        }, 2 * 1000);*/
      }
    });
  });

  //предварительный просмотр
  $(document).on('click','.vertical-form .form-bottom a.preview',function (e) {
    e.preventDefault();
    $('input[name="STEP_NAZAD"]').remove();
    $('input[name="STEP"]').val('SUCSS');
    var formData = new FormData($('#step_tree')[0]);
    $.ajax({
      url: '/ajax/vakansy/forms.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        $('.js_block_nev_vac').html(data);
        /*        setTimeout(function(){
                  window.location.href = '/personal/vacancy/';
                }, 2 * 1000);*/
      }
    });
  });
  //назад после предварительного просмотра
$(document).on('click','.js_presv_nazad',function (e) {
e.preventDefault();
  var  idtovar = $(this).parent().data('id');
  $.ajax({
    type: "POST",
    url: '/ajax/vakansy/forms.php',
    data: {
      STEP: 'TWO',
      ID:idtovar

    },
    success: function (data) {

      $('.js_block_nev_vac').html(data);

    }
  });

});
  //возврат на первый шаг
  $(document).on('click','.vertical-form .form-bottom .btn.js_step_one',function (e) {
    $('input[name="STEP"]').remove();
    var formData = new FormData($('#step_two')[0]);
    $.ajax({
      url: '/ajax/vakansy/forms.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        $('.js_block_nev_vac').html(data);
      }
    });
  });
  //возврат на второй шаг
  $(document).on('click','.vertical-form .form-bottom .btn.js_step_two',function (e) {
    $('input[name="STEP"]').remove();
    $('input[name="PRED"]').remove();
    var formData = new FormData($('#step_tree')[0]);
    $.ajax({
      url: '/ajax/vakansy/forms.php',
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        $('.js_block_nev_vac').html(data);
      }
    });
  });
  //публикуем
  $(document).on('click','.js_pablick',function (e) {
    e.preventDefault();
    var  idtovar = $(this).parent().data('id');
    $.ajax({
      type: "POST",
      url: '/ajax/vakansy/forms.php',
      data: {
        PABLICK: 'Y',
        ID:idtovar

      },
      success: function (data) {
        $('.js_block_nev_vac').html('<div class="gotovo">Ваша вакансия добавлена. После одобрения вакансии она станет доступной для просмотра</div>' +
            '<div class="gotovo"><a href="/personal/">Вернуться в кабинет</a> </div>');

      }
    });

  });
});
function clickRegion() {
  var region = $(this).val();

}