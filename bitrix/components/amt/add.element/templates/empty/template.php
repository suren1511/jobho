<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();
?>

<?
$context = \Bitrix\Main\Application::getInstance()->getContext();

$response = new \Bitrix\Main\HttpResponse($context);
$response->addHeader("Content-Type", "application/json");

$request = $context->getRequest();
$request->addFilter(new Bitrix\Main\Web\PostDecodeFilter);



// выполняем вычисления...

// возвращаем результат
$response->flush(Bitrix\Main\Web\Json::encode($arResult));
