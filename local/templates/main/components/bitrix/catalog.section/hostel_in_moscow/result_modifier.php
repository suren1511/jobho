<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

global ${$arParams["FILTER_NAME"]};
$arrFilterParams = ${$arParams["FILTER_NAME"]};

$arFilter = array(
	'IBLOCK_ID'=>IntVal($arResult[IBLOCK_ID]), 
	'ACTIVE'=>'Y',
	'PROPERTY_RAYONMOSKVI_VALUE'=>'_%'
);


if ($arrFilterParams['PROPERTY_mskokruga_VALUE']) {
	$arFilter['PROPERTY_MSKOKRUGA_VALUE'] = $arrFilterParams['PROPERTY_mskokruga_VALUE']; // Округ
}

if ($arrFilterParams['PROPERTY_metro_VALUE']) {
	$arFilter['PROPERTY_METRO_VALUE'] = $arrFilterParams['PROPERTY_metro_VALUE']; // Метро
}



$arSelect = array('ID');
$arr_block_ids = [];
$block_ids = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $block_ids->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arr_block_ids[] = $arFields['ID'];
}


$arResult['POSITION']['yandex_lat'] = 55.753215;
$arResult['POSITION']['yandex_lon'] = 37.622504;
$arResult['POSITION']['yandex_scale']='8';
$arFilter = array('IBLOCK_ID'=>$arResult['IBLOCK_ID'], 'ACTIVE'=>'Y');
if (!empty($arr_block_ids)) {
	$arFilter['ID'] = $arr_block_ids;
}
$arSelect = array('ID', 'NAME', 'PROPERTY_YANDEXMAP');
$mas= CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while($row = $mas ->Fetch()) {
	$arTmp = explode(',', $row['PROPERTY_YANDEXMAP_VALUE']);
	$arResult['POSITION']['PLACEMARKS'][] = array(
		'LON' => $arTmp['1'],
		'LAT' => $arTmp['0'],
		'TEXT' =>$row['NAME'],
	);
}

if (empty($arr_block_ids)) {
	$arResult['POSITION']['PLACEMARKS'] = '';
}

				
// Формирование ссылки для сортировки по цене
use Bitrix\Main\Context;
$request = Context::getCurrent()->getRequest();
if(count($request->getQueryList()) == 0)
{
	$arResult["PRICE_SORT_PAGE"] = "/?sort=catalog_PRICE_1&sort_order=desc&bxajaxid=".$arParams["AJAX_ID"];
}
else
{
	if( strlen($request->getquery("sort"))>0 && strlen($request->getquery("sort_order"))>0 )
	{
		if($request->getquery("sort_order") == "desc")
		{
			$arResult["PRICE_SORT_PAGE"] = str_replace("sort_order=desc", "sort_order=asc", $request->getRequestUri());
		}
		else
		{
			$arResult["PRICE_SORT_PAGE"] = str_replace("sort_order=asc", "sort_order=desc", $request->getRequestUri());
		}
	}
	else
	{
		if( substr($request->getRequestUri(), -1) != "&" )
		{
			$arResult["PRICE_SORT_PAGE"] = $request->getRequestUri() . "&" . "sort=catalog_PRICE_1&sort_order=desc";
		}
		else
		{
			$arResult["PRICE_SORT_PAGE"] = $request->getRequestUri() . "sort=catalog_PRICE_1&sort_order=desc";
		}
	}
}
$arResult["PRICE_SORT_PAGE"] = "BX.ajax.insertToNode('" . $arResult["PRICE_SORT_PAGE"] . "', 'comp_" . $arParams["AJAX_ID"] . "'); return false;";	


// Формирование ajax для кнопки "Показать еще"

if(count($request->getQueryList()) == 0)
{
	$arResult["SHOW_MORE_ELEMENTS"] = "/include_areas/hostel_in_moskov_show_more.php?PAGEN_3=2&bxajaxid=".$arParams["AJAX_ID"];

}
else
{
	$arResult["SHOW_MORE_ELEMENTS"] = "/include_areas/hostel_in_moskov_show_more.php?";
	foreach($request->getQueryList() as $queryNum => $query)
	{
		if($queryNum == "PAGEN_3")
		{
			$query = (int)$query + 1;
		}
		$arResult["SHOW_MORE_ELEMENTS"] .= $queryNum . "=" . $query . "&";
	}
	
	if(strlen($request->getquery("PAGEN_3") == 0))
	{
		$arResult["SHOW_MORE_ELEMENTS"] .= "PAGEN_3=2&";
	}
	
	if(strlen($request->getquery("bxajaxid") == 0))
	{
		$arResult["SHOW_MORE_ELEMENTS"] .= "bxajaxid=".$arParams["AJAX_ID"];
	}
}
$arResult["SHOW_MORE_ELEMENTS"] = "BX.ajax.insertToNode('" . $arResult["SHOW_MORE_ELEMENTS"] . "', 'show-more-1'); return false;";	

$property_enums = CIBlockPropertyEnum::GetList(Array("VALUE" => "ASC"), Array("IBLOCK_ID" => IBLOCK_MOSCOW_ID, "CODE" => array("mskokruga", "metro")));
while ($enum_fields = $property_enums->Fetch()) {
	if ($enum_fields["PROPERTY_CODE"] == "mskokruga") {
		$arResult["OKRUGA"][] = trim($enum_fields["VALUE"]);
	}
	else {
		$arResult["METRO"][] = trim($enum_fields["VALUE"]);
	}
}

foreach ($arResult["ITEMS"] as $cell => $arElement) {
	global $USER;
	$group = $arElement["DISPLAY_PROPERTIES"]['group']['VALUE_XML_ID'];
	$myGroups = $USER->GetUserGroupArray();
    if (in_array(6,$myGroups) || in_array(7,$myGroups)) {
		$group = $arElement["DISPLAY_PROPERTIES"]['group']['VALUE_XML_ID'];
		$style = 'background:none;';
		if (!empty($group)) {
			switch ($group) {
				case 'group2': $style = 'background:rgba(0,255,0,0.3);'; break;
				case 'group3': $style = 'background:rgba(255,255,0,0.3);'; break;
				case 'group4': $style = 'background:rgba(255,0,0,0.3);'; break;
				case 'group5': $style = 'background:rgba(133,133,133,0.3);'; break;
				case 'group6': $style = 'background:rgba(28, 123, 250, 0.3);'; break;
				case 'group8': $style = 'background:rgba(0,255,0,0.3);'; break;
				default: $style = 'background:none;'; break;
			}
		}
	}
	else $style = '';
	$arResult["ITEMS"][$cell]["STYLE"] = $style;
}
