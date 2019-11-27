<?php
foreach ($arResult["ITEMS"] as $key => $arElem) {
    if (!$arElem['PROPERTIES'] && !$arElem["DISPLAY_PROPERTIES"]) {
        $display["yandexmap"] = CIBlockElement::GetProperty($arElem["IBLOCK_ID"], $arElem["ID"], array(), Array("CODE"=>"yandexmap"))->Fetch();
        $properties["yandexmap"] = CIBlockElement::GetProperty($arElem["IBLOCK_ID"], $arElem["ID"], array(), Array("CODE"=>"yandexmap"))->Fetch();
        $properties["mskokruga"] = CIBlockElement::GetProperty($arElem["IBLOCK_ID"], $arElem["ID"], array(), Array("CODE"=>"mskokruga"))->Fetch();
        $properties["napr"] = CIBlockElement::GetProperty($arElem["IBLOCK_ID"], $arElem["ID"], array(), Array("CODE"=>"napr"))->Fetch();
        $properties["oblrayoni"] = CIBlockElement::GetProperty($arElem["IBLOCK_ID"], $arElem["ID"], array(), Array("CODE"=>"oblrayoni"))->Fetch();
        $display["metro"] = CIBlockElement::GetProperty($arElem["IBLOCK_ID"], $arElem["ID"], array(), Array("CODE"=>"metro"))->Fetch();
        $display["ulica"] = CIBlockElement::GetProperty($arElem["IBLOCK_ID"], $arElem["ID"], array(), Array("CODE"=>"ulica"))->Fetch();

        $arResult["ITEMS"][$key]["PROPERTIES"] = $properties;
        $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"] = $display;
    }
}
?>