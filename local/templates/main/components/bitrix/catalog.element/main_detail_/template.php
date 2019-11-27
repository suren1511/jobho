<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
?>
<?
$APPLICATION->AddChainItem($arResult["BREADCRUMB"]["NAME"], $arResult["BREADCRUMB"]["URL"]);
if ($arResult["DISPLAY_PROPERTIES"]["mskokruga"]["DISPLAY_VALUE"])
	$APPLICATION->AddChainItem($arResult["DISPLAY_PROPERTIES"]["mskokruga"]["DISPLAY_VALUE"], "/".$arResult["DISPLAY_PROPERTIES"]["mskokruga"]["VALUE_XML_ID"][0]."/");

if ($arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"]) {
	$APPLICATION->AddChainItem($arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"], $arResult["BREADCRUMB"]["URL"].$arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["VALUE_XML_ID"][0]."/");
}
else
	if ($arResult["IBLOCK_ID"] == 4){
		$APPLICATION->AddChainItem($arResult["NAME"]);
	}
	elseif($arResult["IBLOCK_ID"] == 3)
	{
		if ($arResult["DISPLAY_PROPERTIES"]["mskokruga"]["DISPLAY_VALUE"]) {
			$APPLICATION->AddChainItem($arResult["DISPLAY_PROPERTIES"]["metro"]["DISPLAY_VALUE"], "/metro_".$arResult["DISPLAY_PROPERTIES"]["metro"]["VALUE_XML_ID"][0]."/");
		}
	}
?>

<?
$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$actualItem = $arResult;
$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;

$labelPositionClass = 'product-item-label-big';
?>

<?

?>


<div class="item-card">
	<div class="item-card__left">
		<div class="bx-catalog-element" id="<?=$itemIds['ID']?>">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="product-item-detail-slider-container" id="<?=$itemIds['BIG_SLIDER_ID']?>">
							<span class="product-item-detail-slider-close" data-entity="close-popup"></span>
							<div class="product-item-detail-slider-block
								<?=($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '')?>"
								data-entity="images-slider-block">
								<span class="product-item-detail-slider-left" data-entity="slider-control-left" style="display: none;"></span>
								<span class="product-item-detail-slider-right" data-entity="slider-control-right" style="display: none;"></span>
								<div class="product-item-label-text <?=$labelPositionClass?>"
									<?=(!$arResult['LABEL'] ? 'style="display: none;"' : '' )?>>
									<?
									if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE']))
									{
										foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value)
										{?>
											<div<?=(!isset($arParams['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
												<span title="<?=$value?>"><?=$value?></span>
											</div>
										<?}
									} ?>
								</div>
								<div class="product-item-detail-slider-images-container" data-entity="images-container">
									
									<?
									if($arParams["SHOW_PREVIEW_PICTURE"] == "Y" && $arResult["PREVIEW_PICTURE"] && empty($arResult["DETAIL_PICTURE"]) && empty($arResult["PROPERTIES"]["DOP_FOTO"]["VALUE"])) { ?>
										<div class="product-item-detail-slider-image one" data-entity="image" data-id="<?=$arResult["PREVIEW_PICTURE"]["ID"]?>">
													<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>">
												</div>
									<? }
									else {
										if (!empty($actualItem['MORE_PHOTO']))
										{
											foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
											{ ?>
												<div class="product-item-detail-slider-image<?=($key == 0 ? ' active' : '')?>" data-entity="image" data-id="<?=$photo['ID']?>">
													<img src="<?=$photo['SRC']?>" alt="<?=$alt?>" title="<?=$title?>">
												</div>
												<?}
										}
									}
									if ($arParams['SLIDER_PROGRESS'] === 'Y')
									{ ?>
										<div class="product-item-detail-slider-progress-bar" data-entity="slider-progress-bar" style="width: 0;"></div>
									<?}?>
								</div>
							</div>
							<?
							if ($showSliderControls)
							{ ?>
								<div class="product-item-detail-slider-controls-block js-detail-min-slider" id="<?=$itemIds['SLIDER_CONT_ID']?>">
									<?
									if (!empty($actualItem['MORE_PHOTO']))
									{
										foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
										{ ?>
											<div class="product-item-detail-slider-controls-image<?=($key == 0 ? ' active' : '')?>"
												data-entity="slider-control" data-value="<?=$photo['ID']?>" style="background-image: url(<?=$photo['SRC']?>);">
												
											</div>
										<?}
									}?>
								</div>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="item-card__right">
		<div class="item-card__price">
			<span class="item-card__price-num"><?=$arResult["NAME"]?></span> 
			<? foreach ($arResult["PRICES"] as $code => $arPrice): ?>
				<? if ($arPrice["CAN_ACCESS"]): ?>
					<? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
						<?= $arPrice["PRINT_VALUE"] ?> <span
						class="item-card__price-num"> от <?= $arPrice["DISCOUNT_VALUE_VAT"] ?> руб</span>
					<? else: ?><span class="item-card__price-num right"> от <?= $arPrice["VALUE_VAT"] ?> руб</span><? endif; ?>

				<? endif; ?>
			<? endforeach; ?>
		</div>
		<div class="item-card__charact">

			<?if ($arResult['IBLOCK_ID']==4) {
				$city = GetMessage('CITY');
				$name = GetMessage('CITY_SPB');
				$massivkluchey = array("rayonspb", "ulica", "metro", "vetkimetro");
			}
			elseif ($arResult['IBLOCK_ID']==3) {
				if ($arResult["DISPLAY_PROPERTIES"]["mskokruga"]) {
					$city = GetMessage('CITY');
					$name = GetMessage('CITY_MSK');
				}
				elseif ($arResult["DISPLAY_PROPERTIES"]["napr"]) {
					$city = GetMessage('DISTRICT');
					$name = GetMessage('DISTRICT_MSK');
				}
				if ($arResult["DISPLAY_PROPERTIES"]["napr"]) {
					$massivkluchey = array("napr", "oblrayoni", "oblnapr", "metro", "vetkimetro");
				} else {
					$massivkluchey = array("mskokruga", "rayonmoskvi", "ulica", "metro", "vetkimetro");
				}

			}
			if ($city || $name):?>
				<div class="characteristic">
					<span class="characteristic__title"><b><?=$city?>: </b></span>
					<span class="characteristic__value"><?=$name?></span>
				</div><?
			endif;
			?>

			<div class="item-card__charact">
				<?
				foreach ($massivkluchey as $property)
				{
					?>
					<div class="characteristic">
						<span class="characteristic__title"><strong><?=$arResult["PROPERTIES"][$property]['NAME']?></strong></span>
						<?if($arResult["PROPERTIES"][$property]["PROPERTY_TYPE"] == "L") {
							if ($property == "mskokruga") { ?>
								<span class="characteristic__value"><a href="/<?=$arResult['PROPERTIES'][$property]['VALUE_XML_ID'][0]?>/"><?=$arResult["PROPERTIES"][$property]['VALUE'][0]?></a>
								</span>
							<?} elseif($property == "napr") {?>
									<span class="characteristic__value"><a href="/dormitory_suburbs/<?=$arResult['PROPERTIES'][$property]['VALUE_XML_ID'][0]?>/"><?=$arResult["PROPERTIES"][$property]['VALUE'][0]?></a>
								</span>
								<?}
						 else{ ?> 
							<span class="characteristic__value"><?=(is_array($arResult["PROPERTIES"][$property]['VALUE'][0])
								? implode(' / ', $arResult["PROPERTIES"][$property]['VALUE'][0])
								: $arResult["PROPERTIES"][$property]['VALUE'][0])?>
							</span>
						<?} } elseif ($arResult["PROPERTIES"][$property]["PROPERTY_TYPE"] == "S") {?>
							<span class="characteristic__value"><?=(is_array($arResult["PROPERTIES"][$property]['VALUE'])
								? implode(' / ', $arResult["PROPERTIES"][$property]['VALUE'])
								: $arResult["PROPERTIES"][$property]['VALUE'])?>
							</span>
						<?}?>
					</div>
					<?
					
				}
				unset($property);
				?>
			</div>
		</div>
		<div class="view-map">
			<a href="#tomap" class="map scrollto">
				<span>Посмотреть на карте</span>
			</a>
		</div>
	</div>
	<div class="item-card__btn-wrap">
		<div class="item-card__phone">
			<a href='tel:+74952151053' class='item-card__link'>
				<span class="icon"></span>
				<?$APPLICATION->IncludeComponent(
					"alma:phone.change",
					"",
					Array(
						"LIST_URLS_MOSCOW" => array("/hostel_in_msc/","/obshejitiye_*/"),
						"LIST_URLS_PITER" => array("/hostel_in_spb/",""),
						"PHONE_MOSCOW" => "+7 (495) 215-10-53",
						"PHONE_PITER" => "+7 (812) 643-21-38",
						"USE_GOAL_PHONE" => "N",
						"TARGET_CALL_NUMBER_CLASS" => "Y"
					)
				);?>
			</a>
		</div>
		<a href="javascript:void(0)" class="btn btn--red book-hostel" onclick="if(typeof yaCounter21524935 != 'undefined'){ yaCounter21524935.reachGoal('ZABRONIROVAT'); return true; } ga('send', 'event', 'Забронировать_общежитие', 'клик');" style="width: 210px; text-align: center;">Забронировать</a>
	</div>
</div>

<div class="item-card__descr">
	<h2>Описание общежития:</h2>
	<div class="item-card__parameters">
		<?foreach ($arResult["HOSTEL_DESCRIPTION"] as $property):?>
			<?if(!empty($property["VALUE"])):?>
				<div class="item-card__param-img">
					<img title="<?=$property["NAME"]?>" alt="<?=$property["NAME"]?>" src="<?=SITE_TEMPLATE_PATH?>/img/<?=$property["CODE"]?>.png?v=1">
				</div>
			<?endif;?>
		<?endforeach;?>
		<?unset($property);?>
	</div>

	<? if ($arResult["DETAIL_TEXT"]): ?>
		<?= $arResult["DETAIL_TEXT"] ?>
	<? elseif ($arResult["PREVIEW_TEXT"]): ?>
		<br/><?= $arResult["PREVIEW_TEXT"] ?><br/>
	<? endif; ?>


</div>


<div class="item-card__btn-wrap">
	<div class="item-card__phone">
	<a href='tel:+74952151053' class='item-card__link'>
		<span class="icon"></span>
		<?$APPLICATION->IncludeComponent(
			"alma:phone.change",
			"",
			Array(
				"LIST_URLS_MOSCOW" => array("/hostel_in_msc/","/obshejitiye_*/"),
				"LIST_URLS_PITER" => array("/hostel_in_spb/",""),
				"PHONE_MOSCOW" => "+7 (495) 215-10-53",
				"PHONE_PITER" => "+7 (812) 643-21-38",
				"USE_GOAL_PHONE" => "N",
				"TARGET_CALL_NUMBER_CLASS" => "Y"
			)
		);?>
	</a>
	</div>
	<div class="btn__price2">
	<? foreach ($arResult["PRICES"] as $code => $arPrice): ?>
		<? if ($arPrice["CAN_ACCESS"]): ?>
			<span class="item-card__price-num">
				<a class="btn btn--red book-hostel" onclick="if(typeof yaCounter21524935 != 'undefined'){ yaCounter21524935.reachGoal('ZABRONIROVAT'); return true; } ga('send', 'event', 'Забронировать_общежитие', 'клик'); ga('send', 'pageview', '/zabronirovat');">
				Снять койко место<br>от <?=(($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]) ? $arPrice["DISCOUNT_VALUE_VAT"] : $arPrice["VALUE_VAT"]);?> руб
				</a>
			</span>
		<? endif; ?>
	<? endforeach; ?>
	</div>
</div>

<?
require_once ("functions.php");
?>

<?
$jsParams = array(
	'CONFIG' => array(
		'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
		'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
		'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
		'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
		'MAGNIFIER_ZOOM_PERCENT' => 200,
	),
	'VISUAL' => $itemIds,
	'PRODUCT' => array(
		'ID' => $arResult['ID'],
		'ACTIVE' => $arResult['ACTIVE'],
		'PICT' => reset($arResult['MORE_PHOTO']),
		'NAME' => $arResult['~NAME'],
		'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
		'SLIDER' => $arResult['MORE_PHOTO'],
	),
);
?>
<script>
	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
	BX.ready(function(){
	var callrequest = new BX.PopupWindow("request_hostel", window.body, {
	  autoHide : true,
	  content: BX('bx-book-hostel'),
	  closeIcon: {right: "20px", top: "10px", 'props': {'className': 'popup__close'}},
	  titleBar: {content: BX.create("span", {html: 'Напишите время, удобное для звонка', 'props': {'className': 'popup__title'}})},
	  zIndex: 0,
	  offsetLeft: 0,
	  offsetTop: 0,
	  closeByEsc : true,
	  draggable: {restrict: false},
	  overlay: {backgroundColor: 'black', opacity: '1' },  /* затемнение фона */
	 
	});
	BX.ajax.insertToNode('/includes/book_hostel.php', BX('bx-book-hostel')); // функция ajax-загрузки контента из урла в #div
	BX.bindDelegate(
	  document.body, 'click', {className: 'book-hostel' },
	     BX.proxy(function(e){
	        if(!e)
	           e = window.event;
	       	callrequest.show(); // появление окна
	        return BX.PreventDefault(e);
	     }, callrequest)
	);
});

$(document).ready(function () {
	// $('.js-detail-min-slider').slick({
	// 	infinite: true,
	// 	slidesToShow: 4,
	// 	slidesToScroll: 4,
	// 	variableWidth: true,
	// 	adaptiveHeight: true
	// });
});
</script>
<?
unset($actualItem, $itemIds, $jsParams);