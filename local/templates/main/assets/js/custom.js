BX.ready(function() {
    var deleterequst = new BX.PopupWindow("request-delete", window.body, {
        autoHide: true,
        content: BX('bx-request-delete'),
        closeIcon: {right: "10px", top: "10px", 'props': {'className': 'popup__close'}},
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        closeByEsc: true,
        draggable: {restrict: false},
        overlay: {backgroundColor: 'black', opacity: '1'},  /* затемнение фона */

    });
    BX.ajax.insertToNode('includes/delete-vac.php', BX('bx-request-delete')); // функция ajax-загрузки контента из урла в #div
    BX.bindDelegate(
        document.body, 'click', {className: 'delete-vacancy'},
        BX.proxy(function (e) {
            if (!e)
                e = window.event;
            deleterequst.show(); // появление окна
            return BX.PreventDefault(e);
        }, deleterequst)
    );

    var transferequest = new BX.PopupWindow("request-transfer", window.body, {
        autoHide: true,
        content: BX('bx-request-transfer'),
        closeIcon: {right: "10px", top: "10px", 'props': {'className': 'popup__close'}},
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        closeByEsc: true,
        draggable: {restrict: false},
        overlay: {backgroundColor: 'black', opacity: '1'},  /* затемнение фона */

    });
    BX.ajax.insertToNode('includes/transfer.php', BX('bx-request-transfer')); // функция ajax-загрузки контента из урла в #div
    BX.bindDelegate(
        document.body, 'click', {className: 'request-transfer'},
        BX.proxy(function (e) {
            if (!e)
                e = window.event;
            transferequest.show(); // появление окна
            return BX.PreventDefault(e);
        }, transferequest)
    );
});

