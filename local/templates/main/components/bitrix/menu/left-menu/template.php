<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$arLink = array(
	"/hostel_in_msc/",
	"/dormitory_suburbs/",
	"/hostel_in_spb/",
	"/obshejitiya_na_karte.php",
	"/hostels_in_msc/",
	"/hostels_podmsc/",
	"/hostels_in_spb/",
	"/hostels_na_karte.php",
);?>
<?if (!empty($arResult)):?>
<div class="left-menu-wrap">
	<ul class="left-menu">

	<?
	$previousLevel = 0;
	foreach($arResult as $arItem):?>

		<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>

		<?if ($arItem["IS_PARENT"]):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<?if($arItem["LINK"] == '/obshejitiya/'):?>
					<?if(in_array($APPLICATION->GetCurPage(), $arLink)):?>
						<?$arItem["SELECTED"] = true;?>
					<?endif;?>
				<?endif;?>
				<li class="left-menu__item js-left-menu-item <?if ($arItem["SELECTED"]):?>active opened<?endif?>"><a href="<?=$arItem["LINK"]?>" class="left-menu__link"><?=$arItem["TEXT"]?><span class="left-menu__link__arr js-left-menu-arr"></span></a>
					<ul class="left-menu__sub">
			<?else:?>
				<li class="left-menu__item-sub <?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="left-menu__link-sub"><?=$arItem["TEXT"]?></a>
					<ul class="left-menu__sub">
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="left-menu__item <?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="left-menu__link"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li class="left-menu__item-sub <?if ($arItem["SELECTED"]):?>active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="left-menu__link-sub"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

		<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

	<?endforeach?>

	<?if ($previousLevel > 1)://close last item tags?>
		<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
	<?endif?>

	</ul>
</div>
<?endif?>