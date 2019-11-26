<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказать звонок");
?>

<?$APPLICATION->IncludeComponent("amt:add.zvonok", "amt_zvonok", Array(
	"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",	// * дата начала *
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",	// * дата завершения *
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",	// * подробная картинка *
		"CUSTOM_TITLE_DETAIL_TEXT" => "",	// * подробный текст *
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",	// * раздел инфоблока *
		"CUSTOM_TITLE_NAME" => "",	// * наименование *
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",	// * картинка анонса *
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",	// * текст анонса *
		"CUSTOM_TITLE_TAGS" => "",	// * теги *
		"DEFAULT_INPUT_SIZE" => "30",	// Размер полей ввода
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования подробного текста
		"ELEMENT_ASSOC" => "CREATED_BY",	// Привязка к пользователю
		"GROUPS" => "",	// Группы пользователей, имеющие право на добавление/редактирование
		"IBLOCK_ID" => "30",	// Инфо-блок
		"IBLOCK_TYPE" => "cabinet",	// Тип инфо-блока
		"LEVEL_LAST" => "Y",	// Разрешить добавление только на последний уровень рубрикатора
		"LIST_URL" => "",	// Страница со списком своих элементов
		"MAX_FILE_SIZE" => "0",	// Максимальный размер загружаемых файлов, байт (0 - не ограничивать)
		"MAX_LEVELS" => "100000",	// Ограничить кол-во рубрик, в которые можно добавлять элемент
		"MAX_USER_ENTRIES" => "100000",	// Ограничить кол-во элементов для одного пользователя
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",	// Использовать визуальный редактор для редактирования текста анонса
		"PROPERTY_CODES" => array(	// Свойства, выводимые на редактирование
			0 => "526",
			1 => "527",
			2 => "528",
			3 => "529",
			4 => "530",
			5 => "531",
			6 => "NAME",
		),
		"PROPERTY_CODES_REQUIRED" => "",	// Свойства, обязательные для заполнения
		"RESIZE_IMAGES" => "N",	// Использовать настройки инфоблока для обработки изображений
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"STATUS" => "ANY",	// Редактирование возможно
		"STATUS_NEW" => "N",	// Деактивировать элемент
		"USER_MESSAGE_ADD" => "",	// Сообщение об успешном добавлении
		"USER_MESSAGE_EDIT" => "",	// Сообщение об успешном сохранении
		"USE_CAPTCHA" => "N",	// Использовать CAPTCHA
		"COMPONENT_TEMPLATE" => "amt"
	),
	false
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>