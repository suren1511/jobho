<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="revews">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="revews__item">
		<?if ($arItem["PREVIEW_PICTURE"]["SRC"]) {?>
			<div class="revews__img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem['PROPERTIES']['AUTHOR']['VALUE']?>"></div>
		<?}?>

		<div class="revews__content">
			<?if ($arItem['PROPERTIES']['AUTHOR']['VALUE']) {?>
				<div class="revews__name"><?=$arItem['PROPERTIES']['AUTHOR']['VALUE']?></div>
			<?}?>

			<?if ($arItem['PROPERTIES']['POST']['VALUE']) {?>
				<div class="revews__post"><?=$arItem['PROPERTIES']['POST']['VALUE']?></div>
			<?}?>

			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
				<div class="revews__text"><?echo $arItem["PREVIEW_TEXT"];?></div>
			<?endif;?>
		</div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
