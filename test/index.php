<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?php
$res = CIBlockElement::GetByID(12320);
while($ob = $res->GetNextElement()){
  $arFields = $ob->GetFields();
  $arProps = $ob->GetProperties();
  ?>
  <!--<? print_r($arFields)?>-->
  <!--<? print_r($arProps)?>-->
<? }
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>