$(document).ready(function(){

    var styledNumber = function(){
        $('input.styled[type=number]').each(function(){
            var $this = $(this),
                $parent = $this.parent(),
                timeOut = 0;

            if ( !$parent.hasClass('quantity-input') ) {
                $this.wrap('<div class="quantity-input"></div>');
                $this.after('<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="icon icon-up"></i></div><div class="quantity-button quantity-down"><i class="icon icon-down"></i></div></div>')

                var $spinner = $this.parent(),
                    $btnUp = $spinner.find('.quantity-up'),
                    $btnDown = $spinner.find('.quantity-down'),
                    min = $this.attr('min'),
                    max = $this.attr('max');

                $btnUp.on('mousedown touchstart', function(e) {
                    var oldValue = parseFloat($this.val());
                    if (oldValue >= max) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue + 1;
                    }
                    $spinner.find("input").val(newVal);
                    $spinner.find("input").trigger("change");
                    timeOut = setInterval(function(){
                        var oldValue = parseFloat($this.val());
                        if (oldValue >= max) {
                            var newVal = oldValue;
                        } else {
                            var newVal = oldValue + 1;
                        }
                        $spinner.find("input").val(newVal);
                    }, 150);
                }).on('mouseup mouseleave touchend', function() {
                    clearInterval(timeOut);
                    $spinner.find("input").trigger("change");
                });

                $btnDown.on('mousedown touchstart', function(e) {
                    var oldValue = parseFloat($this.val());
                    if (oldValue <= min) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue - 1;
                    }
                    $spinner.find("input").val(newVal);
                    $spinner.find("input").trigger("change");
                    timeOut = setInterval(function(){
                        var oldValue = parseFloat($this.val());
                        if (oldValue <= min) {
                            var newVal = oldValue;
                        } else {
                            var newVal = oldValue - 1;
                        }
                        $spinner.find("input").val(newVal);
                    }, 150);
                }).on('mouseup mouseleave touchend', function() {
                    clearInterval(timeOut);
                    $spinner.find("input").trigger("change");
                });
            }

        });
    };

    var hiddenBlock = function() {
        $('.hidden-block').each(function(){
            var $this = $(this),
                $parent = $this.parent();

            if ( !$parent.hasClass('hidden-wrap') ) {
                $this.wrap('<div class="hidden-wrap"></div>');

                var $wrap = $this.closest('.hidden-wrap');

                $wrap.append('<div class="hidden-bottom"><a href="#"><span class="hidden-show">Показать</span><span class="hidden-hide">Скрыть</span></a></div>');

                var $button = $wrap.find('.hidden-bottom a');

                $button.on('click', function(e) {
                    e.preventDefault();

                    $this.slideToggle(200, function(){
                        $wrap.toggleClass('hidden-active');
                    })
                });
            }
        });
    };

    var contractForm = function() {

        $('.contract__form').each(function(){
            var $this = $(this),
                $name = $this.find('.contract__form-name a'),
                $content = $this.find('.contract__form-content');

            $name.on('click', function(e){
                e.preventDefault();

                $content.slideToggle();
            });
        });
    };

    var styledFile = function() {
        $('input.styled[type=file]').each(function(i, input){
            var $this = $(this),
                labelVal = $(input).data('label')?$(input).data('label'):"Выберите файл",
                $parent = $this.parent();

            if ( !$parent.hasClass('styled-number') ) {
                $this.wrap('<div class="styled-number"></div>');
                $this.parent().append('<span class="styled-number__desc">'+labelVal+'</span>');
            }

            //<div class="ui-file__btn"><span>Прикрепите портфолио</span><i class="ico ico-add-attachment"></i></div>

            var $parent = $this.parent(),
                $label = $parent.find('.styled-number__desc');

            $(input).on('change', function( e ){
                var fileName = '';
                if( $(this)[0].files && $(this)[0].files.length > 1 ){
                    fileName = ( $(this).data('multiple-caption' ) || '' ).replace( '{count}', $(this)[0].files.length );
                } else{
                    fileName = $(this).val().split( '\\' ).pop();
                }

                if( fileName ){
                    $label.html(fileName);
                } else{
                    $label.html(labelVal);
                }
            }).change();
        });
    };

    var currentPopup = function() {
        $(document).on('click','.show-current-popup', function(e){
            e.preventDefault();

            var href = $(this).attr('href');
            if ( $('.current-popup').is(':visible') ) {
                $('.current-popup').fadeOut();
            }
            $(href).fadeIn();

        });

        $(document).on('click','.close-current-popup', function(e){
            e.preventDefault();

            if ( $('.current-popup').is(':visible') ) {
                $('.current-popup').fadeOut();

                console.log('do submit or something other')
            }

        });

        $(document).on('click', function(e){
            if ( $('.current-popup').is(':visible') ) {

                var $this = $(e.target);

                if ( $this.hasClass('.daterangepicker') ||
                    $this.hasClass('.show-current-popup') ||
                    $this.closest('.show-current-popup').length ||
                    $this.closest('.daterangepicker').length ||
                    $this.closest('.calendar-table').length ||
                    $this.closest('.current-popup').length
                ) {

                } else {
                    $('.current-popup').fadeOut();
                }
            }
        });
    };

    var tableResponcive = function() {
        // adaptive
        $('.table-responsive .table').each(function () {
            var _this = $(this),
                first_td = _this.find('thead tr th');
            if (!first_td.length)
                first_td = _this.find('thead tr td');
            if (first_td.length) {
                var j = 0, name = [];
                _this.find('tbody tr:not(.nomobile) td').each(function (i) {
                    if (j > first_td.length - 1)
                        j = 0;

                    name[j] = first_td[j].textContent != '' ? first_td[j].textContent : first_td[j].dataset.adaptive!=undefined?first_td[j].dataset.adaptive:"";

                    //console.log('td='+first_td[j].textContent, 'data='+first_td[j].dataset.adaptive, 'name='+name[j] );

                    if ( name[j] != "") {
                        $('<div class="th-mobile-new">' + name[j] + '</div>').appendTo($(this));
                        $(this).addClass('mobile-td')
                    }
                    j++;
                })
            }
        })
    };

    var consultant = function() {
        $(document).on('click','.chat__block-button a',function(e){
            e.preventDefault();
            $(this).closest('.chat__block').toggleClass('closed');
        });
        $(document).on('click','.chat__block-close',function(){
            $(this).closest('.chat__block').addClass('closed');
        });
        $(document).on('click',function(e){
            var $this = $(e.target);
            if ( !$this.closest('.chat__block').length ) {
                $('.chat__block').addClass('closed');
            }
        });
    };

    var resumeHelper = function() {
        console.log('resumeHelper');
        $(document).on('change', '.end-data-checkbox', function () {
            if ($(this).prop('checked')) {
                $(this).closest('.form-groups').find('.end-data-container').hide();
            } else {
                $(this).closest('.form-groups').find('.end-data-container').show();
            }
        });
        $(document).on('click', '.add-work-position', function () {
            console.log('add-work-position');
            $.ajax({
                type: "GET",
                url: '/local/ajax/work_position_item.php?counter=' + $(this).data('counter'),
                timeout: 30000,
                error: function(request,error) {
                    if (error == "timeout") {
                        alert('timeout');
                    }
                    else {
                        alert('Error! Please try again!');
                    }
                },
                success: function(data) {
                    $(this).before(data);
                }
            });
            return false;
        });
    };

    currentPopup();
    styledNumber();
    hiddenBlock();
    contractForm();
    styledFile();
    tableResponcive();
    consultant();
    resumeHelper();

});

