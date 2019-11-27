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

$this->setFrameMode(false);

use \Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH.'/js/vendor/lightbox/jquery.lightbox-0.5.css');
$asset->addJs(SITE_TEMPLATE_PATH.'/js/vendor/lightbox/jquery.lightbox-0.5.min.js');
?>
<?
if($arResult["BREADCRUMB"]["NAME"] && $arResult["BREADCRUMB"]["URL"])$APPLICATION->AddChainItem($arResult["BREADCRUMB"]["NAME"], $arResult["BREADCRUMB"]["URL"]);
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
		if ($arResult["DISPLAY_PROPERTIES"]["mskokruga"]["DISPLAY_VALUE"] && $arResult["DISPLAY_PROPERTIES"]["metro"]["DISPLAY_VALUE"]) {
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


<div class="item-card">
	<div class="item-card__left">
		<?if($arResult["DETAIL_PICTURE"]) { ?>
			<div class="product-detail-img">
				<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
			</div>
		<?} elseif ($arResult["PREVIEW_PICTURE"]) {?>
			<div class="product-detail-img">
				<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>">
			</div>
		<?}?>
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
			<span class='item-card__link'>
				<!-- <span class="icon"></span> -->
				<?$APPLICATION->IncludeComponent(
					"alma:phone.change",
					"",
					Array(
						"LIST_URLS_MOSCOW" => array("/hostel_in_msc/","/obshejitiye_*/"),
						"LIST_URLS_PITER" => array("/hostel_in_spb/",""),
						"PHONE_MOSCOW" => "+7 (495) 215-15-53",
						"PHONE_PITER" => "+7 (812) 643-21-38",
						"USE_GOAL_PHONE" => "N",
						"TARGET_CALL_NUMBER_CLASS" => "Y"
					)
				);?>
			</span>
		</div>
		<a href="javascript:void(0)" class="btn btn--red book-hostel" onclick="if(typeof yaCounter21524935 != 'undefined'){ yaCounter21524935.reachGoal('ZABRONIROVAT'); return true; } ga('send', 'event', 'Забронировать_общежитие', 'клик');" style="width: 210px; text-align: center;">Забронировать</a>
	</div>
</div>


<?
	// debug($arResult);
	
?>
<?if ($arResult['PROPERTIES']['DOP_FOTO']['VALUE']) {?>
	<div class="detail-slider js-detail-slider">
		<? foreach ($arResult['PROPERTIES']['DOP_FOTO']['VALUE'] as $i=>$arImg):?>
				<a href="<?=CFile::GetPath($arImg);?>" class="detail-slider__item js-lightbox">
					<img src="<?=CFile::GetPath($arImg);?>" alt="<?=$arResult["NAME"]?>- фото <?=$i+1?>" class="detail-slider__img">
				</a>
		<? endforeach;?>
	</div>
<?}?>

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
	<?if($arResult["PROPERTIES"]["R_25"]['VALUE_ENUM'][0]):?>
	  <br/><?=$arResult["PROPERTIES"]["R_25"]['NAME']?> - <?=$arResult["PROPERTIES"]["R_25"]['VALUE_ENUM'][0]?><br/>
	<?endif?>

</div>

<?
global $USER;
if ($USER) {
	$dbUser = CUser::GetByID($USER->GetID());
	$arUser = $dbUser->Fetch();
	$arrGroups = $USER->GetUserGroupArray();
}

?>

<? if (in_array("1", $arrGroups) || in_array("6", $arrGroups) || in_array("7", $arrGroups)): ?>
	<div id="manager-info">
		<?// $frame = $this->createFrame("manager-info", false)->begin(); ?>
		<h2>Информация для менеджеров</h2>
		<? // Форма простоя?>
		<? if ($arResult["DISPLAY_PROPERTIES"]['imamenegera']["DISPLAY_VALUE"]): ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Простой на <?= $arResult["DISPLAY_PROPERTIES"]['dataizminenia']["DISPLAY_VALUE"] ?>&nbsp;- </span>
					<input type="text" name="prostoy" value="<?= $arResult["DISPLAY_PROPERTIES"]['prostoy']["DISPLAY_VALUE"] ?>">
					<span class="manage-name">,<?= $arResult["DISPLAY_PROPERTIES"]['imamenegera']["DISPLAY_VALUE"] ?></span>
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					<input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? else : ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Простой </span><textarea name="prostoy"><span> койко-мест</span></textarea>
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					&nbsp;&nbsp; <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? endif; ?>

		<? // форма заселения?>
		<? if ($arResult["DISPLAY_PROPERTIES"]['imamenegerazaselenie']["DISPLAY_VALUE"]): ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Заселение на <?= $arResult["DISPLAY_PROPERTIES"]['datazaselenie']["DISPLAY_VALUE"] ?>
					-</span> <textarea
					name="zaselenie"><?= $arResult["DISPLAY_PROPERTIES"]['zaselenie']["DISPLAY_VALUE"] ?></textarea>
					<span class="manage-name">, <?= $arResult["DISPLAY_PROPERTIES"]['imamenegerazaselenie']["DISPLAY_VALUE"] ?>
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user2"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? else : ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Заселение</span><textarea name="zaselenie"><?= $arResult["DISPLAY_PROPERTIES"]['zaselenie']["DISPLAY_VALUE"] ?></textarea>
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user2"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					&nbsp;&nbsp; <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? endif; ?>

		<? // форма сверки?>
		<? if ($arResult["DISPLAY_PROPERTIES"]['imamenegerasverka']["DISPLAY_VALUE"]): ?>
			<div class="item-card_manager-row aa">
				<form action="" method="post">
					<span>Сверка на <?= $arResult["DISPLAY_PROPERTIES"]['datasverka']["DISPLAY_VALUE"] ?>
					-</span><textarea
					name="sverka"><?= $arResult["DISPLAY_PROPERTIES"]['sverka']["DISPLAY_VALUE"] ?></textarea>
					<span class="manage-name">, <?= $arResult["DISPLAY_PROPERTIES"]['imamenegerasverka']["DISPLAY_VALUE"] ?>
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user3"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? else : ?>
			<div class="item-card_manager-row bb">
				<form action="" method="post">
					<span>Сверка</span> <textarea name="sverka"></textarea>
					<span class="manage-name">
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user3"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? endif; ?>


		<? // форма адреса?>
		<? if ($arResult["DISPLAY_PROPERTIES"]['imamenegeraadres']["DISPLAY_VALUE"]): ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span
					>Адрес на <?= $arResult["DISPLAY_PROPERTIES"]['dataadres']["DISPLAY_VALUE"] ?>
				-</span> <textarea
				name="adres"><?= $arResult["DISPLAY_PROPERTIES"]['adres']["DISPLAY_VALUE"] ?></textarea><span class="manage-name">, <?= $arResult["DISPLAY_PROPERTIES"]['imamenegeraadres']["DISPLAY_VALUE"] ?>
				<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
				<input type="hidden" name="user4"
				value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
				</span> <input type="submit" <?if(!in_array(1, CUser::GetUserGroupArray())):?>disabled<?endif?> value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? else : ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Адрес</span> <textarea name="adres"></textarea>
					<span class="manage-name">
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user4"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" <?if(!in_array(1, CUser::GetUserGroupArray())):?>disabled<?endif?> value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? endif; ?>
		
		<? // форма проезда?>
		<? if ($arResult["DISPLAY_PROPERTIES"]['imamenegerproezd']["DISPLAY_VALUE"]): ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Проезд на <?= $arResult["DISPLAY_PROPERTIES"]['dataproezd']["DISPLAY_VALUE"] ?>
					-</span> <textarea
					name="proezd" class="textarea-big"><?= $arResult["DISPLAY_PROPERTIES"]['proezd']["DISPLAY_VALUE"] ?></textarea>
					<span class="manage-name">, <?= $arResult["DISPLAY_PROPERTIES"]['imamenegerproezd']["DISPLAY_VALUE"] ?>
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user5"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? else : ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Проезд</span> <textarea name="proezd" class="textarea-big"></textarea>
					<span class="manage-name">
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user5"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? endif; ?>

		<? // форма комментария?>
		<? if ($arResult["DISPLAY_PROPERTIES"]['imamenegeracomments']["DISPLAY_VALUE"]): ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Комментарий на <?= $arResult["DISPLAY_PROPERTIES"]['datacomments']["DISPLAY_VALUE"] ?>
					-</span> <textarea
					name="comments" class="textarea-big"><?= $arResult["DISPLAY_PROPERTIES"]['comments']["DISPLAY_VALUE"] ?></textarea><span class="manage-name">, <?= $arResult["DISPLAY_PROPERTIES"]['imamenegeracomments']["DISPLAY_VALUE"] ?>
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user6"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? else : ?>
			<div class="item-card_manager-row">
				<form action="" method="post">
					<span>Комментарий</span> <textarea name="comments" class="textarea-big"></textarea>
					<span class="manage-name">
					<input type="hidden" name="id" value="<?= $arResult['ID'] ?>">
					<input type="hidden" name="user6"
					value="<? echo $arUser['NAME'] . " " . $arUser['LAST_NAME'] ?>">
					</span> <input type="submit" value="Сохранить" class="btn btn--blue">
				</form>
			</div>
		<? endif; ?>

		<div class="item-card_manager__descr">
			<? // Вывод свойств менеджера
			$massivkluchey = array("group", "tipobshejitiya", "kolvomest", "free", "gorpredl", "nalmest", "kontdann", "kolchel", 'dontwork');
			//viewinfo($massivkluchey,$arResult);
			foreach ($massivkluchey as $i):
			if ($arResult["DISPLAY_PROPERTIES"][$i]["DISPLAY_VALUE"]):?>
			<div>
			<?= $arResult["DISPLAY_PROPERTIES"][$i]["NAME"] ?>:&nbsp;
			<? if (is_array($arResult["DISPLAY_PROPERTIES"][$i]["DISPLAY_VALUE"])) {
				foreach($arResult["DISPLAY_PROPERTIES"]["tipobshejitiya"]["DISPLAY_VALUE"] as $key => $val) {
					global $USER;
					/*if(!$USER->IsAdmin())
						if($val == 'СК')
							unset($arResult["DISPLAY_PROPERTIES"]["tipobshejitiya"]["DISPLAY_VALUE"][$key]);*/
				}
				echo implode("&nbsp;/&nbsp;", $arResult["DISPLAY_PROPERTIES"][$i]["DISPLAY_VALUE"]);
			}
			else
			echo $arResult["DISPLAY_PROPERTIES"][$i]["DISPLAY_VALUE"]; ?>
			</div>
			<?endif;
			endforeach;
			if ($arResult["PROPERTIES"]['dontwork']['VALUE']) {
			echo ' <div>Не работаем</div>';
			}
			?>

			<?// $frame->beginStub(); ?>

			<?// $frame->end(); ?>
		</div>
	</div>
<? endif; ?>

<? if (in_array("1", $arrGroups) || in_array("7", $arrGroups)): ?>

<h2>Информация для дирекции</h2>
<br/>
<?
$res = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
if ($ar_res = $res->GetNext()) {
echo '<div style="margin-top:6px;margin-bottom:6px;" class="el_menu"><span class="zag">Владелец: </span><span class="el_val">' . $ar_res['NAME'] . '</span></div>';
echo '<div class="el_menu"><span class="zag">Контакты собственника: </span><span class="el_val">' . $ar_res['DESCRIPTION'] . '</span></div>';
}
?>
<? endif; ?>
<div>

<div class="item-card__btn-wrap">
	<div class="item-card__phone">
	<span class='item-card__link'>
		<!-- <span class="icon"></span> -->
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
	</span>
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

<script>
	var get_url = document.location.pathname;
	BX.ready(function(){
	var callrequest = new BX.PopupWindow("request_hostel", window.body, {
	  autoHide : true,
	  content: BX('bx-book-hostel'),
	  closeIcon: {right: "20px", top: "10px", 'props': {'className': 'popup__close'}},
	  titleBar: {content: BX.create("span", {html: 'Отправить заявку на бронирование', 'props': {'className': 'popup__title'}})},
	  zIndex: 0,
	  offsetLeft: 0,
	  offsetTop: 0,
	  closeByEsc : true,
	  draggable: {restrict: false},
	  overlay: {backgroundColor: 'black', opacity: '1' },  /* затемнение фона */
	 
	});
	BX.ajax.insertToNode('/includes/book_hostel.php?page_u='+get_url, BX('bx-book-hostel')); // функция ajax-загрузки контента из урла в #div
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
	// Галерея картинок
	$('.js-lightbox').lightBox({
		imageLoading: '/local/templates/main/js/vendor/lightbox/images/lightbox-ico-loading.gif',
		imageBtnClose: '/local/templates/main/js/vendor/lightbox/images/lightbox-btn-close.gif',
		imageBtnPrev: '/local/templates/main/js/vendor/lightbox/images/lightbox-btn-prev.gif',
		imageBtnNext: '/local/templates/main/js/vendor/lightbox/images/lightbox-btn-next.gif',
	});
});
</script>
<?
unset($actualItem, $itemIds, $jsParams);