<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="conts">
	<div class="zag">
		<div class="zag__item zag__item_blue">Код вакансии: <?=$arResult["PROPERTIES"]["kod"]["VALUE"]?></div>
		<div class="zag__item zag__item_right">Зарплата после испытательного срока
			<?php if ($arResult["PROPERTIES"]["zp_dp"]["VALUE"] != "" && $arResult["PROPERTIES"]["zp_posle"]["VALUE"] != "" && $arResult["PROPERTIES"]["zp_dp"]["VALUE"] != $arResult["PROPERTIES"]["zp_posle"]["VALUE"]):?>
				<div class="price_elem">
					<?=$arResult["PROPERTIES"]["zp_dp"]["VALUE"]?> - <?=$arResult["PROPERTIES"]["zp_posle"]["VALUE"]?> руб.
				</div>
			<?elseif ($arResult["PROPERTIES"]["zp_dp"]["VALUE"] != "" && $arResult["PROPERTIES"]["zp_posle"]["VALUE"] != "" && $arResult["PROPERTIES"]["zp_dp"]["VALUE"] == $arResult["PROPERTIES"]["zp_posle"]["VALUE"]) :?>
				<div class="price_elem"><?=$arResult["PROPERTIES"]["zp_dp"]["VALUE"]?> руб.</div>
			<?elseif ($arResult["PROPERTIES"]["zp_dp"]["VALUE"] != "") :?>
				от <div class="price_elem"><?=$arResult["PROPERTIES"]["zp_dp"]["VALUE"]?> руб.</div>
			<?elseif ($arResult["PROPERTIES"]["zp_posle"]["VALUE"] != ""):?>
				до <div class="price_elem"><?=$arResult["PROPERTIES"]["zp_posle"]["VALUE"]?> руб.</div>
			<?endif;?>
		</div>
	</div>
<div class="telo_bl" style="position: relative;">
	<div class="zag_telo">Прочие требования:</div>
	<div style="text-indent: 0px;margin:0 25px; line-height:1.4;">
		<?=$arResult["PROPERTIES"]["proch"]["~VALUE"]["TEXT"]?>
	</div>
</div>
<br />
<div class="telo_bl">
	<div class="zag_telo">Обязанности:</div>
	<div style="text-indent: 0px;margin:0 25px;line-height:1.4;">
		<?=$arResult["PROPERTIES"]["obz"]["~VALUE"]["TEXT"]?>
	</div>
</div>
<br />
<?if($arResult["PROPERTIES"]["if"]["~VALUE"]["TEXT"] != ""){?>
<div class="telo_bl">
	<div class="zag_telo">Условия:</div>
	<div style="text-indent: 0px;margin:0 25px;line-height:1.4;">
		<?=$arResult["PROPERTIES"]["if"]["~VALUE"]["TEXT"]?> 
	</div>
</div>

<?}?>

</div>
<span class="vact-btn-wrap">
<a href="<?=$arResult['SECTION']['SECTION_PAGE_URL']?>">« Вернуться к списку</a>
<a href="javascript:void(0);" class="btn btn--blue resume">Заполнить анкету</a>
</span>
<script>
	BX.ready(function(){
	var callrequest = new BX.PopupWindow("request_hostel", window.body, {
	  autoHide : true,
	  content: BX('bx-book-hostel'),
	  closeIcon: {right: "20px", top: "10px", 'props': {'className': 'popup__close'}},
	  titleBar: {content: BX.create("span", {html: 'Отправить резюме', 'props': {'className': 'popup__title'}})},
	  zIndex: 0,
	  offsetLeft: 0,
	  offsetTop: 0,
	  closeByEsc : true,
	  draggable: {restrict: false},
	  overlay: {backgroundColor: 'black', opacity: '1' },  /* затемнение фона */
	 
	});
	BX.ajax.insertToNode('/includes/resume.php', BX('bx-book-hostel')); // функция ajax-загрузки контента из урла в #div
	BX.bindDelegate(
	  document.body, 'click', {className: 'resume' },
	     BX.proxy(function(e){
	        if(!e)
	           e = window.event;
	       	callrequest.show(); // появление окна
	        return BX.PreventDefault(e);
	     }, callrequest)
	);
});
</script>