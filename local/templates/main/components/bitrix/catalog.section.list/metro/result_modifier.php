<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
 
    if(CModule::IncludeModule('iblock')) { 
		$curPage = $APPLICATION->GetCurDir();
		$curPage = explode('/', $curPage);

		$rs_items = CIBLockElement::GetList (Array(), Array("IBLOCK_ID" => 52, "SECTIONS_CODE" => "metro_directory", "XML_ID" => $curPage[1],"ACTIVE" => "Y"), false, false, Array('*'));
		if ($db_item = $rs_items->GetNextElement())
		{
			$ar_res1 = $db_item->GetFields();
			if($ar_res1["CODE"] != ''){
				$i = 0;
				$rs_items2 = CIBLockElement::GetList (Array(), Array("IBLOCK_ID" => 20, "PROPERTY_metro_VALUE_XML_ID" => "Y", "ACTIVE" => "Y"), false, false, Array('*'));
				while($db_item2 = $rs_items2->GetNextElement())
				{
					$ar_res2 = $db_item2->GetFields();
					$ar_res3 = $db_item2->GetProperties();
					if($ar_res1["CODE"] ===  $ar_res3["metro"]["VALUE_XML_ID"][0]){
						$arPrice = GetCatalogProductPriceList($ar_res2["ID"], "SORT", "ASC");
						
						$arResult["ITEM"][$i]["ID"] = $ar_res2["ID"];
						$arResult["ITEM"][$i]["DETAIL_PAGE_URL"] = $ar_res2["DETAIL_PAGE_URL"];
						$arResult["ITEM"][$i]['PREVIEW_PICTURE'] = $ar_res2['PREVIEW_PICTURE'];
						$arResult["ITEM"][$i]["NAME"] = $ar_res2["~NAME"];
						$arResult["ITEM"][$i]["PRICES"] = $arPrice[0]["PRICE"];
						$arResult["ITEM"][$i]["PROPERTIES"]["metro"] = $ar_res3["metro"];
						$arResult["ITEM"][$i]["PROPERTIES"]["ulica"] = $ar_res3["ulica"];
						$arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"] = $ar_res3["mskokruga"];						
						$arResult["ITEM"][$i]["PROPERTIES"]["kolchel"] = $ar_res3["kolchel"];						
						$arResult["ITEM"][$i]["PROPERTIES"]["gragdanstvo"] = $ar_res3["gragdanstvo"];						
						$arResult["SEO_OKRUG"] = $ar_res3["mskokruga"]["VALUE"][0];						
						$minPrice[] = $arPrice[0]["PRICE"];
						
					}
					$i++;
					
				}

				$minPrice = min($minPrice);
				
				$APPLICATION->SetTitle("Общежития у метро ". $ar_res1["~NAME"]);
				$APPLICATION->SetPageProperty("title", "Общежития у метро ".$ar_res1["~NAME"].", Москва - снять комнату недорого без посредников. Цена от ".$minPrice." руб.");
				$APPLICATION->SetPageProperty("description", "Комфортные Общежития у метро ".$ar_res1["~NAME"]." по доступным ценам представлены на сайте jobhostel.ru. Цена от ".$minPrice." руб. Недорогие койко-места, удобное месторасположение, соответствие нормам проживания и качественное обслуживание комнат :: ДжобХостел");
				
					
			}
		
		}
		
	}
  
?>
