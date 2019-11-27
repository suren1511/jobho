<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
global $sorting; 
$pages = connectTabs($APPLICATION->GetCurPage());?>
<?require_once('metromap.php');?>
<div class="dormitory-filter">
    <div class="tab_list">
        <? foreach ($pages as $url => $title): ?>
    		<? if ($url == $APPLICATION->GetCurPage()): ?>
    			<a class="act tab_list_link"><?=$title?></a>
    		<?else:?>
    			<a href="<?=$url?>" class="no_act tab_list_link"><?=$title?></a>
    		<? endif ?>
    	<? endforeach ?>
    </div>
	<div class="form form_bug2_ie7">
		<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="get">
            <input type="hidden" value="<?=$_GET['sortby']?>" name="sortby">
            <input type="hidden" value="<?=$_GET['priceorder']?>" name="priceorder">
            <input type="hidden" value="<?=$_GET['group']?>" name="group">
            <div class="fields">
                <div class="sel_1 full_width">
                    <span>Округ </span>
                    <select name="mskokruga">
                        <option value="">все</option>
							<?foreach ($arResult["OKRUGA"] as $okrg):?>
							<?if ($okrg == $_REQUEST["mskokruga"]) $selected = "selected";?>
								<?echo '<option value="'.$okrg.'"'.$selected.'>'.$okrg.'</option>';?>
								<?unset($selected);?>
							<?endforeach;?>
                    </select>
                </div>

                <div class="sel_1 full_width" id="metro_mob">
                    <span>Метро</span>
                    <div class="pseudo_select metro">
                        <input name="m[]" type="checkbox" value="" id="metro0">
                        <label for="metro0"> все</label><br>
                       <?foreach ($arResult["METRO"] as $k => $metro):?>
                            <input
                                    name="m[]"
                                    type="checkbox"
                                    value="<?=$metro?>"
                                    id="metro<?=$k+1?>"
                                    <?if (in_array($metro, $_REQUEST["m"])):?>checked<?endif;?>
                            >
                            <label for="metro<?=$k+1?>"> <?=$metro?></label><br>
    					<?endforeach;?>
                    </div>
                </div>
            </div>

			<div class="search_but"><input type="submit" value="Найти" name="submit"></div>
            <div id="selectedStations">
                <?if (isset($_GET["m"])):
                    foreach (array_unique($_GET["m"]) as $k => $metro):
                        if ($metro):?>
                            <div class="station" id="m<?=$k?>">
                                <input type="hidden" name="m[]" value="<?=$metro?>" checked>
                                <?=$metro?>
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/close.png" style="cursor:hand;cursor:pointer" onclick="$('input[value=\'<?=$metro?>\']').attr('checked',false); $('div#m<?=$k?>').remove();">
                            </div>
                        <?  endif;
                    endforeach;
                endif;?>

                <?if (isset($_GET["rayonmoskvi"])):
                    foreach ($_GET["rayonmoskvi"] as $num => $rayon):
                        if ($rayon):?>
                            <div class="station" id="rayon<?=$num?>">
                                <input type="hidden" name="rayonmoskvi[]" value="<?=$rayon?>" checked>
                                <?=$rayon?>
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/close.png" style="cursor:hand;cursor:pointer" onclick="$('div#rayon<?=$num?>').remove();">
                            </div>
                        <?  endif;
                    endforeach;
                endif;?>
            </div>
            <input type="hidden" name="price_filter" value="<?=$_GET['price_filter']?>">
        </form>
	</div>

	<div class="bottom-part">
		<div class="vis-type">
			<div class="change list ">Списком</div>
			<div class="change tile">Плиткой</div>
		</div>
		<div class="metro-choose">
			<div class="map map_load">
				<a href="javascript:void(0);">На карте</a>
			</div>

			<div class="metro"><a href="javascript:void(0);">По схеме метро</a></div>
		</div>
		<div class="price-sort">
            <?
            if (strpos($_SERVER['REQUEST_URI'],'sortby=price')===false) $sort_by_price = '';
            else $sort_by_price = '';
            if (strpos($_SERVER['REQUEST_URI'],'?')===false) $sort_by_price .= '?';
            else $sort_by_price .= '&';
            $sort_by_price .= 'sortby=price';
            if (strpos($_SERVER['REQUEST_URI'],'priceorder')===false) $sort_by_price .= '&priceorder=desc';
            else $sort_by_price = str_replace('&priceorder=desc','',$sort_by_price);

            $uri = str_replace(array('&sortby=price','sortby=price','&priceorder=desc'),'',$_SERVER['REQUEST_URI']);
            ?>

			<a href="<?=$uri.$sort_by_price?>" class="sort_1">Сортировать по цене</a>
		</div>
	</div>
