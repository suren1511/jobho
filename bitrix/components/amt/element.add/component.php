<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
  die();

/**
 * @var CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 * @var string $componentPath
 * @var string $componentName
 * @var string $componentTemplate
 * @global CMain $APPLICATION
 * @global CDatabase $DB
 * @global CUser $USER
 */

use Bitrix\Main\Loader;

Loader::includeModule("iblock");


if (!$arParams['IBLOCK_ID']) {
  $arResult['NO_IBLOCK_ID'] = 'Не задан инфоблок';
}

$arSortSec = array("NAME" => "ASC");
$arFilSec = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE' => 'Y');
$arSelSec = array('NAME', 'ID',);
$sec = CIBlockSection::GetList($arSort, $arFilSec, false, $arSelSec);
while ($ar_sec = $sec->GetNext()) {
  $arResult['SECTIONS'][] = $ar_sec;
}
Loader::includeModule("sale");
$arFilter = array();
$arFilter['LID'] = LANGUAGE_ID;
$arSort = array();


$arFilter['COUNTRY_ID'] = '1';
$arFilter['!REGION_NAME'] = false;
$arSort['REGION_NAME'] = 'ASC';


$db_vars = CSaleLocation::GetList(
  $arSort,
  $arFilter,
  false,
  false,
  array()
);
while ($vars = $db_vars->Fetch()) {


  $region[$vars['REGION_ID']] = array(
    'ID' => $vars['REGION_ID'],
    'NAME' => $vars['REGION_NAME'],
  );

}
$arResult['REGIONS'] = $region;
//Создаем вакансию черновик на первом шаге переход начальный на второй шаг
if ($_POST['STEP'] == 'ONE' || $_POST['STEP']=='TWO_DUBL') {

  $el = new CIBlockElement;

  $PROP = array();
  $PROP = $_REQUEST['PROPERTY'];
  if ($_REQUEST['PROPERTY']['USLOVIY']) {
    $PROP['USLOVIY'] = array("VALUE" => Array("TEXT" => $_REQUEST['PROPERTY']['USLOVIY'], "TYPE" => "text"));
  }
  if ($_REQUEST['PROPERTY']['OBYZANN']) {
    $PROP['OBYZANN'] = array("VALUE" => Array("TEXT" => $_REQUEST['PROPERTY']['OBYZANN'], "TYPE" => "text"));
  }
  if ($_REQUEST['PROPERTY']['DOHOD_OT']) {
    $PROP['DOHOD_OT']=number_format($_REQUEST['PROPERTY']['DOHOD_OT'], 0, ',', '');
  }
  if ($_REQUEST['PROPERTY']['DOHOD_DO']) {
    $PROP['DOHOD_DO']=number_format($_REQUEST['PROPERTY']['DOHOD_DO'], 0, ',', '');

  }
  $params = Array(
    "max_len" => "100",
    // обрезает символьный код до 100 символов
    "change_case" => "L",
    // буквы преобразуются к нижнему регистру
    "replace_space" => "_",
    // меняем пробелы на нижнее подчеркивание
    "replace_other" => "_",
    // меняем левые символы на нижнее подчеркивание
    "delete_repeat_replace" => "true",
    // удаляем повторяющиеся нижние подчеркивания
    "use_google" => "false",
    // отключаем использование google
  );
  $dateEl=date('d.m.Y');
  $name = $_REQUEST['NAME'];
  $arLoadProductArray = Array(
    "MODIFIED_BY" => $USER->GetID(),
    // элемент изменен текущим пользователем
    "IBLOCK_SECTION_ID" => $_REQUEST['SECTION'],
    // элемент лежит в корне раздела
    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
    "ACTIVE_FROM"=>$dateEl,
    "PROPERTY_VALUES" => $PROP,
    "NAME" => $name,
    "ACTIVE" => "Y",

    // активен
    "DETAIL_TEXT" => $_REQUEST['DETAIL_TEXT'],
  );
  $arLoadProductArray['CODE'] = CUtil::translit($name, "ru", $params);
  $arSelect = Array("ID", "IBLOCK_ID", "NAME");
  $arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arLoadProductArray['CODE']);
  $arSort = Array("SORT" => "ASC",);
  $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $nalId = $arFields['ID'];

  }
  if (!$_REQUEST['ID']) {
    if ($nalId) {
      $new_password = randString(2);
      $arLoadProductArray['CODE'] = CUtil::translit($name . $new_password, "ru", $params);
    }
    if ($PRODUCT_ID = $el->Add($arLoadProductArray))
      $arResult['ELEMENT']['ID'] = $PRODUCT_ID;
    else
      $arResult['ERROR'] = $el->LAST_ERROR;
  }
  else{

    $name = $_REQUEST['NAME'];
    $arLoadProductArrayUpd = Array(
      "MODIFIED_BY" => $USER->GetID(),
      // элемент изменен текущим пользователем
      "IBLOCK_SECTION_ID" => $_REQUEST['SECTION'],
      // элемент лежит в корне раздела
      "IBLOCK_ID" => $arParams['IBLOCK_ID'],
      "ACTIVE_FROM"=>$dateEl,
      "NAME" => $name,
      "ACTIVE" => "Y",

      // активен
      "DETAIL_TEXT" => $_REQUEST['DETAIL_TEXT'],
    );
    if ($nalId) {
      $new_password = randString(2);
      $arLoadProductArrayUpd['CODE'] = CUtil::translit($name . $new_password, "ru", $params);
    }
    else{
      $arLoadProductArrayUpd['CODE'] = CUtil::translit($name, "ru", $params);
    }
    $res = $el->Update($_REQUEST['ID'], $arLoadProductArrayUpd);
    $arResult['ELEMENT']['ID']=$_REQUEST['ID'];
  }
}
if ($_POST['STEP'] == 'ONE' && $_POST['ID']){
  $res = CIBlockElement::GetByID($_POST['ID']);
  while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $arFields['PROPERTIES']=$arProps;
    $arResult['ELEMENT']=$arFields;
  }
  CIBlockElement::SetPropertyValuesEx($_REQUEST['ID'], $arParams['IBLOCK_ID'], $_REQUEST['PROPERTY']);
}

