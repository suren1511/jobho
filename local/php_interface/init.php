<?
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");

define("IBLOCK_MOSCOW_ID", 3); //Общежития Москвы
define("IBLOCK_PITER_ID", 4); //Общежития Санкт-Петербурга

AddEventHandler("main", "OnBeforeUserRegister", Array("EventHandler", "OnUserRegisterHandler"));

CModule::AddAutoloadClasses(
    '',
    [
        'EventHandler' => '/local/classes/EventHandler.php',
        'SiteHelper' => '/local/classes/SiteHelper.php',
    ]
);

/*if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/functions.php"))
	require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/functions.php");*/

if(!(isset($_SESSION['NO_INIT']) && $_SESSION['NO_INIT'] == 'Y')) {
   if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/functions.php")) {
      require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/functions.php");
   }
}


if(isset($_GET['noinit']) && !empty($_GET['noinit'])) {
   $strNoInit = strval($_GET['noinit']);
   if($strNoInit == 'N') {
      if (isset($_SESSION['NO_INIT'])) {unset($_SESSION['NO_INIT']);}
   }elseif($strNoInit == 'Y') {
      $_SESSION['NO_INIT'] = 'Y';
   }
}


AddEventHandler('form', 'onBeforeResultAdd', 'my_onBeforeResultAdd');
function my_onBeforeResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
  global $APPLICATION;
  if ($WEB_FORM_ID == 7 || $WEB_FORM_ID == 8)
  {
    $url_p = $APPLICATION->GetCurUri();
    $get_p = parse_url($url_p, PHP_URL_QUERY);
    $furl_p = urldecode(str_replace("page_u=", "", $get_p));
    $arrVALUES["form_hidden_62"] = $_SERVER['SERVER_NAME'].$furl_p;
    $arrVALUES["form_hidden_67"] = $_SERVER['SERVER_NAME'].$furl_p;
  }
}

define("PREFIX_PATH_404", "/404.php");
AddEventHandler("main", "OnAfterEpilog", "Prefix_FunctionName");
function Prefix_FunctionName() {
    global $APPLICATION;

    // Check if we need to show the content of the 404 page
    if (!defined('ERROR_404') || ERROR_404 != 'Y') {
        return;
    }

    // Display the 404 page unless it is already being displayed
    if ($APPLICATION->GetCurPage() != PREFIX_PATH_404) {
        
        //$APPLICATION->RestartBuffer();
        //require ($_SERVER['DOCUMENT_ROOT'].'/404.php');
        header('HTTP/1.1 404 Not Found');
        exit();
        

    }
     header('HTTP/1.1 404 Not Found');

}

function debug($item, $quest = "no") {
    global $USER;
    $pre_css="background-color: #f7f7f7;
             border: 1px solid #e1e1e8;
             font-family: 'Consolas','Courier New', monospace;
             -webkit-border-radius: 3px;
             -moz-border-radius: 3px;
             border-radius: 3px;
             padding:10px;
             color: #4b4b4b;
             font-size: 12px;
             line-height: 16px;
             word-spacing: -3px;
             margin: 10px 0;";

    if ($USER->GetLogin() == 'Alma-com') {
        if (!$item) {
            echo '<pre style="'.$pre_css.'">пусто</pre>';
        } else {
            echo '<pre style="'.$pre_css.'">' . print_r($item, true) . ' </pre>';
        }
    }
    if ($quest = "yes"){
        if (!$item) {
            echo '<pre style="'.$pre_css.'">пусто</pre>';
        } else {
            echo '<pre style="'.$pre_css.'">' . print_r($item, true) . ' </pre>';
        }
    }
}