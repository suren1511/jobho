<?

use Bitrix\Main\Loader;

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"] = "N";
$APPLICATION->ShowIncludeStat = false;

Loader::includeModule("sale");
Loader::includeModule("iblock");
$arFilter=array();
$arFilter['LID']=LANGUAGE_ID;
$arSort=array();

if ($_REQUEST['REQUEST']== 'REGION'){
  $arFilter['REGION_ID']=$_REQUEST['REGION'];
  $arFilter['!CITY_NAME']=false;
  $arSort['CITY_NAME']= 'ASC';

}

$db_vars = CSaleLocation::GetList(
  $arSort,
  $arFilter,
  false,
  false,
  array()
);
while ($vars = $db_vars->Fetch()){

$countru[$vars['COUNTRY_NAME_LANG']]= array(
  'ID'=>$vars['COUNTRY_ID'],
  'NAME'=>$vars['COUNTRY_NAME_LANG'],
);
  $region[$vars['REGION_ID']]= array(
    'ID'=>$vars['REGION_ID'],
    'NAME'=>$vars['REGION_NAME'],
  );
  $sity[$vars['CITY_ID']]= array(
    'ID'=>$vars['CITY_ID'],
    'NAME'=>$vars['CITY_NAME'],
  );
}

?>


<? if ($_REQUEST['REQUEST'] == 'REGION') { ?>
  <option value="" hidden>Выберите город</option>

  <?
  foreach($sity as $item) {
    ?>
    <option value="<?= $item['NAME'] ?>" data-value="<?= $item['ID'] ?>"><?= $item['NAME'] ?></option>
    <?
  }
}?>
<?



require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");