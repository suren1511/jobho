<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("COMP_MAIN_USER_REGISTER_TITLE"),
	"DESCRIPTION" => GetMessage("COMP_MAIN_USER_REGISTER_DESCR"),
	"ICON" => "/images/user_register.gif",
	"PATH" => array(
    "ID" => "innova",
    "NAME" => "Компоненты AMT",
			"CHILD" => array(
				"ID" => "user_amt",
				"NAME" => GetMessage("MAIN_USER_GROUP_NAME")
			),
		),
);
?>