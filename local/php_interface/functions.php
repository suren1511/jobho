<?php


/*AddEventHandler("main", "OnEndBufferContent", "deleteKernelJs");
AddEventHandler("main", "OnEndBufferContent", "deleteKernelCss");

function deleteKernelJs(&$content) {
   global $USER, $APPLICATION;
   if((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/")!==false) return;
   if($APPLICATION->GetProperty("save_kernel") == "Y") return;

   $arPatternsToRemove = Array(
      '/<script.+?src=".+?kernel_main\/kernel_main\.js\?\d+"><\/sc ript\>/',
      '/<script.+?src=".+?bitrix\/js\/main\/core\/core[^"]+"><\/sc ript\>/',
      '/<script.+?>BX\.(setCSSList|setJSList)\(\[.+?\]\).*?<\/sc ript>/',
      '/<script.+?>if\(\!window\.BX\)window\.BX.+?<\/sc ript>/',
      '/<script[^>]+?>\(window\.BX\|\|top\.BX\)\.message[^<]+<\/sc ript>/',
   );

   $content = preg_replace($arPatternsToRemove, "", $content);
   $content = preg_replace("/\n{2,}/", "\n\n", $content);
}

function deleteKernelCss(&$content) {
   global $USER, $APPLICATION;
   if((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/")!==false) return;
   if($APPLICATION->GetProperty("save_kernel") == "Y") return;

   $arPatternsToRemove = Array(
      '/<link.+?href=".+?kernel_main\/kernel_main\.css\?\d+"[^>]+>/',
      '/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
      '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/styles.css[^"]+"[^>]+>/',
      '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/template_styles.css[^"]+"[^>]+>/',
   );

   $content = preg_replace($arPatternsToRemove, "", $content);
   $content = preg_replace("/\n{2,}/", "\n\n", $content);
}*/


//Названия табов для страниц с общежитиями
function connectTabs($url) {
	$currenttab = array();
	$urls = array(
		array(
			"/hostel_in_msc/" => "Общежития Москвы",
			"/dormitory_suburbs/" => "Общежития Подмосковья",
			"/hostel_in_spb/" => "Общежития Санкт-Петербурга"
		),
		array(
			"/hostel_for_child/" => "Размещение с детьми <br>в Москве",
			"/hostel_for_child/dormitory_suburbs/" => "Размещение с детьми в Подмосковье",
			"/hostel_for_child/hostel_in_spb/" => "Размещение с детьми <br>в Санкт-Петербурге"
		),
		array(
			"/hostel_for_ck/" => "Служебный",
			"/hostel_for_ck/dormitory_suburbs/" => "Служебный в Подмосковье",
			"/hostel_for_ck/hostel_in_spb/" => "Служебный в Санкт-Петербурге"
		),
		array(
			"/hostels_in_msc/" => "Хостелы Москвы",
			"/hostels_podmsc/" => "Хостелы Подмосковья",
			"/hostels_in_spb/" => "Хостелы Санкт-Петербурга"
		),
		array(
			"/obshejitiya/" => "Общежития Москвы",
			"/dormitory_suburbs/" => "Общежития Подмосковья",
			"/hostel_in_spb/" => "Общежития Санкт-Петербурга"
		),
		array(
			"/hostel_for_nonresident/" => "Общежития для иногородних <br>в Москве",
			"/hostel_for_nonresident/dormitory_suburbs/" => "Общежития для иногородних <br>в Подмосковье",
			"/hostel_for_nonresident/hostel_in_spb/" => "Общежития для иногородних <br>в Санкт-Петербурге"
		),
		array(
			"/hostel_family/" => "Семейные общежития Москвы",
			"/hostel_family/dormitory_suburbs/" => "Семейные общежития Подмосковья",
			"/hostel_family/hostel_in_spb/" => "Семейные общежития Санкт-Петербурга"
		),
		array(
			"/hostel_for_woman/" => "Женские общежития Москвы",
			"/hostel_for_woman/dormitory_suburbs/" => "Женские общежития Подмосковья",
			"/hostel_for_woman/hostel_in_spb/" => "Женские общежития Санкт-Петербурга"
		),
		array(
			"/hostel_for_two_persons/" => "Двухместные общежития Москвы",
			"/hostel_for_two_persons/dormitory_suburbs/" => "Двухместные общежития Подмосковья",
			"/hostel_for_two_persons/hostel_in_spb/" => "Двухместные общежития Санкт-Петербурга"
		),
		array(
			"/aktsii/smartfon-v-podarok.php" => "Общежития Москвы",
			"/aktsii/dormitory_suburbs/" => "Общежития Подмосковья",
			"/aktsii/hostel_in_spb/" => "Общежития Санкт-Петербурга"
		),
		array(
			"/best_deals/" => "Общежития Москвы",
			"/best_deals/dormitory_suburbs/" => "Общежития Подмосковья"
		),
	);
	foreach ($urls  as $tabs) {
		foreach ($tabs as $key => $value) {
			if ($url == $key) {
				return $tabs;
			}
		}
		
		
	}
}

