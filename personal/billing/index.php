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
	".default", 
	array(
		"ELIMINATED_PAY_SYSTEMS" => array(
			0 => "0",
		),
		"PATH_TO_BASKET" => "/personal/cart",
		"PATH_TO_PAYMENT" => "/personal/order/payment",
		"REFRESHED_COMPONENT_MODE" => "Y",
		"SELL_CURRENCY" => "RUB",
		"SELL_SHOW_FIXED_VALUES" => "Y",
		"SELL_TOTAL" => array(
			0 => "100",
			1 => "200",
			2 => "500",
			3 => "1000",
			4 => "5000",
			5 => "",
		),
		"SELL_USER_INPUT" => "Y",
		"SELL_VALUES_FROM_VAR" => "N",
		"SET_TITLE" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>