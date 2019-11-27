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
<form method="post" action="/personal/vacancy/new_vacancy.php">
  <input name="STEP_NAZAD" value="ONE" type="hidden">

  <div class="b-personal-buttons">
    <input type="submit" class="btn btn--blue" value="Передать вакансию">
  </div>
  <div class="vacancy-templates__list">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
      <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
      <?
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
      ?>
      <div class="vacancy-templates__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

        <input class="styled" id="vac<?= $arItem['ID'] ?>" type="radio" value="<?= $arItem['ID'] ?>" name="ID">
        <label for="vac<?= $arItem['ID'] ?>"><?= $arItem['NAME'] ?></label>
        <a class="vacancy-templates__item-delete delete-vacancy" href="#"><i class="icon icon-delete"></i></a>

      </div>
    <? endforeach; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
      <?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
  </div>
</form>
