<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="catalog-compare-list" align="center">
<a name="compare_list"></a>
<?if(count($arResult)>0):?>
	<form class="transport-serv-list"  action="<?=$arParams["COMPARE_URL"]?>" method="get">
	<table class="maintable" cellspacing="0" cellpadding="0" border="0" width="300"  >
		<thead>
		<tr>
			<th>
				<div >
					<?=GetMessage("CATALOG_COMPARE_ELEMENTS")?>		 
				</div>
			</th>
		</tr>
		</thead>
		<?foreach($arResult as $arElement):?>
		<tr>
			<td style="padding: 10"><input type="hidden" name="ID[]" value="<?=$arElement["ID"]?>" /><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></td>
		</tr>
		<?endforeach?>
	</table>
	<?if(count($arResult)>=1):?>
		<br />
		<input type="hidden" name="action" value="COMPARE" />
		<input type="hidden" name="IBLOCK_ID" value="<?=$arParams["IBLOCK_ID"]?>" />
	<?endif;?>
	</form>
<?endif;?>
</div>

<?if($_REQUEST["action"] == "ADD_TO_COMPARE_LIST"){
$url="/transportnye_uslugi/oformlenie.php?";
foreach($arResult as $arElement){
$url.="&ID[]=".$arElement["ID"];
}
$url.="&IBLOCK_ID=".$arParams["IBLOCK_ID"];

LocalRedirect($url);

}?>