//Переход на третий шаг
if ($_REQUEST['STEP'] == 'TWO' || $_REQUEST['STEP_NAZAD'] == 'ONE' || $_REQUEST['STEP_NAZAD'] == 'TWO' || $_REQUEST['STEP'] == 'TWO_DUBL' || $_REQUEST['STEP'] == 'SUCSS') {
  $res = CIBlockElement::GetByID($_POST['ID']);
  while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $arFields['PROPERTIES']=$arProps;
    $arResult['ELEMENT']=$arFields;
  }
  CIBlockElement::SetPropertyValuesEx($_REQUEST['ID'], $arParams['IBLOCK_ID'], $_REQUEST['PROPERTY']);
}
if ($_REQUEST['PABLICK'] == 'Y'){
  CIBlockElement::SetPropertyValuesEx($_REQUEST['ID'], $arParams['IBLOCK_ID'], array('CHERNOVIK'=>''));

}
if ($_REQUEST['ODOBRIT'] == 'Y'){
  CIBlockElement::SetPropertyValuesEx($_REQUEST['ID'], $arParams['IBLOCK_ID'], array('MODERATOR'=>'','OTKL'=>'','PRICHINA'=>'','hide'=>''));

}
if ($_REQUEST['OTKL'] == 'Y'){
  if (!empty($_REQUEST['PROPERTY']['PRICHINA_TEXT'])){
    $_REQUEST['PROPERTY']['PRICHINA']=$_REQUEST['PROPERTY']['PRICHINA_TEXT'];
  }
  CIBlockElement::SetPropertyValuesEx($_REQUEST['ID'], $arParams['IBLOCK_ID'], $_REQUEST['PROPERTY']);

  $arResult=array();
  $arResult['REQUEST'] = $_REQUEST;
  if ($_REQUEST['PROPERTY']['hide'] == '1'){
    $arResult['MESS']='<span class="red"><span class="status">Отклонено</span></span>';

  }
  else{
    $arResult['MESS']='<span class="red"><span class="status">Отклонено</span></span>: '.$_REQUEST['PROPERTY']['PRICHINA'];

  }
  $context = \Bitrix\Main\Application::getInstance()->getContext();

  $response = new \Bitrix\Main\HttpResponse($context);
  $response->addHeader("Content-Type", "application/json");

  $request = $context->getRequest();
  $request->addFilter(new Bitrix\Main\Web\PostDecodeFilter);
  $response->flush(Bitrix\Main\Web\Json::encode($arResult));

}




$this->IncludeComponentTemplate();
