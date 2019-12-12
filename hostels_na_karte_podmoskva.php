<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "Адреса хостелов на карте Москвы");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "Компания «ДжобХостел» занимается поиском и арендой хостелов для рабочих. В данном разделе вы можете посмотреть адреса доступных общежитий на карте Москвы. ");
$APPLICATION->SetTitle("Адреса хостелов на карте");
$APPLICATION->AddChainItem("Хостелы на карте");
?>
<p>
     Вы можете найти хостел на карте Москвы,&nbsp;Подмосковья или&nbsp;Санкт-Петербурга&nbsp;рядом с вашим объектом. Для этого введите в строку <span style="font-weight:bold">«Поиск на карте»</span> адрес объекта (город, метро или улицу) и нажмите кнопку <span style="font-weight:bold">«Найти»</span>. При помощи шкалы слева <span style="font-weight:bold">«+»</span> и <span style="font-weight:bold">«-»</span> увеличивайте или уменьшайте карту, чтобы увидеть все ближайшие хостелы.<br>
 <br>
</p>
<div>
    <div style="text-align: justify; text-indent: 20px;">
 <br>
    </div>
    <h2> Для быстрого поиска хостела воспользуйтесь фильтром:</h2>
</div>
<div class="dormitory list" id="oshegitiya_map">
    <div>
        <?global $arrFilter;
        $sorting = 'mskokruga';

       if(!$arrFilter) {
            $arrFilter["ACTIVE"] = "Y";
            $arrFilter["!PROPERTY_napr_VALUE"] = false;
            $arrFilter[0]["LOGIC"] = "OR";

            if (($_REQUEST["loc"] !== '') && isset($_REQUEST["loc"])) $arrFilter[0]["%PROPERTY_oblrayoni_VALUE"] = $_REQUEST["loc"];
            if (($_REQUEST["napr"] !== '') && isset($_REQUEST["napr"])) $arrFilter[0]["PROPERTY_napr_VALUE"] = $_REQUEST["napr"];
        }
		$arrFilter['PROPERTY_HOSTEL'] = 2311;
        $APPLICATION->IncludeComponent(
            "alma:catalog.section.prop",
            "only_map_moscow_hostels",
            array(
                "ACTION_VARIABLE" => "action",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "Y",
                "AJAX_OPTION_STYLE" => "Y",
                "BASKET_URL" => "/personal/basket.php",
                "BROWSER_TITLE" => "-",
                "CACHE_FILTER" => "Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "360000",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "only_map_moscow_hostels",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_COMPARE" => "N",
                "DISPLAY_TOP_PAGER" => "Y",
                "ELEMENT_SORT_FIELD" => "",
                "ELEMENT_SORT_FIELD2" => "sort",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "asc",
                "FILTER_NAME" => "arrFilter",
                "IBLOCK_ID" => "3",
                "IBLOCK_TYPE" => "xmlcatalog",
                "INCLUDE_SUBSECTIONS" => "N",
                "LINE_ELEMENT_COUNT" => "1",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "round",
                "PAGER_TITLE" => "Товары",
                "PAGE_ELEMENT_COUNT" => "1000",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPERTIES" => array(
                ),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PROPERTY_CODE" => array(
                    0 => "metro",
                    1 => "mskokruga",
                    2 => "ulica",
                    3 => "group",
                    4 => "napr",
                    5 => ""
                ),
                "SECTION_CODE" => "",
                "SECTION_ID" => "",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "SECTION_URL" => "",
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "SET_STATUS_404" => "Y",
                "SET_TITLE" => "N",
                "SHOW_ALL_WO_SECTION" => "Y",
                "SHOW_PRICE_COUNT" => "1",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
            ),
            false,
            array("ACTIVE_COMPONENT" => "Y")
        );
        ?>
    </div>
</div>
<p>
 <br>
</p>
<p>
     На карте представлены коммерческие общежития Москвы и Московской области, оказывающие услуги по размещению рабочих, служащих, ИТР. Комнаты в общежитиях различной категории комфортности. От комфортного, но недешёвого,&nbsp;одно- двухместного размещения (с расположенными в номерах санузлами, холодильниками и телевизорами) до общежитий эконом-класса по 8-10 койко-мест в комнате и удобствами на этаже. Выбирайте подходящие для Вас условия!<br>
 <br>
 <br>
     JOBHOSTEL является центральной службой размещения более трёхсот общежитий и гостиниц эконом-класса по всем районам и направлениям в Московском регионе! Все объекты представлены исключительно от собственников и поэтому бронирование помещений и оформление заявок на любые представленные на сайте услуги БЕСПЛАТНЫ! <br>
 <br>
 <br>
</p>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>