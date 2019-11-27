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
<div class="table-responsive">
  <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
  <? endif; ?>
  <div class="table-responsive">
    <table class="table">
      <thead>
      <tr>
        <th class="fs14 td-left td-top">Название общежитие</th>
        <th class="fs14 td-left td-top">Адрес</th>
        <th class="fs14 td-left td-top">Общее кол-во</th>
        <th class="fs14 td-left td-top">Простой</th>
        <th class="fs14 td-left td-top">Программа.</th>
        <th></th>
      </tr>
      </thead>
      <tbody>
  <? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>

      <tr id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <td><?=$arItem['NAME'] ?>
          <div class="add-link fs13 pt1"><a href="#">+ Добавить фото</a></div>
        </td>
        <td>Менделеевск, ул. Пушкина, 56-95</td>
        <td>
          <input class="styled" type="number" min="1" max="50" step="1" value="25">
        </td>
        <td><a href="#">5&nbsp;к/место</a></td>
        <td>Название программы</td>
        <td class="td-center">
          <div class="current-popup-inside">
            <a href="#q1" class="show-current-popup"><i class="icon icon-rename"></i></a>
            <div class="current-popup" id="q1">
              <div class="current-popup__back">
                <a href="#" class="close-current-popup"></a>
                <div class="vertical-form">
                  <form action="#">
                    <div class="form-groups">
                      <div class="form-group">
                        <input type="checkbox" class="styled align-top" id="i121" value="before" name="salary2">
                        <label for="i121">Хочу перейти на VIP-программу с сегодняшнего дня</label>
                      </div>
                    </div>
                    <p><strong>Хочу перейти со следующего месяца:</strong></p>
                    <div class="form-groups">
                      <div class="form-group">
                        <input type="radio" class="styled" id="i122" value="after" name="salary2">
                        <label for="i122">Программа 1</label>
                      </div>
                      <div class="form-group">
                        <input type="radio" class="styled" id="i123" value="after" name="salary2">
                        <label for="i123">Программа 2</label>
                      </div>
                    </div>
                    <div class="form-bottom align-right">
                      <input type="submit" class="btn btn--blue" value="Отправить">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>


  <? endforeach; ?>
      </tbody>
    </table>
  </div>
  <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
  <? endif; ?>
  <div class="form-bottom">
    <a class="btn btn--blue" href="#">Сохранить</a>
  </div>
</div>
