<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<div class="left-offers-list">
	
	<? foreach ($arResult["ITEMS"] as $cell => $arElement) { ?>

		<div class="left-offers-list__item">
			<img alt="<?= $arElement["NAME"]; ?>" src="<? if (strlen($arElement["PREVIEW_PICTURE"]["SRC"]) > 1) echo $arElement["PREVIEW_PICTURE"]["SRC"]; else echo SITE_TEMPLATE_PATH."/img/no_photo.jpg" ?>" class="left-offers-list__img"/>
		
			<div class="left-offers-list__content">
				<div class="left-offers-list__place">
					<? if ($arElement["DISPLAY_PROPERTIES"]["napr"]["DISPLAY_VALUE"]) { ?>
						Московская область
					<? } else { ?>
						Москва
					<? } ?>
				</div>
				<a class="left-offers-list__link" <? if ($_SERVER['REQUEST_URI'] != $arElement["DETAIL_PAGE_URL"]): ?>href="<?= $arElement["DETAIL_PAGE_URL"] ?>"<? endif; ?>><?= $arElement["NAME"] ?></a>


				<div class="left-offers-list__price">
					Цена от:
					<? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
						<? if ($arPrice["CAN_ACCESS"]): ?>
							<? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
								<?= $arPrice["PRINT_VALUE"] ?> <span class="left-offers-list__catalog-price"><?= number_format( $arPrice["DISCOUNT_VALUE"] , 0, '.', ' ' ).' руб.' ?></span>
							<? else: ?>
								<span class="left-offers-list__catalog-price"><?= number_format( $arPrice["VALUE"] , 0, '.', ' ' ).' руб.' ?></span>
							<? endif; ?>

						<? endif; ?>
					<? endforeach; ?>
				</div>
			</div>

		</div>
	<? } ?>

	<div class="left-offers-list__all" >
		<a <? if ($_SERVER['REQUEST_URI'] != '/best_deals/'): ?>href="/best_deals/"<? endif; ?>>Все лучшие предложения</a>
	</div>
</div>
