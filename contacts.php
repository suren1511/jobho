<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты");
$APPLICATION->SetPageProperty("description", "Контакты - компания ДжобХостел предлагает самые низкие цены на жилье в МСК от 79руб\\сутки, услуги по подбору персонала, доставке рабочих и организации питания.");
$APPLICATION->SetTitle("Контакты ООО \"ДжобХостел\"");

?>
<meta itemprop="name" content='ООО "ДжобХостел"' /> 
<div style="font-size: 16px; color: #333; font-weight: bold;"> ДжобХостел поселит Ваших сотрудников в любом из 457-ми общежитий размещённых на нашем сайте в Москве, Подмосковье и Санкт-Петербурге, организуем трансфер и питание для Ваших сотрудников. <br>
Подобрать общежитие в интересующем районе, сообщить о наличии свободных мест, Вам помогут наши эксперты. Звоните! <br>
</div>

<div class="contacts" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
	<div class="contacts__title">
		Многоканальный телефон/факс:
	</div>
	<div class="contacts__info">
		<?$APPLICATION->IncludeComponent(
			"alma:phone.change",
			"",
			Array(
				"PHONE_MOSCOW" => "+7 (495) 215-10-53",
				"PHONE_PITER" => "+7 (812) 643-21-38",
				"USE_GOAL_PHONE" => "Y",
				"TARGET_CALL_NUMBER_CLASS" => "Y"
			)
		);?> <br>
		<a class="mail" href="mailto:info@jobhostel.ru"><span itemprop="email">info@jobhostel.ru</span></a>&nbsp;
	</div>
	<div class="contacts__title">
		Подбор персонала:
	</div>
	<div class="contacts__info">
		офис №9&nbsp;<br>
		<a class="mail" href="mailto:klient@jobhostel.ru">klient@jobhostel.ru</a>
	</div>
	<div class="contacts__title">
		Размещение в общежитиях, организация трансфера и питания:
	</div>
	<div class="contacts__info">
		офис №5 <br>
		<a class="mail" href="mailto:125@jobhostel.ru">125@jobhostel.ru</a>
	</div>
	<div class="contacts__title">
		Наш адрес:
	</div>
	<div class="contacts__info">
		109147, <span class="locality">г. Москва</span>, <span class="street-address">ул. Марксистская, д.34, кор.10, оф.№ 5</span>
	</div>
	<div class="contacts-wrap">
		<div class="contacts-block">
			<div class="contacts-block__title">
				Вид от метро Таганская
			</div>
			<a class="fancy" data-fancybox="images1" alt="Вид от метро Таганская" href="/upload/content/marksistskaya1.jpg"> <img src="/upload/content/marksistskaya1.jpg" class="contacts-block__img"> </a>
		</div>
		<div class="contacts-block">
			<div class="contacts-block__title">
				Вид от метро Пролетарская
			</div>
			<a class="fancy" data-fancybox="images2" alt="Вид от метро Пролетарская" href="/upload/content/proletarskaya1.jpg"> <img src="/upload/content/proletarskaya1.jpg" class="contacts-block__img"> </a>
		</div>
		<div class="contacts-block">
			<div class="contacts-block__title">
				Вход в офис
			</div>
			<a class="fancy" data-fancybox="images3" alt="Вход в офис" href="/upload/content/ofice.jpg"> <img src="/upload/content/ofice.jpg" class="contacts-block__img"> </a>
		</div>
	</div>
	<div class="contacts__title">
		Юридический адрес:
	</div>
	<div class="contacts__info">
		<span itemprop="postalCode">127051</span>, <span itemprop="addressLocality">Россия, г. Москва</span>, <span itemprop="streetAddress">М.Сухаревская пл., д.6 стр.1</span><br>
		ИНН 7702750110<br>
		КПП 770201001<br>
		ОГРН 5107746065092
	</div>
	<div class="contacts__title">
		Ближайшие станции метро: Таганская, Марксистская, Крестьянская застава, Пролетарская.
	</div>
	<div class="contacts__map">
		<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.734140390710834;s:10:\"yandex_lon\";d:37.66225066477035;s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.664525178015;s:3:\"LAT\";d:55.734128283523;s:4:\"TEXT\";s:71:\"Россия, Москва, Марксистская улица, 34к10\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br>
		</div>
		<div style="margin-top: 20px">
			<h2>Региональные представительства</h2>
			<div class="contacts__reg">
				<strong>Город: </strong> Санкт-Петербург <br>
				<strong>Адрес:</strong> Владимирский проспект, д.19 <br>
				<strong>Телефон:</strong> 8 (812) 643-21-38 <br>
			</div>
			<div class="contacts__map">
				<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:59.92889558609479;s:10:\"yandex_lon\";d:30.339625955678684;s:12:\"yandex_scale\";i:13;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:30.345977426625957;s:3:\"LAT\";d:59.928410928826246;s:4:\"TEXT\";s:90:\"Россия, Санкт-Петербург, Владимирский проспект, 19\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br>
				</div>
			</div>
		</div>
		<br><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>