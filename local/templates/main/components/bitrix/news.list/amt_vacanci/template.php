<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$arCurDir = explode('/', $CURRENT_DIR);
$strGroups = CUser::GetUserGroupArray();

?>
<div class="vacancy_list">
  <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
  <? endif; ?>
  <? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="vacancy__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

      <div class="vacancy__item-name">
        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a>
      </div>
      <?
      if (in_array(14, $strGroups) || in_array(15, $strGroups)) {
        ?>
        <div class="redactor"><form method="post" action="/personal/vacancy/new_vacancy.php">
            <input name="STEP_NAZAD" value="ONE" type="hidden">
            <input name="ID" value="<?=$arItem['ID'] ?>" type="hidden">
            <input type="submit" value="Редактировать" class="btn btn_red amt_btn vacansy">
          </form></div>
        <?
      }
      ?>
      <div class="vacancy__item-type">

      </div>
      <div class="vacancy__item-address"><? if ($arItem['PROPERTIES']['SYTI']['VALUE']) { ?><?= $arItem['PROPERTIES']['SYTI']['VALUE'] ?>,<? } ?><?= $arItem['PROPERTIES']['METRO']['VALUE'] ?></div>
      <div class="vacancy__item-salary"><?= number_format($arItem['PROPERTIES']['DOHOD_OT']['VALUE'], 0, ',', ' ') ?>-<?= number_format($arItem['PROPERTIES']['DOHOD_DO']['VALUE'], 0, ',', ' ') ?> руб.</div>
      <div class="vacancy__item-text">
        <p><?= $arItem['PROPERTIES']['OBYZANN']['VALUE']['TEXT'] ?></p>
      </div>
      <div class="vacancy__item-bottom">
        <div class="vacancy__item-open"><? if (!in_array('6', $strGroups) && !in_array('14', $strGroups) && !in_array(15, $strGroups)) {?><a href="#">Откликнуться</a><?}?></div>
        <div class="vacancy__item-date">
          <time><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></time>
        </div>
        <?
        if (in_array(14, $strGroups) || in_array(15, $strGroups)) {

          if (!$arItem['PROPERTIES']['MODERATOR']['VALUE'] && !$arItem['PROPERTIES']['OTKL']['VALUE']) {
            ?>
            <div class="status">Опубликовано</div>
            <?
          }
          else {
            ?>
            <div class="status"><?
              if ($arItem['PROPERTIES']['OTKL']['VALUE']){
                ?>Отклонено<?
                if (empty($arItem['PROPERTIES']['hide']['VALUE'])){
                  ?>: <?=$arItem['PROPERTIES']['PRICHINA']['VALUE'] ?><?}?><?
              } else{
                if (!$arItem['PROPERTIES']['CHERNOVIK']['VALUE']) {
                  ?>На модерации<?
                }
                }
              ?>
            <?
            if ($arItem['PROPERTIES']['CHERNOVIK']['VALUE']){
              ?>
              Черновик
              <?
            }
            ?>
            </div>
            <?
          }
        }

        ?>
      </div>
      <?
      if (in_array(6, $strGroups)){

        ?>
        <div class="vacancy__item-bottom align-right" data-id="<?=$arItem['ID'] ?>">
          <div class="vacancy__item-status"><span class="red">
              <?if (!$arItem['PROPERTIES']['MODERATOR']['VALUE'] && !$arItem['PROPERTIES']['OTKL']['VALUE']) {
            ?>
            <span class="status">Опубликовано</span>
            <?
          }
          else {
            ?>
            <span class="status"><? if ($arItem['PROPERTIES']['OTKL']['VALUE']){?>Отклонено<?} else{?>На модерации<?}?></span>

            <?
          }?>
            </span><? if (!$arItem['PROPERTIES']['hide']['VALUE']){?><? if ($arItem['PROPERTIES']['PRICHINA']['VALUE']){?>: <?=$arItem['PROPERTIES']['PRICHINA']['VALUE'] ?><?}?><?}?></div>
          <div class="vacancy__item-open js_odobrit"><a href="#">Одобрить</a></div>
          <div class="vacancy__item-reject">
            <a href="#popup-d<?=$arItem['ID'] ?>" class="show-current-popup">Отклонить</a>
            <div class="current-popup" id="popup-d<?=$arItem['ID'] ?>">
              <div class="current-popup__back">
                <a href="#" class="close-current-popup"></a>
                <div class="vertical-form">
                  <form action="#" name="otklon" id="form_otk<?=$arItem['ID'] ?>" class="formotkl" data-form="form_otk<?=$arItem['ID'] ?>">
                    <input type="hidden" value="Y" name="OTKL">
                    <input type="hidden" value="<?=$arItem['ID'] ?>" name="ID">
                    <input type="hidden" value="2471" name="PROPERTY[OTKL]">
                    <input type="hidden" value="2413" name="PROPERTY[MODERATOR]">
                    <input type="hidden" value="" name="PROPERTY[hide]">
                    <div class="form-groups">
                      <div class="form-group">
                        <input type="radio" class="styled" id="q12<?=$arItem['ID'] ?>" value="Не правильно заполнено" name="PROPERTY[PRICHINA]">
                        <label for="q12<?=$arItem['ID'] ?>">Не правильно заполнено </label>
                      </div>
                      <div class="form-group">
                        <input type="radio" class="styled" id="q22<?=$arItem['ID'] ?>" value="Не полностью заполнено" name="PROPERTY[PRICHINA]">
                        <label for="q22<?=$arItem['ID'] ?>">Не полностью заполнено</label>
                      </div>
                      <div class="form-group">
                        <input type="radio" class="styled" id="q32<?=$arItem['ID'] ?>" value="Вымышленное" name="PROPERTY[PRICHINA]">
                        <label for="q32<?=$arItem['ID'] ?>">Вымышленное</label>
                      </div>
                      <div class="form-group">
                        <input type="radio" class="styled" id="q42<?=$arItem['ID'] ?>" value="Реклама" name="PROPERTY[PRICHINA]">
                        <label for="q42<?=$arItem['ID'] ?>">Реклама</label>
                      </div>
                      <div class="form-group">
                        <input type="radio" class="styled" id="q52<?=$arItem['ID'] ?>" value="Ненормативная лексика" name="PROPERTY[PRICHINA]">
                        <label for="q52<?=$arItem['ID'] ?>">Ненормативная лексика</label>
                      </div>
                      <div class="form-group">
                        <input type="radio" class="styled" id="q62<?=$arItem['ID'] ?>" value="Другое" name="PROPERTY[PRICHINA]">
                        <label for="q62<?=$arItem['ID'] ?>">Другое</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="PROPERTY[PRICHINA_TEXT]"></textarea>
                    </div>
                    <div class="form-bottom">
                      <input type="checkbox" id="popup-hide<?=$arItem['ID'] ?>" class="styled" name="PROPERTY[hide]" value="1">
                      <label for="popup-hide<?=$arItem['ID'] ?>">Не показывать</label>
                      <input type="submit" class="btn btn--blue js_otclon" value="Отправить">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?

      }
      ?>
    </div>
  <? endforeach; ?>
  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
  <? endif; ?>
</div>
