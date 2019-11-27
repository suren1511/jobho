$(document).ready(function () {
	// Вызов функции прижатия футера к низу экрана
	footerBind('.js-main','.js-header,.js-footer');
	$(window).on('resize',function(){footerBind('.js-main','.js-header,.js-footer')});

	// Слайдер на главной
	if ($('#mycarousel-for-main').length) {
		$("#mycarousel-for-main").slick({
			dots: false,
			slidesToShow: 4,
			autoplay: !0,
			responsive: [{
				breakpoint: 1011,
				settings: {
					slidesToShow: 3,
				}
			}, {
				breakpoint: 746,
				settings: {
					slidesToShow: 2,
				}
			}, {
				breakpoint: 425,
				settings: {
					slidesToShow: 1,
				}
			}]
		})
	}

		// Слайдер на детальной, 3 колонки
	if ($('#mycarousel-for-detail').length) {
		$("#mycarousel-for-detail").slick({
			dots: false,
			slidesToShow: 3,
			autoplay: !0,
			responsive: [{
				breakpoint: 1011,
				settings: {
					slidesToShow: 2,
				}
			}, {
				breakpoint: 746,
				settings: {
					slidesToShow: 1,
				}
			}]
		})
	}

	// Галерея картинок на детальной странице
	if ($('.js-detail-slider').length) {
		$(".js-detail-slider").slick({
			dots: !0,
			slidesToShow: 4,
			autoplay: !0,
			responsive: [{
			breakpoint: 750,
			settings: {
					slidesToShow: 3,
					dots: !0
				}
			}, {
				breakpoint: 500,
				settings: {
					slidesToShow: 2,
					dots: !0
				}
			}, {
				breakpoint: 400,
				settings: {
					slidesToShow: 1,
					dots: !0
				}
			}]
		})
	}

	// Слайдер 2 колонки
	if ($('.js-h-carousel').length) {
		$('.js-h-carousel').slick({
			slidesToShow: 2,
			autoplay: true,
			autoplaySpeed: 4000,
			responsive: [

				{
					breakpoint:500,
					settings: {
						slidesToShow: 1
					}
				}
			]
		})
	}
	

	//Блок с аккордионом
	$(".js-accord-question").on("click", function() {
		var e = $(this).closest(".js-accord-item");
		if (e.hasClass("open")) return e.removeClass("open").find(".js-accord-answer").slideUp(), !1;
		$(".js-accord-item").removeClass("open").find(".js-accord-answer").slideUp(), e.addClass("open").find(".js-accord-answer").slideDown()
	})

	// Переключение вида отображения список/плитка
	window.innerWidth < 1010 && ($(".side-menu").append($(".leftmenu")), $(".side-menu").append($(".btn.btn_red.no-livequery"))), window.innerWidth < 750 ? ($(".dormitory").removeClass("list").addClass("tiles"), $(".change").removeClass("active"), $(".change.tile").addClass("active")) : $(".dormitory").removeClass("tiles").addClass("list"), window.innerWidth < 500 && $(".tab_list .act").after($(".dormitory-filter .form")), $(document).on("click", ".change.tile", function() {
		$(".dormitory").removeClass("list").addClass("tiles")
	}), $(document).on("click", ".change.list", function() {
		$(".dormitory").removeClass("tiles").addClass("list")
	}), 
	$(window).resize(function() {
		window.innerWidth < 1010 ? ($('.side-menu .leftmenu').length > 0 ? '' : ($(".side-menu").append($(".leftmenu")), $(".side-menu").append($(".btn.btn_red.no-livequery")))) : ($(".offers").prepend($(".btn.btn_red.no-livequery")), $(".left").prepend($(".leftmenu"))), window.innerWidth < 750 && ($(".dormitory").removeClass("list").addClass("tiles"), $(".change").removeClass("active"), $(".change.tile").addClass("active")), window.innerWidth < 500 ? $(".tab_list .act").after($(".dormitory-filter .form")) : $(".tab_list").after($(".dormitory-filter .form"))
	})

	// Навигация по левому меню
	$(".js-left-menu-arr").on("click", function(e) {
		e.preventDefault();
		if ($(this).parents('.js-left-menu-item').hasClass("opened")) {
			$(this).parents('.js-left-menu-item').removeClass('opened');
		} else {
			$('.js-left-menu-item').removeClass('opened');
			$(this).parents('.js-left-menu-item').addClass('opened');
		}
	}),

	 $("#form_checkbox_formaobsl_225").click(function() {
		$(".org_naz").css("display", "none")
	}), $("#form_checkbox_formaobsl_226").click(function() {
		$(".org_naz").css("display", "table-row")
	}), $("#form_checkbox_formaobsl_227").click(function() {
		$(".org_naz").css("display", "table-row")
	}), $(".vote-form input").click(function() {
		$(".vote-form").submit()
	}), $(".metro a").click(function() {
		$("#l_metrostations").fadeIn()
	}), $(".napr a").click(function() {
		$("#l_directions").fadeIn()
	}), $(".depth_lev1:last").addClass("no_bor"), $("#ulica").keyup(function() {
		a = jQuery(this).val().length, 1 < a && (word = jQuery(this).val(), console.log(word), $.ajax({
			type: "POST",
			url: "/ajax.php",
			data: "type=ulica&word=" + word,
			success: function(a) {
				$(".ajax_ulica").html(a), 0 < a.length ? $(".ajax_ulica").fadeIn(100) : $(".ajax_ulica").fadeOut(100)
			}
		}))
	}), $("#ulica_spb").keyup(function() {
		a = jQuery(this).val().length, 1 < a && (word = jQuery(this).val(), console.log(word), $.ajax({
			type: "POST",
			url: "/ajax_spb.php",
			data: "type=ulica&word=" + word,
			success: function(a) {
				$(".ajax_ulica").html(a), 0 < a.length ? $(".ajax_ulica").fadeIn(100) : $(".ajax_ulica").fadeOut(100)
			}
		}))
	}), $(".ajax_ulica .prop").live("click", function() {
		$("#ulica").val($(this).text()), $(".ajax_ulica").fadeOut(100)
	}), $(".ajax_ulica .prop").live("click", function() {
		$("#ulica_spb").val($(this).text()), $(".ajax_ulica").fadeOut(100)
	}), $(".ajax_locality .prop").live("click", function() {
		$("#locality").val($(this).text()), $(".ajax_locality").fadeOut(100)
	})
	// $(".metro-choose .map").click(function() {
	// 	console.log("asdf");
	// if ($("#YMapsID").length == 0) {
	// 	$(".bx-yandex-view-layout").show();
	// 	$.ajax({
	// 		url: "/ajax/view-map.php",
	// 		success: function(data) {
	// 			$('.bx-yandex-view-map').html(data);
	// 		},
	// 		error: function (data) {
 //    			console.log('Error', data);
	// 		}
	// 	}) 
	// } else {
	// 	$(".bx-yandex-view-layout").slideToggle();
	// };
	// })

	// Мобильное меню
	$(".js-menu-open").on("click", function() {
		$(this).addClass('active');
		$('.js-left-mobile-menu').addClass('open');
		$('.js-menu-close').addClass('active');
	})

	$(".js-menu-close").on("click", function() {
		$(this).removeClass('active');
		$('.js-left-mobile-menu').removeClass('open');
		$('.js-menu-open').removeClass('active');
	})


});

