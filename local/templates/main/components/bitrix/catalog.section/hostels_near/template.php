<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dormitory-filter">
<div class="dormitory-sort" id="sort" property="qwerty">
<div id="mycarousel-for-detail" class="for-main">
<? if (!empty($arResult["ITEMS"])): ?>
	<? foreach ($arResult["ITEMS"] as $cell => $arElement):?>
	<?
	if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Восточный Административный Округ')
		$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-vao/">Восточный Административный Округ</a>';
	
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Западный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-zao/">Западный Административный Округ</a>';
		
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Юго-Западный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-uzao/">Юго-Западный Административный Округ</a>';
		
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Юго-Восточный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-uvao/">Юго-Восточный Административный Округ</a>';
		
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Южный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-uao/">Южный Административный Округ</a>';
		
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Северо-Западный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-szao/">Северо-Западный Административный Округ</a>';
		
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Северо-Восточный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-svao/">Северо-Восточный Административный Округ</a>';
		
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Северный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-sao/">Общежития в Северном Административном Округе</a>';
		
		if($arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Центральный Административный Округ')
			$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-cao/">Центральный Административный Округ</a>';
		
	?>
	<div class="item" onclick="window.location.href = '<?= $arElement["DETAIL_PAGE_URL"] ?>';"
		 id="sorting_<?= $arElement['ID'] ?>" style="<?=$style?>">

		<div class="name">
			<div class="bg-img" style="background-image:url(<? if (strlen($arElement['PREVIEW_PICTURE']['SRC']) > 1) echo "'".$arElement['PREVIEW_PICTURE']['SRC']."'"; else echo '/img/no_photo.jpg' ?>);"></div>
		</div>
		<div class="descr">
			<p class="descr__name"><?= $arElement["NAME"]; ?></p>
			<?if ($arElement["DISPLAY_PROPERTIES"]["metro"]["VALUE_XML_ID"][0]):?>
                <p class="descr__metro"><img alt="рядом с метро"
                    src="<?=SITE_TEMPLATE_PATH?>/img/metro.png"><a href="/metro_<?=$arElement["DISPLAY_PROPERTIES"]["metro"]["VALUE_XML_ID"][0]?>/"><?=$arElement["DISPLAY_PROPERTIES"]["metro"]["VALUE"][0]; ?></a>
                </p>
            <?endif;?>
			<p class="descr__street">
				<a href="<?= $arElement["DETAIL_PAGE_URL"] . '#tomap' ?>"><?= $arElement["PROPERTIES"]["ulica"]["VALUE"]; ?></a>
			</p>
			<p class="mans">
			<?=$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0]?>
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
				Гражданство заселяемых:<br>
				
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

			<a class="btn btn--blue item__more" href="<?= $arElement["DETAIL_PAGE_URL"]; ?>">
				<span>Подробнее</span>
			</a>
		</div>
	</div>
	<? endforeach; ?>
<? endif ?>
</div> 
</div>
</div>