<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">
	<table>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement){?>
			<tr>
				<td width="50px"><span class="date"><?=$arElement["ACTIVE_FROM"]?></span></td>
				<td><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></td>
			</tr>
		<?}?>
	</table>
</div>
