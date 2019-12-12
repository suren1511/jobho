<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$show = true;
if (CModule::IncludeModule("iblock")) {

	$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_metro", "PROPERTY_ulica", "PROPERTY_napr", "PROPERTY_yandexmap", "PROPERTY_napr", "PROPERTY_spbokruga", "PROPERTY_group");
	$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE"=>"Y", 'PROPERTY_HOSTEL' => 2321);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNext())
	{
		$arResult["ITEMS"][] = $ob;
	}
}
foreach($arResult["ITEMS"] as $key => $value) {
	foreach($arResult["ITEMS"] as $key2 => $value2) {
		if($value2['ID'] == $value['ID'] && $key2 != $key) {
			unset($arResult["ITEMS"][$key]);
		}		
	}
}
?>

<script src="https://api-maps.yandex.ru/2.1.40/?apikey=fa02dbc3-94b9-44e0-869b-5864dfa662e8&lang=ru_RU" type="text/javascript"></script>
<div id="YMapsID" style="width: 100%; height: 800px !important; margin-top: 15px"></div>

<script type="text/javascript">
    ymaps.ready(function () {
        var myMap = new ymaps.Map('YMapsID', {
            center: [59.940129, 30.305568],
            zoom: 10,
            controls: ['default' , "routeButtonControl"]
        });

        gCollection1 = new ymaps.Clusterer({
            preset: 'islands#invertedBlueClusterIcons',
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        });
  
<?$i=1; $j=1; $k=1;
    foreach($arResult["ITEMS"] as $arElement):
        if($arElement['PROPERTY_YANDEXMAP_VALUE']):
            $coord = explode(",", $arElement['PROPERTY_YANDEXMAP_VALUE']);
            $text = '<a style="text-decoration: none" href="'.$arElement["DETAIL_PAGE_URL"].'"><table class="maintable"><tr><td class="maintable__name" valign="top" colspan="2">'.$arElement["NAME"].'<br></td></tr>';
            $text .= '<tr><td>';

            $metro = $arElement["PROPERTY_METRO_VALUE"];
            $street = $arElement["PROPERTY_ULICA_VALUE"];

            if ($metro) $text .= '<img src="'.SITE_TEMPLATE_PATH.'/img/metro.png" style="height: 11px;margin-right: 5px;"><span class="banner_prop">'.$metro.'</span>';
            if ($metro && $street) $text .= '<br>';
            if ($street) $text .= '<img src="'.SITE_TEMPLATE_PATH.'/img/marker.png" style="height: 11px;margin-right: 5px;"><span class="banner_prop">'.$street.'</span>';

            $napr = $arElement["PROPERTY_NAPR_VALUE"];
            if ($napr) $text .='<br><span class="banner_prop">Направление: '.$napr.'</span>';
            //$text .= '<br><font  style="font-color:#25639A; font-size:12px;font-weight:700;">Узнайте наличие мест: <font color=red><span class="ya-phone">+7 (812) 643 21 38</span></font></font></td>';
            $text .= '</td><tr><th colspan="2">';
            $ar_res = CPrice::GetBasePrice($arElement['ID']);
            $price = explode('.',$ar_res["PRICE"]);
            $text .= '<center>Цена от <span style="font-color:#ffffff;font-weight:700;">'.$price[0].' руб</span></center></th></tr></table></a>';?>

        var placemark<?=$k;?> = new ymaps.Placemark([<?=$coord[0];?>, <?=$coord[1];?>], {
        iconContent: '<?=$k;?>',
        balloonContent: '<?=$text;?>',
		clusterCaption: '<?=$arElement["NAME"];?>',
    }, {
    <?global $USER;
                if ($USER->IsAuthorized()) {
                    $tmp = '';
                    if ($arElement['PROPERTY_SPBOKRUGA_VALUE']) {
                        if ($show) {
                            switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
								case 1763: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 1764: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 1765: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                                case 1766: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                                case 1767: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                                case 2318: $tmp ='preset: "islands#greenStretchyIcon"'; break;
								case 2319: $tmp ='preset: "islands#lightBlueStretchyIcon"'; break;
								case 2320: $tmp ='preset: "islands#blackStretchyIcon"'; break;
                                default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                /*case 503: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                                case 504: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                                case 505: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                                case 506: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 986: $tmp = 'preset: "islands#blackStretchyIcon"'; break;
                                case 1109: $tmp = 'preset: "islands#lightBlueStretchyIcon"'; break;
                                default: $tmp = 'preset: "islands#grayStretchyIcon"'; break;*/
                            }
                        } else {
                            $tmp = 'preset: "islands#blueStretchyIcon"';
                        }
                        $i++;
                    } else {
                        if ($show) {
                            switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
								case 1763: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 1764: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 1765: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                                case 1766: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                                case 1767: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                                case 2318: $tmp ='preset: "islands#greenStretchyIcon"'; break;
								case 2319: $tmp ='preset: "islands#lightBlueStretchyIcon"'; break;
								case 2320: $tmp ='preset: "islands#blackStretchyIcon"'; break;
                                default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                /*case 503: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                                case 504: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                                case 505: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                                case 506: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 986: $tmp = 'preset: "islands#blackStretchyIcon"'; break;
                                case 1109: $tmp ='preset: "islands#lightBlueStretchyIcon"'; break;
                                default: $tmp = 'preset: "islands#grayStretchyIcon"'; break;*/
                            }
                        } else {
                            $tmp = 'preset: "islands#redStretchyIcon"';
                        }
                        $j++;
                    }
                    echo $tmp;
                }
                else {
                    $tmp = '';
                    if ($arElement['PROPERTY_SPBOKRUGA_VALUE']) {
                        if ($show) {
                            switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
								//case 1763: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 1764: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 1765: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 1766: $tmp = 'preset: "islands#violetStretchyIcon"'; break;                                
                                case 2318: $tmp ='preset: "islands#blueStretchyIcon"'; break;
								case 2319: $tmp ='preset: "islands#blueStretchyIcon"'; break;
								case 2320: $tmp ='preset: "islands#blueStretchyIcon"'; break;
                                default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                /*case 503: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 504: $tmp = 'preset: "islands#violetStretchyIcon"'; break;
                                case 505: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 506: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 986: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 1109: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;*/
                            }
                        } else {
                            $tmp = 'preset: "islands#blueStretchyIcon"';
                        }
                        $i++;
                    } else {
                        if ($show) {
                            switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
                                //case 1763: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                                case 1764: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 1765: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                                case 1766: $tmp = 'preset: "islands#violetStretchyIcon"'; break;                              
                                case 2318: $tmp ='preset: "islands#blueStretchyIcon"'; break;
								case 2319: $tmp ='preset: "islands#blueStretchyIcon"'; break;
								case 2320: $tmp ='preset: "islands#blueStretchyIcon"'; break;
                                default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            }
                        } else {
                            $tmp = 'preset: "islands#blueStretchyIcon"';
                        }
                        $j++;
                    }
                    echo $tmp;
                }?>
            }
        );
        gCollection1.add(placemark<?=$k?>);

<?          $k++;
        endif;
    endforeach;?>

        myMap.geoObjects.add(gCollection1);
    });
</script>