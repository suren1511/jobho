<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode( true );
?>

<div class="vacancies">
<?if($_REQUEST["hit"] == "Y"){
$key=0;?>
<?foreach($arResult["SECTIONS"] as $arSection){
$arFields=Array();
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "PROPERTY_GUT_VALUE"=>"Y", "SECTION_ID"=>$arSection["ID"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array());
while($ob = $res->GetNextElement()){
  $arFields = $ob->GetFields();
}
if(!$arFields == Array()){
	$key=$key+1;?>
	

	<?CModule::IncludeModule("iblock");
	$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "PROPERTY_GUT_VALUE"=>"Y", "SECTION_ID"=>$arSection["ID"]);
	$ress = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array());?>
	<?while($ob = $ress->GetNextElement()){
	$arFieldss = $ob->GetFields();}
	?>
	<?if ($arFieldss) {?>
	 <a ctrl="y" class="vacancies__sect" href="JavaScript:void(0);"><?=$arSection["NAME"]?></a>
	<div class="vacancies__item">
	<?$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "PROPERTY_GUT_VALUE"=>"Y", "SECTION_ID"=>$arSection["ID"]);
	$ress = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array());?>
	<?while($ob = $ress->GetNextElement()){
	$arFields = $ob->GetFields();?>
	<a class="vacancies__link" href="<?=$arFields["DETAIL_PAGE_URL"]?>"><?=$arFields["NAME"]?></a><br />
	<?}?>
	</div>
	<?}}?>
<?}?>
<?}else{?>
<?foreach($arResult["SECTIONS"] as $key=>$arSection){
	$key=$key+1;?>
	<?CModule::IncludeModule("iblock");$arFieldss = array();
	$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y", "SECTION_ID"=>$arSection["ID"]);
	$ress = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array());?>
	<?while($ob = $ress->GetNextElement()){
	$arFieldss = $ob->GetFields();}
	?>
	<?if (!$arFieldss == Array()) {?>
	 <a ctrl="y" class="vacancies__sect" href="JavaScript:void(0);"><?=$arSection["NAME"]?></a>
	<div class="vacancies__item">
	<?CModule::IncludeModule("iblock");
	$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ACTIVE"=>"Y",  "SECTION_ID"=>$arSection["ID"]);
	$ress = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array());?>
	<?while($ob = $ress->GetNextElement()){
	$arFields = $ob->GetFields();?>
	 <a class="vacancies__link" href="<?=$arFields["DETAIL_PAGE_URL"]?>"><?=$arFields["NAME"]?></a><br />
	<?}?>
	</div>
<?}}?>
<?}?>
</div>

