<?

use Bitrix\Main\Loader;

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;

$APPLICATION->IncludeComponent(
  "amt:add.element",
  "empty",
  array(
    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
    "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
    "CUSTOM_TITLE_DETAIL_PICTURE" => "",
    "CUSTOM_TITLE_DETAIL_TEXT" => "",
    "CUSTOM_TITLE_IBLOCK_SECTION" => "",
    "CUSTOM_TITLE_NAME" => "Название общежития",
    "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
    "CUSTOM_TITLE_PREVIEW_TEXT" => "",
    "CUSTOM_TITLE_TAGS" => "",
    "DEFAULT_INPUT_SIZE" => "30",
    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
    "ELEMENT_ASSOC" => "CREATED_BY",
    "GROUPS" => array(
      0 => "1",
      1 => "15",
    ),
    "IBLOCK_ID" => "23",
    "IBLOCK_TYPE" => "cabinet",
    "LEVEL_LAST" => "N",
    "LIST_URL" => "",
    "MAX_FILE_SIZE" => "0",
    "MAX_LEVELS" => "100000",
    "MAX_USER_ENTRIES" => "100000",
    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
    "PROPERTY_CODES" => array(
      0 => "468",
      1 => "469",
      2 => "470",
      3 => "471",
      4 => "472",
      5 => "473",
      6 => "474",
      7 => "475",
      8 => "476",
      9 => "477",
      10 => "478",
      11 => "479",
      12 => "480",
      13 => "481",
      14 => "482",
      15 => "483",
      16 => "484",
      17 => "485",
      18 => "486",
      19 => "487",
      20 => "488",
      21 => "489",
      22 => "490",
      23 => "491",
      24 => "492",
      25 => "493",
      26 => "494",
      27 => "495",
      28 => "496",
      29 => "497",
      30 => "498",
      31 => "499",
      32 => "500",
      33 => "501",
      34 => "502",
      35 => "503",
      36 => "504",
      37 => "505",
      38 => "506",
      39 => "507",
      40 => "508",
      41 => "509",
      42 => "510",
      43 => "NAME",
    ),
    "PROPERTY_CODES_REQUIRED" => array(
    ),
    "RESIZE_IMAGES" => "N",
    "SEF_MODE" => "N",
    "STATUS" => "ANY",
    "STATUS_NEW" => "N",
    "USER_MESSAGE_ADD" => "",
    "USER_MESSAGE_EDIT" => "",
    "USE_CAPTCHA" => "N",
    "COMPONENT_TEMPLATE" => "amt"
  ),
  false
);



require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");