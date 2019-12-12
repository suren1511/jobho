<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

$show = true;




if(strpos($_SERVER["HTTP_REFERER"],'hostel_for_ck')){
if (CModule::IncludeModule("iblock")) {

	$arSelect = Array("IBLOCK_ID", "ID", "PROPERTY_TIPOBSHEJITIYA", "NAME", "DETAIL_PAGE_URL", "PROPERTY_metro", "PROPERTY_rayonmoskvi", "PROPERTY_mskokruga", "PROPERTY_ulica", "PROPERTY_napr", "PROPERTY_yandexmap", "PROPERTY_oblrayoni", "PROPERTY_oblnapr", "PROPERTY_group");
	$arFilter = Array("IBLOCK_ID" => 3, "ACTIVE"=>"Y", "PROPERTY_TIPOBSHEJITIYA" => 2322, "!PROPERTY_RAYONMOSKVI"=>false);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNext())
	{
		$arResult["ITEMS"][] = $ob;
	}
	//echo count($arResult["ITEMS"]);
}	
}else{
	if (CModule::IncludeModule("iblock")) {

		$arSelect = Array("IBLOCK_ID", "ID", "PROPERTY_TIPOBSHEJITIYA", "NAME", "DETAIL_PAGE_URL", "PROPERTY_metro", "PROPERTY_rayonmoskvi", "PROPERTY_mskokruga", "PROPERTY_ulica", "PROPERTY_napr", "PROPERTY_yandexmap", "PROPERTY_oblrayoni", "PROPERTY_oblnapr", "PROPERTY_group");
		$arFilter = Array("IBLOCK_ID" => 3, "ACTIVE"=>"Y");
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
}

?>

<script src="https://api-maps.yandex.ru/2.1.40/?apikey=fa02dbc3-94b9-44e0-869b-5864dfa662e8&lang=ru_RU" type="text/javascript"></script>
<div id="YMapsID" class="bx-yandex-alone-map"></div>
    <script type="text/javascript">
        ymaps.ready(function () {
        var myMap = new ymaps.Map('YMapsID',
            {
                center: [55.76, 37.64],
                zoom: 10,
                controls: ['default' , "routeButtonControl"]
            }
        );

        gCollection1 = new ymaps.Clusterer({
            preset: 'islands#invertedBlueClusterIcons',
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        });
<? $i=1; $j=1; $k=1;
        foreach($arResult["ITEMS"] as $arElement):
		
            if (strpos($_SERVER["REQUEST_URI"],'obshejitiya_na_karte.php') || ($APPLICATION->GetCurPage(false) === '/')
            || $_SERVER["REQUEST_URI"] == '/obschezhitie-tsenyi/'
            || strpos($_SERVER["REQUEST_URI"],'obschezhitie-tsenyi/?')
            || (strpos($_SERVER["REQUEST_URI"],'best_deals') && !isset($_GET['group']))) {
                $bool = $arElement['PROPERTY_MSKOKRUGA_VALUE'];
            }
            elseif (strpos($_SERVER["REQUEST_URI"],'obshejitiya_na_karte_podmoskva.php')
            || strpos($_SERVER["REQUEST_URI"],'obschezhitie-tsenyi/moscow_obl/')
            || strpos($_SERVER["REQUEST_URI"],'dormitory_suburbs/')
            || $_GET['group']=='sub') {
                $bool = $arElement['PROPERTY_NAPR_VALUE'];
            }
            else $bool = true;
			
			if (strpos($_SERVER["HTTP_REFERER"],'hostel_for_child')) {	
				$boolC = false;
				$bool = true;
                if($arElement['PROPERTY_TIPOBSHEJITIYA_ENUM_ID'] == 1113)
					$boolC = true;
            }
			if (strpos($_SERVER["HTTP_REFERER"],'hostel_for_ck')) {	
				$boolC = false;
				$bool = true;
                if($arElement['PROPERTY_TIPOBSHEJITIYA_ENUM_ID'] == 2322)
					$boolC = true;
            }
            $metro = $arElement["PROPERTY_METRO_VALUE"];
            if($arElement['PROPERTY_YANDEXMAP_VALUE'] && $bool):
				if(isset($boolC) && !$boolC) {
					continue;
				}
                $coord = explode(",", $arElement['PROPERTY_YANDEXMAP_VALUE']);
                $text='<a class="balloon_a" href="'.$arElement["DETAIL_PAGE_URL"].'"><table class="maintable"><tr><td class="maintable__name" valign="top" colspan="2">'.$arElement["NAME"].'<br /></td></tr><tr><td>';

                $street = $arElement["PROPERTY_ULICA_VALUE"];

                if ($metro) $text .= '<img src="'.SITE_TEMPLATE_PATH.'/img/metro.png"><span class="banner_prop">'.$metro.'</span>';
                if ($metro && $street) $text .= '<br>';
                if ($street) $text .= '<img src="'.SITE_TEMPLATE_PATH.'/img/marker.png"><span class="banner_prop">'.$street.'</span>';
                
                $mskokruga = $arElement["PROPERTY_MSKOKRUGA_VALUE"];
                if ($mskokruga) $text .='<br><span class="banner_prop">Округ: '.$mskokruga.'</span>';

                $oblrayoni = $arElement["PROPERTY_OBLRAYONI_VALUE"];
                if ($oblrayoni) $text .='<br><span class="banner_prop">Населённый пункт: '.$oblrayoni.'</span>';

                $oblnapr = $arElement["PROPERTY_OBLNAPR_VALUE"];
                if ($oblnapr) $text .='<br><span class="banner_prop">Шоссе: '.$oblnapr.'</span>';

                $napr = $arElement["PROPERTY_NAPR_VALUE"];
                if ($napr) $text .='<br><span class="banner_prop">Направление: '.$napr.'</span>';

                //$text .= '<br><font  style="font-color:#df1d26; font-size:12px;">Узнайте наличие мест.: <font color=red><span class="ya-phone">+7 (495) 215-10-53</span></font></font></td>';
                $text .= '</td><tr><th colspan="2">';
                $ar_res = CPrice::GetBasePrice($arElement['ID']);
                $price = explode('.',$ar_res["PRICE"]);
                $text .= '<center>Цена от <span style="font-color:#ffffff;font-weight:700;">'.$price[0].' руб.</span></center>';
                $text .= '</th></tr>';
                $text .= '</table></a>';

        ?>

        var placemark<?=$k;?> = new ymaps.Placemark([<?=$coord[0];?>, <?=$coord[1];?>], {
            iconContent: '<?=$k;?>',
            balloonContent: '<?=$text;?>',
			clusterCaption: '<?=$arElement["NAME"];?>',
        }, {
		<?global $USER; 
		if ($USER->IsAuthorized()) { ?>
              <?$tmp = '';
                if ($arElement['PROPERTY_MSKOKRUGA_VALUE']) {
                    if ($show) {
                        switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
                            case 1635: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                            case 1633: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                            case 1632: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                            case 1637: $tmp = 'preset: "islands#blackStretchyIcon"'; break;
                            case 1636: $tmp = 'preset: "islands#lightBlueStretchyIcon"'; break;
                            case 1631: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                            case 1634: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                           default: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                        }
                    } else {
                        $tmp = 'preset: "islands#blueStretchyIcon"';
                    }
                    $i++;
                } else {
                    if ($show) {
                        switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
                           case 1635: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                            case 1633: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                            case 1632: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                            case 1637: $tmp = 'preset: "islands#blackStretchyIcon"'; break;
                            case 1636: $tmp = 'preset: "islands#lightBlueStretchyIcon"'; break;
                            case 1631: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                            case 1634: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                            default: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                        }
                    } else {
                        $tmp = 'preset: "islands#redStretchyIcon"';
                    }
                    $j++;
                }
                echo $tmp;
                ?>
			<? } else { ?>
                      <?
                $tmp = '';
                if ($arElement['PROPERTY_MSKOKRUGA_VALUE']) {
                    if ($show) {
                        switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
                            case 1634: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1635: $tmp = 'preset: "islands#violetStretchyIcon"'; break;
                            case 1633: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1632: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1637: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1636: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                           default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                        }
                    } else {
                        $tmp = 'preset: "islands#blueStretchyIcon"';
                    }
                    $i++;
                } else {
                    if ($show) {
                        switch ($arElement['PROPERTY_GROUP_ENUM_ID']) {
                            case 1634: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1635: $tmp = 'preset: "islands#violetStretchyIcon"'; break;
                            case 1633: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1632: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1637: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1636: $tmp ='preset: "islands#blueBlueStretchyIcon"'; break;
                            default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                        }
                    } else {
                        $tmp = 'preset: "islands#blueStretchyIcon"';
                    }
                    $j++;
                }
                echo $tmp;
            }?>
        });
        gCollection1.add(placemark<?=$k?>);

<?      $k++;
    endif;
endforeach;?>
        myMap.geoObjects.add(gCollection1);
    });
</script>
