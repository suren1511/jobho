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
      if (in_array(14, $strGroups)) {
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
        <div class="vacancy__item-open"><? if (!in_array(14, $strGroups)) {?><a href="#">Откликнуться</a><?}?></div>
        <div class="vacancy__item-date">
          <time><?= $arItem['DISPLAY_ACTIVE_FROM'] ?></time>
        </div>
        <?
        if (in_array(14, $strGroups)) {

          if ($arItem['PROPERTIES']['MODERATOR']['VALUE'] == 'Y') {
            ?>
            <div class="status">Не опубликовано</div>
            <?
          }
          else {
            ?>
            <div class="status">Oпубликовано</div>

            <?
          }
        }
        ?>
      </div>
    </div>
  <? endforeach; ?>
  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
  <? endif; ?>
</div>
