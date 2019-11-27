<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
?>
<?
if (!function_exists('getSliderForItem'))
{
	function getSliderForItem(&$item, $propertyCode, $addDetailToSlider)
	{
		$result = array();

		if (!empty($item) && is_array($item))
		{
			if (
				'' != $propertyCode &&
				isset($item['PROPERTIES'][$propertyCode]) &&
				'F' == $item['PROPERTIES'][$propertyCode]['PROPERTY_TYPE']
			)
			{
				if ('MORE_PHOTO' == $propertyCode && isset($item['MORE_PHOTO']) && !empty($item['MORE_PHOTO']))
				{
					foreach ($item['MORE_PHOTO'] as &$onePhoto)
					{
						$result[] = array(
							'ID' => intval($onePhoto['ID']),
							'SRC' => $onePhoto['SRC'],
							'WIDTH' => intval($onePhoto['WIDTH']),
							'HEIGHT' => intval($onePhoto['HEIGHT'])
						);
					}
					unset($onePhoto);
				}
				else
				{
					if (
						isset($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']) &&
						!empty($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE'])
					)
					{
						$fileValues = (
							isset($item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']['ID']) ?
							array(0 => $item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']) :
							$item['DISPLAY_PROPERTIES'][$propertyCode]['FILE_VALUE']
						);
						foreach ($fileValues as &$oneFileValue)
						{
							$result[] = array(
								'ID' => intval($oneFileValue['ID']),
								'SRC' => $oneFileValue['SRC'],
								'WIDTH' => intval($oneFileValue['WIDTH']),
								'HEIGHT' => intval($oneFileValue['HEIGHT'])
							);
						}
						if (isset($oneFileValue))
							unset($oneFileValue);
					}
					else
					{
						$propValues = $item['PROPERTIES'][$propertyCode]['VALUE'];
						if (!is_array($propValues))
							$propValues = array($propValues);

						foreach ($propValues as &$oneValue)
						{
							$oneFileValue = CFile::GetFileArray($oneValue);
							if (isset($oneFileValue['ID']))
							{
								$result[] = array(
									'ID' => intval($oneFileValue['ID']),
									'SRC' => $oneFileValue['SRC'],
									'WIDTH' => intval($oneFileValue['WIDTH']),
									'HEIGHT' => intval($oneFileValue['HEIGHT'])
								);
							}
						}
						if (isset($oneValue))
							unset($oneValue);
					}
				}
			}
			if ($addDetailToSlider || empty($result))
			{
				if (!empty($item['DETAIL_PICTURE']))
				{
					if (!is_array($item['DETAIL_PICTURE']))
						$item['DETAIL_PICTURE'] = CFile::GetFileArray($item['DETAIL_PICTURE']);
					if (isset($item['DETAIL_PICTURE']['ID']))
					{
						array_unshift(
							$result,
							array(
								'ID' => intval($item['DETAIL_PICTURE']['ID']),
								'SRC' => $item['DETAIL_PICTURE']['SRC'],
								'WIDTH' => intval($item['DETAIL_PICTURE']['WIDTH']),
								'HEIGHT' => intval($item['DETAIL_PICTURE']['HEIGHT'])
							)
						);
					}
				}
			}
		}
		return $result;
	}
}
?>

<? $frame = $this->createFrame()->begin(); ?>
<?
if (!empty($arResult["DISPLAY_PROPERTIES"]['yandexmap']["VALUE"])) {
	list ($latitude, $longitude) = explode(',', $arResult["DISPLAY_PROPERTIES"]['yandexmap']["VALUE"]);
	if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog") && CModule::IncludeModule('iblock')) {
		$arSelect = Array(
			"ID",
			"NAME",
			"PROPERTY_yandexmap",
			"PROPERTY_ulica",
			"PROPERTY_metro",
			"PROPERTY_rayonmoskvi",
			"PROPERTY_oblrayoni",
			"PROPERTY_oblnapr",
			"PROPERTY_rayonspb",
			"DETAIL_PAGE_URL");
		
		$arFilter = Array("IBLOCK_ID" => $arResult['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => 'Y');
		
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 3000), $arSelect);
		while ($ob = $res->GetNextElement()) {
			$arFieldsOtherHostel[] = $ob->GetFields();
		}
	}
	?>
	<br>
	<br>
	<div>
		<a id="tomap"></a>
		<h2>Карта проезда и ближайшие общежития:</h2>
		<div id="YMapsID" name="my-map" class="my-map"></div>
	</div>
	
	<script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&amp;lang=ru-RU&amp;onload=init" type="text/javascript"></script>
	<script type="text/javascript">
		var myMap;
		ymaps.ready(function () {
			myMap = new ymaps.Map("YMapsID", {
				center: [<?=$latitude?>,<?=$longitude?>],
				zoom: 12
			});
			myMap.controls.add(
				new ymaps.control.ZoomControl()
			);
			<?if (is_array($arFieldsOtherHostel)):?>

			<?foreach($arFieldsOtherHostel as $arElementOtherHostel):
				if ($arElementOtherHostel['PROPERTY_YANDEXMAP_VALUE']):
					if ($arElementOtherHostel['PROPERTY_YANDEXMAP_VALUE'] != $arResult["DISPLAY_PROPERTIES"]['yandexmap']["VALUE"]):
						$masXY = explode(',', $arElementOtherHostel['PROPERTY_YANDEXMAP_VALUE']);
						if ((abs($latitude - $masXY[0]) < 0.1) && (abs($longitude - $masXY[1]) < 0.1)) :
							
							$metro = $arElementOtherHostel["PROPERTY_METRO_VALUE"];
							
							$text='<a class="balloon_a" href="'.$arElementOtherHostel["DETAIL_PAGE_URL"].'"><table class="maintable"><tr><td class="maintable__name" valign="top" colspan="2">'.$arElementOtherHostel["NAME"].'<br /></td></tr><tr><td>';

				            $street = $arElementOtherHostel["PROPERTY_ULICA_VALUE"];

				            if ($metro) $text .= '<img src="'.SITE_TEMPLATE_PATH.'/img/metro.png" style="margin-right: 5px;"><span class="banner_prop">'.$metro.'</span>';
				            if ($metro && $street) $text .= '<br>';
				            if ($street) $text .= '<img src="'.SITE_TEMPLATE_PATH.'/img/marker.png" style="margin-right: 5px;"><span class="banner_prop">'.$street.'</span>';
				           
							$rayonmoskvi = $arElementOtherHostel["PROPERTY_RAYONMOSKVI_VALUE"];

							if ($rayonmoskvi) $text .='<br><span class="banner_prop">Район.: '.$rayonmoskvi.'</span></td>';

							$oblrayoni = $arElementOtherHostel["PROPERTY_OBLRAYONI_VALUE"];
							$oblnapr = $arElementOtherHostel["PROPERTY_OBLNAPR_VALUE"];

							if ($oblrayoni) $text .='<br><span class="banner_prop">Населённый пункт: '.$oblrayoni.'</span>';
							if ($oblnapr) $text .='<br><span class="banner_prop">Шоссе: '.$oblnapr.'</span>';
							
							$rayonspb = $arElementOtherHostel["PROPERTY_RAYONSPB_VALUE"];
							if ($rayonspb) $text .='<br><span class="banner_prop">Район: '.$rayonspb.'</span>';

				            $text .= '</td><tr><th colspan="2">';
				            $ar_res = CPrice::GetBasePrice($arElementOtherHostel['ID']);
				            $price = explode('.',$ar_res["PRICE"]);
				            $text .= '<center>Цена от <span style="font-color:#ffffff;font-weight:700;">'.$price[0].' руб.</span></center>';
				            $text .= '</th></tr>';
				            $text .= '</table></a>';
							?>
							myMap.geoObjects.add(
								new ymaps.Placemark(
									[<?=$masXY[0]?>,<?=$masXY[1]?>],
									{balloonContent: '<?=$text?>'},
									{preset: "twirl#blueStretchyIcon"}
									)
								);
							<?
						endif;
					endif;
				endif;
				endforeach; ?>


				myMap.geoObjects.add(
					new ymaps.Placemark(
							[<?=$latitude?>,<?=$longitude?>],
							{balloonContent: '<?=$arResult["NAME"]?>'},
							{preset: "twirl#redStretchyIcon"}
						)
				);
			<?endif;?>
		});
	</script>

<? } ?>
<? $frame->beginStub(); ?>
Загрузка...
<? $frame->end(); ?>

