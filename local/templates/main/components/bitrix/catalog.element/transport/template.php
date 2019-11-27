<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->AddChainItem($arResult["NAME"], " ");?>
<a href="/akcija-pereezd-za-nash-schet.php"><img src="<?=SITE_TEMPLATE_PATH?>/img/job_vn1.jpg"  /></a>
<div style="width:100%;float: left;">
	<div class="title_4"><span class="up_l"></span> <span></span></div>
	<div class="telo_bl">
		<div style="width:100%; display: inline-block;  ">
			<table width="100%">
				<tr>
					<td style="text-align:center; padding: 5px;">
					<?if(is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])):?>
						<?if(is_array($arResult["PREVIEW_PICTURE"]) && is_array($arResult["DETAIL_PICTURE"])):?>
							<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="400"  alt="<?=$arResult["PREVIEW_PICTURE"]["DESCRIPTION"]?>" title="<?=$arResult["NAME"]?>" id="image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>" style="display:none;cursor:pointer;cursor: hand;" OnClick="document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='block'" />
							<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="400" alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" title="<?=$arResult["NAME"]?>" id="image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>" style="display:block;cursor:pointer; cursor: hand;" OnClick="document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='block'" />
						<?elseif(is_array($arResult["DETAIL_PICTURE"])):?>
							<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="400" alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" title="<?=$arResult["NAME"]?>" />
						<?elseif(is_array($arResult["PREVIEW_PICTURE"])):?>
							<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="400"  alt="<?=$arResult["PREVIEW_PICTURE"]["DESCRIPTION"]?>" title="<?=$arResult["NAME"]?>" />
						<?endif?>
						<?if(count($arResult["MORE_PHOTO"])>0):?>
							<br /><a href="#more_photo"><?=GetMessage("CATALOG_MORE_PHOTO")?></a>
						<?endif;?>
					<?endif;?>
					</td>
					<td style="text-align:left; padding: 5px;">
					<h1 class="zag_telo" style="margin-left:0;"><?=$arResult["NAME"]?></h1>
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<?=$arProperty["NAME"]?>:<b>&nbsp;<?
							if(is_array($arProperty["DISPLAY_VALUE"])):
								echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
							elseif($pid=="MANUAL"):
								?><a href="<?=$arProperty["VALUE"]?>"><?=GetMessage("CATALOG_DOWNLOAD")?></a><?
							else:
								echo $arProperty["DISPLAY_VALUE"];?>
							<?endif?></b><br />
						<?endforeach?>
						<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<p><?=$arResult["CAT_PRICES"][$code]["TITLE"];?> от:&nbsp;<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>

							</p>
						<?endif;?>
					<?endforeach;?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="title_4_d" ><span class="dn_l"></span> <span></span></div>
</div>
<br />
<div style="width:100%;float: left;">
		<div class="title_4"><span class="up_l"></span> <span></span></div>
		<div class="telo_bl">
		   <div style="padding:5px;">
				<?if($arResult["DETAIL_TEXT"]):?>
					<br /><?=$arResult["DETAIL_TEXT"]?><br />
				<?elseif($arResult["PREVIEW_TEXT"]):?>
					<br /><?=$arResult["PREVIEW_TEXT"]?><br />
				<?endif;?>
				<center>Телефон:<font color="#FF0000" size="2">(495) 646-83-43</font></center>
			</div>
		</div>
		<div class="title_4_d" style="margin-top:-2px;"><span class="dn_l"></span> <span></span></div>
</div>
 
<?$APPLICATION->SetPageProperty("description", $arResult["NAME"]." - компания ДжобХостел предлагает самые низкие цены на жилье в МСК от 79руб\сутки, услуги по подбору персонала, доставке рабочих и организации питания.");?>
<?$APPLICATION->SetPageProperty("keywords", "");?>