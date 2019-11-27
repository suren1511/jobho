<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
 <a name="nav_start"></a>

<?
InitSorting();
?>

	<div class="transport-serv-wrap">
		<div class="transport-serv transport-serv_title">
			<div class="transport-serv__photo">
				Фото
			</div>
			<div class="transport-serv__name">
				Название
			</div>
			<div class="transport-serv__characteristics">
				Характеристики
			</div>
			<div class="transport-serv__price">
				Цена от
			</div>
			<div class="transport-serv__add">
				Добавить к заказу
			</div>
		</div>
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
			<div class="transport-serv"  onclick="window.location.href = '<?echo $arElement["COMPARE_URL"]?>';">
				<div class="transport-serv__photo">
					<?if(is_array($arElement["PREVIEW_PICTURE"])):?><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"  alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arElement["NAME"]?>" /><?endif?>
				</div>
				<div class="transport-serv__name">
					<a href="<?echo $arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a>
				</div>
				<div class="transport-serv__characteristics">
					<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						<?=$arProperty["NAME"]?>:&nbsp;<?
						if(is_array($arProperty["DISPLAY_VALUE"]))
							echo '<b>'.implode("&nbsp;", $arProperty["DISPLAY_VALUE"]).'</b>';
						else
							echo '<b>'.$arProperty["DISPLAY_VALUE"].'</b>';?><br />
					<?endforeach?>

					<?
					global $USER;
					if ($USER->IsAdmin()){?>
						мин.количество км: <b><?=$arElement["PROPERTIES"]["minkolvokm"]["VALUE"]?></b><br />
						тип транспорта: <b><?=$arElement["PROPERTIES"]["tipavtobusa"]["VALUE"]?></b><br />
						мин кол-во часов: <b><?=$arElement["PROPERTIES"]["minkolvochasov"]["VALUE"]?></b><br />
						возможность применения: <b><?foreach($arElement["PROPERTIES"]["vozmprim"]["VALUE"] as $vozm){?>
							<?=$vozm?><br />
						<?}?></b>
					<?}?>

				</div>
				<div class="transport-serv__price">
					<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<?$arResult["PRICES"][$code]["TITLE"];?>
								<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
									<s><?=$arPrice["PRINT_VALUE"]?></s><?=$arPrice["PRINT_DISCOUNT_VALUE"]?>
								<?else:?><?=$arPrice["PRINT_VALUE"]?><?endif;?>

						<?endif;?>
					<?endforeach;?>
				</div>
				<div class="transport-serv__add">
					<?if($arParams["DISPLAY_COMPARE"]):?>
						<a class="btn btn--blue" href="<?echo $arElement["COMPARE_URL"]?>">Заказать</a>
					<?endif?>
				</div>
            </div>
		<?endforeach;?>
	</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
