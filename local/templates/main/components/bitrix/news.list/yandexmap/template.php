<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode( true );
$show = true;
asort($arResult,"napr");
?>
<script src="https://api-maps.yandex.ru/2.1.40/?lang=ru_RU" type="text/javascript"></script>

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
        foreach($arResult["ITEMS"] as $cell=>$arElement):
            if (strpos($_SERVER["REQUEST_URI"],'obshejitiya_na_karte.php') || ($APPLICATION->GetCurPage(false) === '/')
            || $_SERVER["REQUEST_URI"] == '/obschezhitie-tsenyi/'
            || strpos($_SERVER["REQUEST_URI"],'obschezhitie-tsenyi/?')
            || (strpos($_SERVER["REQUEST_URI"],'best_deals') && !isset($_GET['group']))) {
                $bool = $arElement['PROPERTIES']['mskokruga']['VALUE'];
            }
            elseif (strpos($_SERVER["REQUEST_URI"],'obshejitiya_na_karte_podmoskva.php')
            || strpos($_SERVER["REQUEST_URI"],'obschezhitie-tsenyi/moscow_obl/')
            || strpos($_SERVER["REQUEST_URI"],'dormitory_suburbs/')
            || $_GET['group']=='sub') {
                $bool = $arElement['PROPERTIES']['napr']['VALUE'];
            }
            else $bool = true;
			$metro = $arElement["PROPERTIES"]["metro"]["VALUE"][0];
            if($arElement['PROPERTIES']['yandexmap']['VALUE'] && $bool):
                $coord = explode(",", $arElement['DISPLAY_PROPERTIES']['yandexmap']['VALUE']);
                $text='<a class="balloon_a" href="'.$arElement["DETAIL_PAGE_URL"].'"><table class="maintable bb"><tr><td class="maintable__name" valign="top" colspan="2">'.$arElement["NAME"].'<br /></td></tr><tr><td>';

                $street = $arElement["DISPLAY_PROPERTIES"]["ulica"]["VALUE"];

                if ($metro) $text .= '<img src="/bitrix/templates/jobhostel_standart/images/metro.png"><span class="banner_prop">'.$metro.'</span>';
                if ($metro && $street) $text .= '<br>';
                if ($street) $text .= '<img src="/bitrix/templates/jobhostel_standart/images/marker.png"><span class="banner_prop">'.$street.'</span>';
                
                $mskokruga = $arElement["DISPLAY_PROPERTIES"]["mskokruga"]["DISPLAY_VALUE"];
                if ($mskokruga) $text .='<br><span class="banner_prop">Округ: '.$mskokruga.'</span>';

                $oblrayoni = $arElement["DISPLAY_PROPERTIES"]["oblrayoni"]["DISPLAY_VALUE"];
                if ($oblrayoni) $text .='<br><span class="banner_prop">Населённый пункт: '.$oblrayoni.'</span>';

                $oblnapr = $arElement["DISPLAY_PROPERTIES"]["oblnapr"]["DISPLAY_VALUE"];
                if ($oblnapr) $text .='<br><span class="banner_prop">Шоссе: '.$oblnapr.'</span>';

                $napr = $arElement["DISPLAY_PROPERTIES"]["napr"]["DISPLAY_VALUE"];
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
            balloonContent: '<?=$text;?>'
        }, {
<?global $USER; 
if ($USER->IsAuthorized()) { ?>

              <?$tmp = '';
                if ($arElement['DISPLAY_PROPERTIES']['mskokruga']['VALUE']) {
                    if ($show) {
                        switch ($arElement['PROPERTIES']['group']['VALUE_ENUM_ID']) {
                            case 503: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                            case 504: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                            case 505: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                            case 506: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                            case 986: $tmp = 'preset: "islands#blackStretchyIcon"'; break;
                            case 1109: $tmp = 'preset: "islands#lightBlueStretchyIcon"'; break;
                            case 1149: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                            case 1148: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                           default: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                        }
                    } else {
                        $tmp = 'preset: "islands#blueStretchyIcon"';
                    }
                    $i++;
                } else {
                    if ($show) {
                        switch ($arElement['PROPERTIES']['group']['VALUE_ENUM_ID']) {
                            case 503: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                            case 504: $tmp = 'preset: "islands#greenStretchyIcon"'; break;
                            case 505: $tmp = 'preset: "islands#yellowStretchyIcon"'; break;
                            case 506: $tmp = 'preset: "islands#redStretchyIcon"'; break;
                            case 986: $tmp = 'preset: "islands#blackStretchyIcon"'; break;
                            case 1109: $tmp ='preset: "islands#lightBlueStretchyIcon"'; break;
                            default: $tmp = 'preset: "islands#grayStretchyIcon"'; break;
                        }
                    } else {
                        $tmp = 'preset: "islands#redStretchyIcon"';
                    }
                    $j++;
                }
                echo $tmp;
                ?>
<?}else{?>
	                  <?
                $tmp = '';
                if ($arElement['DISPLAY_PROPERTIES']['mskokruga']['VALUE']) {
                    if ($show) {
                        switch ($arElement['PROPERTIES']['group']['VALUE_ENUM_ID']) {
                            case 503: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 504: $tmp = 'preset: "islands#violetStretchyIcon"'; break;
                            case 505: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 506: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 986: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1109: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                           default: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                        }
                    } else {
                        $tmp = 'preset: "islands#blueStretchyIcon"';
                    }
                    $i++;
                } else {
                    if ($show) {
                        switch ($arElement['PROPERTIES']['group']['VALUE_ENUM_ID']) {
                            case 503: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 504: $tmp = 'preset: "islands#violetStretchyIcon"'; break;
                            case 505: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 506: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 986: $tmp = 'preset: "islands#blueStretchyIcon"'; break;
                            case 1109: $tmp ='preset: "islands#blueBlueStretchyIcon"'; break;
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