//Для вставки водяного знака в доп. фотографии общежитий
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("ResizeImage", "OnBeforeIBlockElementUpdate"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("ResizeImage", "OnBeforeIBlockElementUpdate"));
class ResizeImage
{
    function OnBeforeIBlockElementUpdate(&$arFields)
    {
    	CModule::IncludeModule("iblock");
          	if (!empty($arFields["PROPERTY_VALUES"]["255"]["n0"])) {
			
    		$PROPERTY_CODE = "DOP_FOTO";  // код свойства

			$imageMaxWidth = 1500; 
			$imageMaxHeight = 1500; 

			$arWaterMark = array(
				"name" => "watermark", 
				"position" => "bottomright", 
				"type" => "image", 
				"size" => "real", 
				"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/logo.png", 
				"fill" => "resize"
			);

			$arResultTemp = [];
			foreach($arFields["PROPERTY_VALUES"]["255"] as $k => $v){
			    if(preg_match("/^n\d+$/", $k)){
			        $arResultTemp[$k] = $v;
			    }
			}

			foreach ($arResultTemp as $item) {
				$imageTmpFile = str_replace("default", $item["VALUE"]["name"], $item["VALUE"]["tmp_name"]);
				rename($item["VALUE"]["tmp_name"], $imageTmpFile);

				$tmpFilePath = $_SERVER['DOCUMENT_ROOT']."/upload/tmp/".$PROPERTY_CODE."/".$item["VALUE"]["name"];
				
				if (!CFile::IsImage($tmpFilePath))
					continue;
				
				$arResizeImage = CFile::ResizeImageFile( 
					$sourceFile = $imageTmpFile,
					$destinationFile = $tmpFilePath,
					$arSize = array(
					 'width' => $imageMaxWidth,
					 'height' => $imageMaxHeight
					),
					$resizeType = BX_RESIZE_IMAGE_PROPORTIONAL,
					$waterMark = array(),
					$jpgQuality = false,
					$arFilters = Array($arWaterMark)
				);

				 if ($arResizeImage) {
				 	copy($tmpFilePath, $imageTmpFile);
					rename($imageTmpFile, $item["VALUE"]["tmp_name"]);
					unlink($tmpFilePath);
				 }   
			}
		}
	}
}

function transform_word($word)
{
	$word = urlencode($word);
	$url_in = "http://pyphrasy.herokuapp.com/inflect?phrase={$word}&cases=loct";
	$fp = file_get_contents($url_in);
	if (!$fp) {
	    $title_enc = $myroc["title"];
	    return false;
	} else {
	    $title_enc = json_decode($fp, true);
	    return $title_enc;
	}
}



AddEventHandler("main", "OnEndBufferContent", "removeType");
function removeType(&$content)
{
   $content = replace_output($content);
}
function replace_output($d)
{
   return str_replace(' type="text/javascript"', "", $d);
}

?>