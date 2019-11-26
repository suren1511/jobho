<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел"); ?>
<?
if(!$USER->IsAuthorized())
{
    LocalRedirect('/auth/');
}
else {

  if (in_array(6, $strGroups)){
    ?>
    <h2>Менеджер</h2>
    <?$APPLICATION->IncludeComponent("bitrix:menu", "personmenu", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"ROOT_MENU_TYPE" => "manager",	// Тип меню для первого уровня
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?>
    <?
  }
  if (in_array(12, $strGroups)){
    ?>
    <h2>Соискатель</h2>
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personmenu", 
	array(
		"COMPONENT_TEMPLATE" => "personmenu",
		"ROOT_MENU_TYPE" => "applicant",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
    <?
  }
  if (in_array(13, $strGroups)){
    ?>
    <h2>Арендатор</h2>
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personmenu", 
	array(
		"COMPONENT_TEMPLATE" => "personmenu",
		"ROOT_MENU_TYPE" => "tenant",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
    <?
  }
  if (in_array(14, $strGroups)){
    ?>
    <h2>Работодатель</h2>
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personmenu", 
	array(
		"COMPONENT_TEMPLATE" => "personmenu",
		"ROOT_MENU_TYPE" => "employer",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
    <?
  }
  if (in_array(15, $strGroups)){
    ?>
    <h2>Арендодатель</h2>
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personmenu", 
	array(
		"COMPONENT_TEMPLATE" => "personmenu",
		"ROOT_MENU_TYPE" => "lessor",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
    <?
  }
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>