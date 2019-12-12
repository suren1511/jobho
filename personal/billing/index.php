<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Финансы");
?>
  <div class="pa__block">
    <div class="pa__navi">
      <ul>
        <li class="active"><a href="/personal/billing/">Средства на счете</a></li>
        <li><a href="/personal/billing/istoriya-popolneniy.php">История пополнения</a></li>
        <li><a href="/personal/billing/istoriya-raskhodov.php">История расходов</a></li>
      </ul>
    </div>
    <div class="pa__content">
      <div class="pa__balance">
        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.account", 
	"amt", 
	array(
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => "amt"
	),
	false
);?>
      </div>
    </div>
  </div>




<?$APPLICATION->IncludeComponent(
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
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>