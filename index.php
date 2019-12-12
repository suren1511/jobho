<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Недорогие общежития в Москве, Санкт-Петербурге и Московской области. Снять общежитие для рабочих");
$APPLICATION->SetPageProperty("keywords", "общежитие в москве, общежитие для рабочих, общежития в москве недорого, комната в общежитии, общага в москве,");
$APPLICATION->SetPageProperty("description", "Сервис бронирования и подбора семейных общежитий и общежитий для рабочих в Москве, Санкт-Петербурге и Московской области. Быстро и комфортно | ДжобХостел");
$APPLICATION->SetTitle("Общежитие в Москве, общежитие для рабочих");
?><ul class="sub-menu">
	<li class="sub-menu__item"> <a class="sub-menu__link" href="/transportnye_uslugi/"> <img src="/upload/content/icon_trans.png" class="sub-menu__img" alt=""><span class="sub-menu__text">Транспортные услуги</span> </a> </li>
	<li class="sub-menu__item"> <a class="sub-menu__link" href="/organizaciya_pitaniya/"> <img src="/upload/content/icon_spoon.png" class="sub-menu__img" alt=""><span class="sub-menu__text">Организация питания</span> </a> </li>
	<li class="sub-menu__item"> <a class="sub-menu__link" href="/podbor_personala/"> <img src="/upload/content/icon_man.png" class="sub-menu__img" alt=""><span class="sub-menu__text">Подбор персонала</span> </a> </li>
	<li class="sub-menu__item"> <a class="sub-menu__link" href="/sotrudnichestvo/"> <img src="/upload/content/icon_heart.png" class="sub-menu__img" alt=""><span class="sub-menu__text">Сотрудничество</span> </a> </li>
	<li class="sub-menu__item"> <a class="sub-menu__link" href="/jobs/"> <img src="/upload/content/icon_bag.png" class="sub-menu__img" alt=""><span class="sub-menu__text">Вакансии</span> </a> </li>
	<li class="sub-menu__item"> <a class="sub-menu__link" href="/aktsii/"> <img src="/upload/content/icon_percent.png" class="sub-menu__img" alt=""><span class="sub-menu__text">Акции</span> </a> </li>
</ul>
<h1 class="title-h1" style="padding-top: 16px; padding-bottom: 28px;">Общежития для рабочих<br>
в Москве, Московской области и Санкт-Петербурге</h1>
<p class="h-text-center">
	«ДжобХостел» - это бесплатный сервис по поиску и бронированию общежитий в Москве, Московской области и Санкт-Петербурге, организации трансфера и питания. Нашими услугами активно пользуются компании, привлекающие рабочих из регионов Российской Федерации, стран ближнего и дальнего зарубежья. Номерной фонд недорогих общежитий в базе «ДжобХостел» насчитывает более 276&nbsp;000 койко-мест.
</p>
 <?
if (CModule::includeModule("iblock")) {
	$countMos = 0;
	$countMosReg = 0;
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_rayon");
	$arFilter = Array("IBLOCK_ID"=>3, "ACTIVE"=>"Y"); 
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while($arMoscow = $res->Fetch()){ 
		if ($arMoscow["PROPERTY_RAYON_VALUE"])
			$countMosReg++;
		else
			$countMos++;
	}

	$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y"); 
	$res = CIBlockElement::GetList(array(), $arFilter, false, false, array());
	$countPiter = $res->SelectedRowsCount();
}


?>
<div class="design-block">
	<div class="design-block__item">
		<div class="design-block__content" style="background-image: url(/upload/content/bg-dormitory1.jpg);">
 <a href="/hostel_in_msc/"> <span class="design-block__head">Общежития Москвы</span> <span class="design-block__text"><?=$countMos?> общежитий и хостелов</span><!-- program code (цифра должна выводиться автоматически) --> </a>
		</div>
	</div>
	<div class="design-block__item">
		<div class="design-block__content" style="background-image: url(/upload/content/bg-dormitory2.jpg);">
 <a href="/dormitory_suburbs/"> <span class="design-block__head">Общежития Подмосковья</span> <span class="design-block__text"><?=$countMosReg?> общежитий и хостелов</span> </a>
		</div>
	</div>
	<div class="design-block__item">
		<div class="design-block__content" style="background-image: url(/upload/content/bg-dormitory3.jpg);">
 <a href="/hostel_in_spb/"> <span class="design-block__head">Общежития Санкт-Петербурга</span> <span class="design-block__text"><?=$countPiter?> общежитий и хостелов</span> </a>
		</div>
	</div>
