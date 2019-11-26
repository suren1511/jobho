<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => "Добавление звонка",
	"DESCRIPTION" => GetMessage("IBLOCK_ELEMENT_ADD_FORM_DESCRIPTION"),
	"ICON" => "/images/eaddform.gif",
	"PATH" => array(
    "ID" => "innova",
    "NAME" => "Компоненты AMT",
		"CHILD" => array(
			"ID" => "amt_element_add",
			"NAME" => "Элементы",
			"CHILD" => array(
				"ID" => "element_add_cmpx_amt",
			),
		),
	),
);
?>