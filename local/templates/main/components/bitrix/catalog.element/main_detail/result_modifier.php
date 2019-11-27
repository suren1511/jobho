<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$arResult["HOSTEL_DESCRIPTION"] = array(
	"telek_v_komnate" => $arResult["PROPERTIES"]["telek_v_komnate"],
	"telek_na_etazhe" => $arResult["PROPERTIES"]["telek_na_etazhe"],
	"holod_v_komnate" => $arResult["PROPERTIES"]["holod_v_komnate"],
	"holod_na_kyhne" => $arResult["PROPERTIES"]["holod_na_kyhne"],
	"dush_v_komnate" => $arResult["PROPERTIES"]["dush_v_komnate"],
	"dush_na_etazhe" => $arResult["PROPERTIES"]["dush_na_etazhe"],
	"sanyzel_v_komnate" => $arResult["PROPERTIES"]["sanyzel_v_komnate"],
	"sanyzel_na_etazhe" => $arResult["PROPERTIES"]["sanyzel_na_etazhe"],
	"syshilka" => $arResult["PROPERTIES"]["syshilka"],
	"stiral_mashin" => $arResult["PROPERTIES"]["stiral_mashin"],
	"wi_fi" => $arResult["PROPERTIES"]["wi_fi"],
	"microvolnovka" => $arResult["PROPERTIES"]["microvolnovka"],
	"belie_raz_v_7_dnei" => $arResult["PROPERTIES"]["belie_raz_v_7_dnei"],
	"belie_raz_v_10_dnei" => $arResult["PROPERTIES"]["belie_raz_v_10_dnei"],
	"belie_raz_v_14_dnei" => $arResult["PROPERTIES"]["belie_raz_v_14_dnei"],
	"vlazhn_yborka" => $arResult["PROPERTIES"]["vlazhn_yborka"],
	"parkovka" => $arResult["PROPERTIES"]["parkovka"],
	"register_in_grazhdan" => $arResult["PROPERTIES"]["register_in_grazhdan"],
);

if($arResult["DISPLAY_PROPERTIES"]["mskokruga"]["DISPLAY_VALUE"] || $arResult["DISPLAY_PROPERTIES"]["rayonmoskvi"]["DISPLAY_VALUE"]) {
	$arResult["BREADCRUMB"]["NAME"] = "Общежития Москвы";
	$arResult["BREADCRUMB"]["URL"] = "/hostel_in_msc/";
}
elseif($arResult["DISPLAY_PROPERTIES"]["rayonspb"]["DISPLAY_VALUE"] || $arResult["DISPLAY_PROPERTIES"]["spbokruga"]["DISPLAY_VALUE"]){
	$arResult["BREADCRUMB"]["NAME"] = "Общежития Санкт-Петербурга";
	$arResult["BREADCRUMB"]["URL"] = "/hostel_in_spb/";
}
elseif($arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"] || $arResult["DISPLAY_PROPERTIES"]["napr"]["DISPLAY_VALUE"]) {
	$arResult["BREADCRUMB"]["NAME"] = "Общежития Подмосковья";
	$arResult["BREADCRUMB"]["URL"] = "/dormitory_suburbs/";
}

$APPLICATION->SetPageProperty("title", "Общежитие "
	.$arResult["NAME"].
	($arResult["DISPLAY_PROPERTIES"]["metro"]["DISPLAY_VALUE"] ? " у метро ".$arResult["DISPLAY_PROPERTIES"]["metro"]["DISPLAY_VALUE"] : " ")
	." от "
	.$arResult["MIN_PRICE"]["PRINT_VALUE"]
	.($arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"] ? ", ".$arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"] : ""));

$APPLICATION->SetPageProperty("description", "Снять койко-место в общежитии "
	.$arResult["NAME"].
	($arResult["DISPLAY_PROPERTIES"]["metro"]["DISPLAY_VALUE"] ? " у метро ".$arResult["DISPLAY_PROPERTIES"]["metro"]["DISPLAY_VALUE"] : " ")
	." от "
	.$arResult["MIN_PRICE"]["PRINT_VALUE"]
	.($arResult["DISPLAY_PROPERTIES"]["metro"]["DISPLAY_VALUE"] ? ", комфортные условия проживания, заселение в день обращения | ДжобХостел" : "")
	.($arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"] ? ", ".$arResult["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"] . " | Есть места | Комфортное проживание по приемлемой цене! | Заселение в день обращения" : ""));

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
