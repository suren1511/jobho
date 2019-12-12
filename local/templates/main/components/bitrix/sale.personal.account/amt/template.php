<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (is_array($arResult["ACCOUNT_LIST"]))
{

	?>
  <?
  foreach($arResult["ACCOUNT_LIST"] as $accountValue)
  {
    ?>
  <div class="pa__balance-name">Баланс</div>
  <div class="pa__balance-price"><?=$accountValue['SUM']?></div>
    <?}?>
	<?
}