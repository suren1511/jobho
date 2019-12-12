<?

use Bitrix\Main\Loader;

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;

$APPLICATION->IncludeComponent(
  "amt:element.add",
  "ajax_return",
  array(
    "COMPONENT_TEMPLATE" => ".default",
    "IBLOCK_TYPE" => "cabinet",
    "IBLOCK_ID" => "20",
    "SEF_MODE" => "N"
  ),
  false
);



require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");