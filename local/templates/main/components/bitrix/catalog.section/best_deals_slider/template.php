<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="dormitory-filter">
<div class="dormitory-sort" id="sort" property="qwerty">
<div id="mycarousel-for-main" class="for-main">
<? if (!empty($arResult["ITEMS"])): ?>
	<? foreach ($arResult["ITEMS"] as $cell => $arElement):?>

	<div class="item" onclick="window.location.href = '<?= $arElement["DETAIL_PAGE_URL"] ?>';"
		 id="sorting_<?= $arElement['ID'] ?>" style="<?=$style?>">

		<div class="name">
			<div class="bg-img" style="background-image:url(<? if (strlen($arElement['PREVIEW_PICTURE']['SRC']) > 1) echo "'".$arElement['PREVIEW_PICTURE']['SRC']."'"; else echo '/images/no_photo.jpg' ?>);"></div>
		</div>
		<div class="descr">
			<p class="descr__name"><?= $arElement["NAME"]; ?></p>
			
			<p class="descr__metro">
				<?if(!empty($arElement["PROPERTIES"]["metro"]["VALUE"])):?>
					<img alt="рядом с метро" src="<?=SITE_TEMPLATE_PATH?>/img/metro.png"><a href="/metro_<?=$arElement["PROPERTIES"]["metro"]['VALUE_XML_ID'][0]?>/"><?= $arElement["PROPERTIES"]["metro"]["VALUE"][0]; ?></a>
				<?else:?>
					<img alt="направление" src="<?=SITE_TEMPLATE_PATH?>/img/dormitory.png">
					<a href="<?= $arElement["PROPERTIES"]["oblrayoni"]["VALUE_XML_ID"][0]?>" class="link"><?= $arElement["PROPERTIES"]["oblrayoni"]["VALUE"][0]; ?></a>
				<?endif?>
			</p>
			
					
			
			<p class="descr__street">
				<a href="<?= $arElement["DETAIL_PAGE_URL"] . '#tomap' ?>"><?= $arElement["PROPERTIES"]["ulica"]["VALUE"]; ?></a>
			</p>
			<p class="mans">
				<? if (!empty($arElement["PROPERTIES"]["mskokruga"]["VALUE"])):?>
					<a href='/<?=$arElement["PROPERTIES"]["mskokruga"]["VALUE_XML_ID"][0]?>/'><?=$arElement["PROPERTIES"]["mskokruga"]["VALUE"][0]?></a>
				<? else: ?>
					<a href="/dormitory_suburbs/<?=trim($arElement['PROPERTIES']['napr']['VALUE_XML_ID'][0])?>/"><?=$arElement["PROPERTIES"]["napr"]["VALUE"][0]?></a>
				<? endif ?>
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