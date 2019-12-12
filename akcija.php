<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Акция | Агрегатор общежитий ДжобХостел");
$APPLICATION->SetPageProperty("description", "Акция - компания ДжобХостел предлагает самые низкие цены на жилье в МСК от 79руб\\сутки, услуги по подбору персонала, доставке рабочих и организации питания.");
$APPLICATION->SetTitle("Акция");
?><p>
</p>
<p>
	 «ДжобХостел» проводит супер акцию! Мы предлагаем нашим Клиентам, которые заинтересованы в расселении иногороднего персонала на территории Москвы и области, бесплатно получить классный ноутбук или смартфон.
</p>
<h3 style="margin-bottom: 17px;">Что за призы?</h3>
<p>
	 Разместившему от 50 человек — смартфон, от 100 человек — ноутбук. Подарки получат все, кто выполнит условия акции!
</p>
 <br>
<div>
	<div style="float: left; margin-top: 74px;">
 <img src="<?=SITE_TEMPLATE_PATH?>/img/noyt.jpg"><br>
		<div style="position: relative; color: #4b4b4b; width: 299px; top: 16px;">
			 Ноутбук с размером экрана 15 дюймов.  Частота процессора 1800 МГц Размер оперативной памяти 8 Гб Объем накопителя 1000 Гб 
		</div>
	</div>
	<div style="float: left; margin-top: 27px; margin-left: 67px;">
 <img src="<?=SITE_TEMPLATE_PATH?>/img/phone.jpg">
		<div style="width: 331px; position: relative; top: 12px; color: #4b4b4b;">
			 Смартфон, Android, экран 5", разрешение 1080x1920 Камера 13 МП, автофокус Память 16 Гб, слот microSD (TransFlash) Bluetooth, NFC, Wi-Fi, 4G, GPS, ГЛОНАСС
		</div>
	</div>
</div>
<div style="position: relative; top: 30px;">
<h3 style="margin-bottom: 17px;">Условия участия</h3>
<p>
	 1. Заключите договор на размещение от 50 или от 100 человек с общежитиями участвующими в акции.
</p>
<p>
 <br>
</p>
<p>
	 2. Оплатите выставленные по договору счета.<br>
 <br>
	 3. Приз ваш! За 50 человек - смартфон, за 100 - ноутбук!
</p></div>
<p>
</p>
<br />
<h3 style="margin-bottom: 17px;">Какие общежития?</h3>
 В акции участвуют следующие общежития: <br>

<table width="100%"> 
  <tbody> 
    <tr><td valign="top" align="center"> 
       <?global $arrFilter;
	   
	   
	   
if(!$arrFilter){
$arrFilter["ACTIVE"]="Y";
$arrFilter["!PROPERTY_gorpredl"]="~'0'";

}

?> <?$APPLICATION->IncludeComponent(
    "alma:catalog.section.prop",
    "hostel_in_moscow",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "BASKET_URL" => "/personal/basket.php",
        "BROWSER_TITLE" => "-",
        "CACHE_FILTER" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "360000",
        "CACHE_TYPE" => "N",
        "COMPONENT_TEMPLATE" => "hostel_in_moscow",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_COMPARE" => "N",
        "DISPLAY_TOP_PAGER" => "Y",
        "ELEMENT_SORT_FIELD" => "PROPERTY_gorpredl",
        "ELEMENT_SORT_FIELD2" => "sort",
        "ELEMENT_SORT_ORDER" => "desc",
        "ELEMENT_SORT_ORDER2" => "asc",
        "FILTER_NAME" => "arrFilter",
        "IBLOCK_ID" => "3",
        "IBLOCK_TYPE" => "xmlcatalog",
        "INCLUDE_SUBSECTIONS" => "N",
        "LINE_ELEMENT_COUNT" => "1",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "Y",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "round",
        "PAGER_TITLE" => "Товары",
        "PAGE_ELEMENT_COUNT" => 100,
        "PRICE_CODE" => array(
            0 => "BASE",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(
        ),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PROPERTY_CODE" => array(
            0 => "metro",
            1 => "mskokruga",
            2 => "ulica",
            3 => "group",
            4 => "napr",
            5 => ""
        ),
        "SECTION_CODE" => "",
        "SECTION_ID" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "N",
        "SHOW_ALL_WO_SECTION" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false,
    array(
        "ACTIVE_COMPONENT" => "Y"
    )
);
?> </td></tr>
   </tbody>
 </table>
 <br>

 * Минимальный срок размещения один месяц.<br>
* Обязательно условие документальное подтверждение оплаты проживания.<br /><br />
<div style="position: relative;">
	<p>
		 Напоминаем, что ООО «ДжобХостел» — единственная в столице компания, предоставляющая полный пакет услуг по рекрутингу, организации проживания и трансферу иногородних рабочих для крупных предприятий. Мы действуем на рынке больше 15 лет и знаем свое дело на все 100 %. Если вы предпочитаете по-настоящему выгодные сделки, приходите к нам.
	</p></dib>
 <br>
 <br>
 <br>
 
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>