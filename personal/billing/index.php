<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Финансы");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.account",
	"",
	Array(
		"SET_TITLE" => "Y"
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.account.pay",
	"",
	Array(
		"ELIMINATED_PAY_SYSTEMS" => array("0"),
		"PATH_TO_BASKET" => "/personal/cart",
		"PATH_TO_PAYMENT" => "/personal/order/payment",
		"REFRESHED_COMPONENT_MODE" => "Y",
		"SELL_CURRENCY" => "RUB",
		"SELL_SHOW_FIXED_VALUES" => "Y",
		"SELL_TOTAL" => array("100","200","500","1000","5000",""),
		"SELL_USER_INPUT" => "Y",
		"SELL_VALUES_FROM_VAR" => "N",
		"SET_TITLE" => "Y"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>