</div>
<p class="h-text-center">
	Мы поможем вам быстро заселить сотрудников в комфортабельные общежития без посредников. Аренда общежитий на длительный срок не только экономически выгодна, но и позволяет обеспечить легальный статус персонала. Все работники, прибывающие из-за рубежа, официально регистрируются в МВД. На объектах имеется круглосуточная охрана, в комнатах комфортно и уютно.
</p>
<div class="advant">
	<h2 class="title-h2">Преимущества сотрудничества</h2>
	<div class="advant__list">
		<div class="advant__item">
			<div class="advant__img">
				<img src="/upload/content/darts.png" alt="">
			</div>
			<div class="advant__text">
				Самый большой выбор коммерческих общежитий
			</div>
		</div>
		<div class="advant__item">
			<div class="advant__img">
				<img src="/upload/content/handshake.png" alt="">
			</div>
			<div class="advant__text">
				Заселение в день обращения
			</div>
		</div>
		<div class="advant__item">
			<div class="advant__img">
				<img src="/upload/content/coins.png" alt="">
			</div>
			<div class="advant__text">
				Самые низкие цены на все предлагаемые услуги
			</div>
		</div>
		<div class="advant__item">
			<div class="advant__img">
				<img src="/upload/content/portmone.png" alt="">
			</div>
			<div class="advant__text">
				Любая, удобная для Вас, форма оплаты
			</div>
		</div>
		<div class="advant__item">
			<div class="advant__img">
				<img src="/upload/content/manager.png" alt="">
			</div>
			<div class="advant__text">
				Личный менеджер
			</div>
		</div>
	</div>
</div>
<p class="h-text-center">
	Стоимость койко-места в общежитии — от 120 до 300 рублей в сутки, в зависимости от выбранного района и варианта размещения. В большинстве общежитий предоставляются комнаты для групп рабочих, рассчитанные на размещение от 2-х до 16-ти человек.
</p>
<div class="offers">
	<h2 class="title-h2" style="margin-top: 58px;"><a href="/best_deals/">Лучшие предложения</a></h2>
	 <? global $gorpredlfiltr;
		if (!$gorpredlfiltr) {
		$gorpredlfiltr = array("ACTIVE" => "Y", "!PROPERTY_gorpredl" => "~'0'");
		}?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"best_deals_slider",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "PROPERTY_gorpredl",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "gorpredlfiltr",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "xmlcatalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "10",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(0=>"BASE",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => array(),
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array(0=>"gragdanstvo",1=>"metro",2=>"mskokruga",3=>"ulica",4=>"napr",5=>"gorpredl",6=>"",),
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
</div>
<h2 class="title-h2">Преимущества общежитий от «ДжобХостел»:</h2>
<ul class="galka-seo">
	<li> Удобное расположение (рядом с работой или у метро, в любом районе города, включая ЦАО);</li>
	<li> Возможность снять комнаты для большого количества работников и получить персональную скидку;</li>
	<li> Хорошие бытовые условия - горячая вода, уборка, безопасность проживания;</li>
	<li> Доброжелательный персонал;</li>
	<li> Однородная социальная среда;</li>
	<li> Комфортные условия проживания повышают работоспособность персонала, комнаты в общежитиях полностью готовы к заселению, есть телевизоры, холодильники, стиральные машины и Wi-Fi.</li>
</ul>
<p>
	&nbsp;
</p>
<h2 class="title-h2">Переезд в общежитие для рабочих за наш счет!</h2>
<div class="h-text-center">
 <a href="/akcija-pereezd-za-nash-schet.php"><img alt="Переезд за наш счет" src="/upload/content/job_per.jpg"></a>
</div>
<h2 class="title-h2" style="margin-top: 68px;">Пять причин выбрать нашу компанию:</h2>
<ul class="galka-seo">
	<li> Работаем круглосуточно, без выходных!</li>
	<li> Самая большая база общежитий в Москве и Подмосковье.</li>
	<li> Постоянно в наличии свободные койко-места, заселение в день обращения.</li>
	<li> Решение проблем с регистрацией иностранных рабочих.</li>
	<li> Низкие цены и удобные формы оплаты.</li>
</ul>
<p style="margin-top: 11px;">
	Мы комплексно подходим к решению организационных и бытовых вопросов, с которыми сталкиваются наши Клиенты, нанимающие рабочих из других регионов России, ближнего или дальнего зарубежья. Вы можете не только забронировать общежитие, но и заказать встречу и трансфер сотрудников, а также горячее питание с доставкой в общежитие или на производственный объект.
</p><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>