// Прижимаем футер к низу экрана
function footerBind(selectContent,listSelects){
	var windowHeight = $(window).height();
	$(listSelects).each(function(){windowHeight-=$(this).outerHeight(true);});
	if(windowHeight>0){
		$(selectContent).css({'min-height': windowHeight});
	};

	var leftMenuHeight = $('.js-left-block').outerHeight(true);
	var contentHeight = $(selectContent).outerHeight();

	if (contentHeight < leftMenuHeight) {
		var newContentHeight = leftMenuHeight + parseInt($(selectContent).css("padding-top")) + parseInt($(selectContent).css("padding-bottom"));
		$(selectContent).css({'min-height': newContentHeight});
	};
}

BX.ready(function(){
	var get_url = document.location.pathname;
    var callrequest = new BX.PopupWindow("request-call", window.body, {
	  autoHide : true,
	  content: BX('bx-request-call-phone'),
	  closeIcon: {right: "20px", top: "10px", 'props': {'className': 'popup__close'}},
	  titleBar: {content: BX.create("span", {html: 'Напишите время, удобное для звонка', 'props': {'className': 'popup__title'}})},
	  zIndex: 0,
	  offsetLeft: 0,
	  offsetTop: 0,
	  closeByEsc : true,
	  draggable: {restrict: false},
	  overlay: {backgroundColor: 'black', opacity: '1' },  /* затемнение фона */
	 
   });
   BX.ajax.insertToNode('/includes/request_call_back.php?page_u='+get_url, BX('bx-request-call-phone')); // функция ajax-загрузки контента из урла в #div
   BX.bindDelegate(
	  document.body, 'click', {className: 'request-call-phone' },
		 BX.proxy(function(e){
			if(!e)
			   e = window.event;
			callrequest.show(); // появление окна
			return BX.PreventDefault(e);
		 }, callrequest)
   );

    var dobobrequest = new BX.PopupWindow("request-call", window.body, {
	  autoHide : true,
	  content: BX('bx-dobob'),
	  closeIcon: {right: "20px", top: "10px", 'props': {'className': 'popup__close'}},
	  titleBar: {content: BX.create("span", {html: 'Добавление общежития', 'props': {'className': 'popup__title'}})},
	  zIndex: 0,
	  offsetLeft: 0,
	  offsetTop: 0,
	  closeByEsc : true,
	  draggable: {restrict: false},
	  overlay: {backgroundColor: 'black', opacity: '1' },  /* затемнение фона */
	 
   });
   BX.ajax.insertToNode('/includes/dobob.php', BX('bx-dobob')); // функция ajax-загрузки контента из урла в #div
   BX.bindDelegate(
	  document.body, 'click', {className: 'dobob' },
		 BX.proxy(function(e){
			if(!e)
			   e = window.event;

            $(".js-left-mobile-menu").removeClass("open");
            $(".js-menu-open").removeClass("active");

			dobobrequest.show(); // появление окна
			return BX.PreventDefault(e);
		 }, dobobrequest)
   );

    var openlogin = new BX.PopupWindow("open-login", window.body, {
        autoHide : true,
        content: BX('bx-open-login'),
        closeIcon: {right: "20px", top: "10px", 'props': {'className': 'popup__close'}},
        titleBar: {content: BX.create("span", {html: 'Авторизация', 'props': {'className': 'popup__title'}})},
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        closeByEsc : true,
        draggable: {restrict: false},
        overlay: {backgroundColor: 'black', opacity: '1' },  /* затемнение фона */
    });
    BX.ajax.insertToNode('/includes/auth.php', BX('bx-open-login')); // функция ajax-загрузки контента из урла в #div
    BX.bindDelegate(
        document.body, 'click', {className: 'open-login' },
        BX.proxy(function(e){
            if(!e)
                e = window.event;
            openlogin.show(); // появление окна
            return BX.PreventDefault(e);
        }, openlogin)
    );

//кнопка вверх
var scrolltotop={
	setting: {startline:100, scrollto: 0, scrollduration:1000, fadeduration:[500, 100]},
	controlHTML: '<img src="/local/templates/main/img/arrow.png" />',
	anchorkeyword: '#top',
	state: {isvisible:false, shouldvisible:false},
	scrollup:function(){
		if (!this.cssfixedsupport)
			this.$control.css({opacity:0}) 
		var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto)
		if (typeof dest=="string" && jQuery('#'+dest).length==1)
			dest=jQuery('#'+dest).offset().top
		else
			dest=0
		this.$body.animate({scrollTop: dest}, this.setting.scrollduration);
	},
	togglecontrol:function(){
		var scrolltop=jQuery(window).scrollTop()
		if (!this.cssfixedsupport)
			this.keepfixed()
		this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false
		if (this.state.shouldvisible && !this.state.isvisible){
			this.$control.stop().animate({opacity:1}, this.setting.fadeduration[0])
			this.state.isvisible=true
		}
		else if (this.state.shouldvisible==false && this.state.isvisible){
			this.$control.stop().animate({opacity:0}, this.setting.fadeduration[1])
			this.state.isvisible=false
		}
	},
	init:function(){
		jQuery(document).ready(function($){
			var mainobj=scrolltotop
			var iebrws=document.all
			if($(document).width() > 763) {
			mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest
			mainobj.$body=(window.opera)? (document.compatMode=="CSS1Compat"? $('html') : $('body')) : $('html,body')
			mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+'</div>')
				.css({position:mainobj.cssfixedsupport? 'fixed' : 'absolute', bottom:'55px', left:'50px', width:'56px', height:'56px', opacity:0, cursor:'pointer'})
				.click(function(){mainobj.scrollup(); return false})
				.appendTo('body')
			if (document.all && !window.XMLHttpRequest && mainobj.$control.text()!='')
				mainobj.$control.css({width:mainobj.$control.width()})
			mainobj.togglecontrol()
			$('a[href="' + mainobj.anchorkeyword +'"]').click(function(){
				mainobj.scrollup()
				return false
			})
			$(window).bind('scroll resize', function(e){
				mainobj.togglecontrol()
			})
			}
		})
	}
}
scrolltotop.init();

    $(".js-left-mobile-menu").removeClass("open");


});


