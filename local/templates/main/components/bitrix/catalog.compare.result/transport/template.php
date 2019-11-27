<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
 <a name="nav_start"></a>
<?
InitSorting();

?>
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
<!--<pre> <a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank"><?=$arElement["NAME"]?></a></pre>-->
<div class="transport">
	<div class="transport__img">
		<?if(is_array($arElement["PREVIEW_PICTURE"])):?><a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="198" height="" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arElement["NAME"]?>" /></a><?endif?>
	</div>
	<div class="transport__descr">


		   <div class="price_elem">
				Цена за час: <?=$arElement["DISPLAY_PROPERTIES"]["cenazachas"]["DISPLAY_VALUE"]?> руб
		   </div>
		   <div class="zag_telo"><?=$arElement["NAME"]?></div>
				<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
					<?php if (!empty($arProperty["DISPLAY_VALUE"])): ?>
					<b><?=$arProperty["NAME"]?>:</b>&nbsp;<?
						if(is_array($arProperty["DISPLAY_VALUE"]))
							echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
						else
							echo $arProperty["DISPLAY_VALUE"];?><br />
					<?endif?>
				<?endforeach?>
					<b>количество:</b>&nbsp;
					<input type="text" size="3" maxlength="3" id="<?=$arElement["ID"]?>"  onkeyup="calculate();" value="1"/>
					<?$massiv=$massiv.'\''.$arElement["ID"].'\',';?>


	</div>
</div>
<?endforeach?>
<script type="text/javascript">
function calculate()
{
  var massiv=[<?=$massiv?>0];
  var massivznach="";
  for(var i=0; i<massiv.length; i++)
  {
  var name=massiv[i];

    if (document.getElementById(name))
    {
        var value=document.getElementById(name).value; value=value-0;
        if (value) {massivznach=massivznach+name+' '+value+';';}
    }
  }
  if(document.getElementById('idtr1')) document.getElementById('idtr1').value=massivznach;
  if(document.getElementById('idtr2')) document.getElementById('idtr2').value=massivznach;
}
</script>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>

