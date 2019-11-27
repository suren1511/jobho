<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode( true );?>
<div class="left-news-list">
	<?foreach($arResult["ITEMS"] as $arItem){?>
		<div class="left-news-list__item">
			<div class="left-news-list__date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>

			<div class="left-news-list__head"><a <?if ($_SERVER['REQUEST_URI'] != $arItem["DETAIL_PAGE_URL"]):?>href="<?=$arItem["DETAIL_PAGE_URL"]?>"<?endif;?>><?echo $arItem["NAME"]?> </a></div>
		</div>
	<?}?>
</div>