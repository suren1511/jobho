<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
CModule::IncludeModule("sale");
$res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => $USER->GetID()));
while ($arFields = $res->Fetch())
{?>
  <tr>
    <td><?=$arFields["ID"]?></td>
    <td><?=$arFields["TRANSACT_DATE"]?></td>
    <td><?=($arFields["DEBIT"]=="Y")?"+":"-"?><?=SaleFormatCurrency($arFields["AMOUNT"], $arFields["CURRENCY"])?><br /><small>(<?=($arFields["DEBIT"]=="Y")?"на счет":"со счета"?>)</small></td>
    <td><?=$arFields["NOTES"]?></td>
  </tr>
<?}?>
