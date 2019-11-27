<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="top-menu">

<?//debug($arResult);
$previousLevel = 0;
foreach($arResult as $arItem):?>
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["DEPTH_LEVEL"] == 1):?>
		<li class="top-menu__item<?if ($arItem["SELECTED"]):?> current<?endif?>"><a href="<?=$arItem['LINK']?>"<?=($arItem["PARAMS"]["css-class"]?' class="'.$arItem["PARAMS"]["css-class"].'"':'')?>><?=$arItem['TEXT']?></a></li>
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>