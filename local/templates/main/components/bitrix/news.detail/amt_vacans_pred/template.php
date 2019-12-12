<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<div class="vacancy_list">
  <div class="vacancy__item">
    <div class="vacancy__item-name">
      <div><?=$arResult['NAME'] ?></div>
    </div>
    <div class="vacancy__item-logo">
<!--      <a href="#"><img src="images/logo-company.png" alt=""></a>-->
    </div>
    <div class="vacancy__item-type">
<!--      <a href="#">Клео-Логистик</a>-->
    </div>
    <div class="vacancy__item-address"><? if ($arResult['PROPERTIES']['SYTI']['VALUE']) { ?><?= $arResult['PROPERTIES']['SYTI']['VALUE'] ?>,<? } ?><?= $arResult['PROPERTIES']['METRO']['VALUE'] ?></div>
    <div class="vacancy__item-salary"><?= number_format($arResult['PROPERTIES']['DOHOD_OT']['VALUE'], 0, ',', ' ') ?>-<?= number_format($arResult['PROPERTIES']['DOHOD_DO']['VALUE'], 0, ',', ' ') ?> руб.</div>
    <div class="vacancy__item-details">
    <? foreach ($arResult['DISPLAY_PROPERTIES'] as $key=>$arProperty){?>


      <div class="vacancy__item-details-item"><strong><?=$arProperty['NAME'] ?>:</strong>
        <? if (is_array($arProperty["DISPLAY_VALUE"])) { ?>
          <?= implode(" / ", $arProperty["DISPLAY_VALUE"]); ?>
          <?
        }else{ ?>
          <?= $arProperty["DISPLAY_VALUE"]; ?>
        <? } ?>
      </div>
      <?}?>
    </div>
    <div class="vacancy__item-date"><time>Вакансия опубликована <?=$arResult['DISPLAY_ACTIVE_FROM'] ?></time></div>
    <div class="vacancy__item-bottom">
      <div data-id="<?=$arResult['ID'] ?>" class="vacancy__item-open form-bottom">
        <a href="#" class="btn btn--red js_presv_nazad">Назад</a>
        <a href="#" class="btn btn--blue js_pablick">Опубликовать</a>
      </div>
    </div>
  </div>
</div>