<? 
    if ($sorting=="mskokruga") $nazvanie = "(Общежития Москвы)";
    elseif ($sorting=="napr") $nazvanie = "(Общежития Московской области)";

	$sortvalue = "";?>

	<?if(!$arrFilter){$arrFilter=array("ACTIVE" => "Y","PROPERTY_yandexmap" => "_%");}?>
	<div class="bx-yandex-view-layout">
		<div class="bx-yandex-view-map" id="yandex-view-map"></div>
	</div>
	<div class="dormitory-sort" id="sort" property="qwerty">
		<?php
		 echo '<!--RestartBuffer-->';
		?>
		<?foreach ($arResult["ITEMS"] as $arElement):?>
			<?  
				
            if ($arElement["DISPLAY_PROPERTIES"][$sorting]):
				if ($sortvalue != $arElement["DISPLAY_PROPERTIES"][$sorting]["DISPLAY_VALUE"]):
					$sortvalue = $arElement["DISPLAY_PROPERTIES"][$sorting]["DISPLAY_VALUE"];?>
					<?if (!strpos($_SERVER['REQUEST_URI'],'best_deals')):?>
						<div class="title">
							<a href='/<?=$arElement["PROPERTIES"]["mskokruga"]["VALUE_XML_ID"][0]?>/'><?=$arElement["PROPERTIES"]["mskokruga"]["~VALUE"][0]?> <?= $nazvanie ?></a>
						</div>
					<?endif;?>
				<? endif ?>

				<div class="item" onclick="window.location.href = '<?= $arElement["DETAIL_PAGE_URL"] ?>';"
					 id="sorting_<?= $arElement['ID'] ?>" style="<?=$arElement['STYLE']?>">

					<div class="name">
						<div class="bg-img" style="background-image:url(<? if (strlen($arElement['PREVIEW_PICTURE']['SRC']) > 1) echo "'".$arElement['PREVIEW_PICTURE']['SRC']."'"; else echo SITE_TEMPLATE_PATH.'/img/no_photo.jpg' ?>);"></div>
					</div>
					<div class="descr">
						<p class="descr__name"><?= $arElement["NAME"]; ?></p>
						<p class="descr__metro"><img alt="рядом с метро"
							src="<?=SITE_TEMPLATE_PATH?>/img/metro.png"><a href="/metro_<?=$arElement["PROPERTIES"]["metro"]['VALUE_XML_ID'][0]?>/"><?= $arElement["PROPERTIES"]["metro"]["VALUE"][0]; ?></a>
						</p>
						<p class="descr__street">
							<a href="<?= $arElement["DETAIL_PAGE_URL"] . '#tomap' ?>"><?= $arElement["PROPERTIES"]["ulica"]["VALUE"]; ?></a>
						</p>
						<p class="mans">
							<a href='/<?=$arElement["PROPERTIES"]["mskokruga"]["VALUE_XML_ID"][0]?>/'><?=$arElement["PROPERTIES"]["mskokruga"]["~VALUE"][0]?></a>
						</p>
						<p class="mans">
							Мест в комнате: 
							<span>
							<?
							foreach($arElement["PROPERTIES"]["kolchel"]["VALUE"] as $key => $man){
								if($man == end($arElement["PROPERTIES"]["kolchel"]["VALUE"])){
									echo $man;
								}else{
									echo $man.'&nbsp;/&nbsp;';
								}
							}
							?>
							</span>
						</p>
						<p class="mans">
							Гражданство заселяемых:
							<?
							foreach($arElement["PROPERTIES"]["gragdanstvo"]["VALUE"] as $key => $man){	
								if($man == end($arElement["PROPERTIES"]["gragdanstvo"]["VALUE"])){
									if($man == 'Россия, Белоруссия')
										$man = '<span>РФ</span><img src="'.SITE_TEMPLATE_PATH.'/img/rf.jpg" alt="РФ" title="РФ">';
								
									if($man == 'СНГ')
										$man = '<span>СНГ</span><img src="'.SITE_TEMPLATE_PATH.'/img/sng.png" alt="СНГ" title="СНГ">';
								
									if($man == 'Дальнее зарубежье')
										$man = '<span>Дал.Зарубежье</span><img src="'.SITE_TEMPLATE_PATH.'/img/world.jpg" alt="Дальнее зарубежье" title="Дальнее зарубежье">';
									
									echo $man;
								}else{
									if($man == 'Россия, Белоруссия')
										$man = '<span>РФ</span><img src="'.SITE_TEMPLATE_PATH.'/img/rf.jpg" alt="РФ" title="РФ">';
								
									if($man == 'СНГ')
										$man = '<span>СНГ</span><img src="'.SITE_TEMPLATE_PATH.'/img/sng.png" alt="СНГ" title="СНГ">';
								
									if($man == 'Дальнее зарубежье')
										$man = '<span>Дал.Зарубежье</span><img src="'.SITE_TEMPLATE_PATH.'/img/world.jpg" alt="Дальнее зарубежье" title="Дальнее зарубежье">';
									
									echo $man.'&nbsp;/&nbsp;';
								}
							}
							?>
						</p>
					</div>
					<div class="price">
						<? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
							<? if ($arPrice["CAN_ACCESS"]): ?>
								<? $arResult["PRICES"][$code]["TITLE"]; ?>
								<? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
									<s><?= $arPrice["PRINT_VALUE"] ?></s> <span
										class="catalog-price"><?= $arPrice["PRINT_DISCOUNT_VALUE"] ?> / сутки</span>
								<? else: ?>
									<div class="catalog-price"><span class="price-num"><?= $arPrice["VALUE"] ?></span>
									руб / сутки</div><? endif; ?>

							<? endif; ?>
						<? endforeach; ?>

						<a class="btn item__more" href="<?= $arElement["DETAIL_PAGE_URL"]; ?>">
							<span>Подробнее</span>
						</a>
					</div>
				</div>

			<? endif; ?>
		<? endforeach; ?>
		<? echo '<!--RestartBuffer-->';?>
		<div id="show-more-1"><img src="<?=SITE_TEMPLATE_PATH?>/img/827.gif" alt="Показать еще"></div>
	</div>

	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<div class="more">
			<a class="more__btn">Показать ещё</a>
		</div>
		<?= $arResult["NAV_STRING"] ?>
	<? endif; ?>
	<? if (count($arResult["ITEMS"]) == 0) { ?>
		<p style="color: red; position: relative; margin-bottom: 1px; top: 29px; font-size: 16px; text-align: center;">
			<br><br><br>К сожалению, по данному адресу общежитие отсутствует. <br>Вы можете воспользоваться поиском
			повторно.
		</p>
	<? } ?>
</div>
<script>
BX.ready(function(){
   BX.bindDelegate(
      document.body, 'click', {className: 'map_load' },
      function(e){
         if(!e) {
            e = window.event;
         }
        BX.ajax.insertToNode('/ajax/view-map-moscow.php', BX('yandex-view-map'));
         return BX.PreventDefault(e);
      }
   );
});
</script>