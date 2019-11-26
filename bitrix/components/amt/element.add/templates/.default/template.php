<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
  die();
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

/*$this->addExternalCss(SITE_TEMPLATE_PATH . '/css/edit_company.css');
$this->addExternalJS(SITE_TEMPLATE_PATH . "/plagins/loadfile/load-image.all.min.js");*/


?>
<?if (count($arResult["ERRORS"])):?>
  <?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
  <?=ShowNote($arResult["MESSAGE"])?>
<?endif?>

<div class="js_block_nev_vac">
  <div class="steps">
    <div class="steps__item steps__item-active">1 <span>Шаг 1</span></div>
    <div class="steps__item">2 <span>Шаг 2</span></div>
    <div class="steps__item">3 <span>Шаг 3</span></div>
  </div>
  <div class="vertical-form">
    <form action="" method="post" id="step_one">
      <input type="hidden" name="STEP" value="ONE">
      <input type="hidden" name="PROPERTY[CHERNOVIK]" value="2389">
      <input type="hidden" name="PROPERTY[MODERATOR]" value="2413">
      <input type="hidden" name="PROPERTY[USER]" value="<?=$USER->GetID() ?>">
      <input type="hidden" name="ID" value="<?= $arResult['ELEMENT']['ID'] ?>">
      <div class="form-groups">
        <div class="form-group">
          <label for="i1" class="required">Должность</label>
          <div class="input-group">
            <input class="form-control" type="text" id="i1" value="<?= $arResult['ELEMENT']['NAME'] ?>" name="NAME">
          </div>
        </div>
        <div class="form-group">
          <label for="i2" class="required">Рубрика каталога</label>
          <div class="input-group">
            <select class="form-control" id="i2" name="SECTION">
              <option value="" hidden>Выберите рубрику</option>
              <? foreach ($arResult['SECTIONS'] as $SECTION) { ?>
                <option value="<?= $SECTION['ID'] ?>"<? if ($arResult['ELEMENT']['IBLOCK_SECTION_ID'] == $SECTION['ID']) { ?> selected<? } ?>><?= $SECTION['NAME'] ?></option>
              <? } ?>
            </select>
          </div>
        </div>
      </div>

      <h2>Место работы</h2>
      <div class="form-groups">
        <div class="form-group">
          <label for="i3">Регион</label>
          <div class="input-group">
            <select class="form-control" id="i3" name="PROPERTY[REGION]">
              <option value="" hidden>Выберите регион</option>
              <? foreach ($arResult['REGIONS'] as $REGION) { ?>
                <option value="<?= $REGION['NAME'] ?>"<? if ($arResult['ELEMENT']['PROPERTIES']['REGION']['VALUE'] == $REGION['NAME']) { ?> selected<? } ?>><?= $REGION['NAME'] ?></option>
              <? } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="i4">Город</label>
          <div class="input-group">
            <select class="form-control" id="i4" name="PROPERTY[SYTI]">
              <? if ($arResult['ELEMENT']['PROPERTIES']['SYTI']['VALUE']) { ?>
                <option value="<?= $arResult['ELEMENT']['PROPERTIES']['SYTI']['VALUE'] ?>" hidden><?= $arResult['ELEMENT']['PROPERTIES']['SYTI']['VALUE'] ?></option>
              <? } else { ?>
                <option value="" hidden>Выберите город</option>
                <?
              } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="i5">Улица</label>
          <div class="input-group">
            <input class="form-control" type="text" id="i5" value="<?= $arResult['ELEMENT']['PROPERTIES']['STRIT']['VALUE'] ?>" name="PROPERTY[STRIT]">
          </div>
          <div class="input-group-append">
            <input class="form-control" type="text" value="<?= $arResult['ELEMENT']['PROPERTIES']['HOUM']['VALUE'] ?>" placeholder="Дом" name="PROPERTY[HOUM]">
            <input class="form-control" type="text" value="<?= $arResult['ELEMENT']['PROPERTIES']['STROENIE']['VALUE'] ?>" placeholder="Строение" name="PROPERTY[STROENIE]">
            <input class="form-control" type="text" value="<?= $arResult['ELEMENT']['PROPERTIES']['CORPUS']['VALUE'] ?>" placeholder="Корпус" name="PROPERTY[CORPUS]">
          </div>
        </div>
        <div class="form-group">
          <label for="i6">Район</label>
          <div class="input-group">
            <input class="form-control" type="text" id="i6" value="<?= $arResult['ELEMENT']['PROPERTIES']['RAION']['VALUE'] ?>" name="PROPERTY[RAION]">
          </div>
        </div>
        <div class="form-group">
          <label for="i7">Метро</label>
          <div class="input-group">
            <input class="form-control" type="text" id="i7" value="<?= $arResult['ELEMENT']['PROPERTIES']['METRO']['VALUE'] ?>" name="PROPERTY[METRO]">
          </div>
        </div>
      </div>

      <h2>Уровень дохода</h2>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <label for="i10">От</label>
            <div class="input-group rub">
              <input type="text" class="form-control" id="i10" value="<?= $arResult['ELEMENT']['PROPERTIES']['DOHOD_OT']['VALUE'] ?>" name="PROPERTY[DOHOD_OT]">
            </div>
          </div>
          <div class="form-group-mini">
            <label for="i11">До</label>
            <div class="input-group rub">
              <input type="text" class="form-control" id="i11" value="<?= $arResult['ELEMENT']['PROPERTIES']['DOHOD_DO']['VALUE'] ?>" name="PROPERTY[DOHOD_DO]">
            </div>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i12" value="2372" name="PROPERTY[DOHOD]"<? if ($arResult['ELEMENT']['PROPERTIES']['DOHOD']['VALUE_ENUM_ID'] == '2372') { ?> checked<?
            } ?>>
            <label for="i12">До вычета НДФЛ:</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i13" value="2373" name="PROPERTY[DOHOD]"<? if ($arResult['ELEMENT']['PROPERTIES']['DOHOD']['VALUE_ENUM_ID'] == '2373') { ?> checked<?
            } ?>>
            <label for="i13">На руки:</label>
          </div>
        </div>
      </div>

      <p><strong>Характер работы</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i21" value="2374" name="PROPERTY[HARAKTER]"<? if ($arResult['ELEMENT']['PROPERTIES']['HARAKTER']['VALUE_ENUM_ID'] == '2374') { ?> checked<?
            } ?>>
            <label for="i21">На территории работодателя</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i22" value="2375" name="PROPERTY[HARAKTER]"<? if ($arResult['ELEMENT']['PROPERTIES']['HARAKTER']['VALUE_ENUM_ID'] == '2375') { ?> checked<?
            } ?>>
            <label for="i22">Работа на дому</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i23" value="2376" name="PROPERTY[HARAKTER]"<? if ($arResult['ELEMENT']['PROPERTIES']['HARAKTER']['VALUE_ENUM_ID'] == '2376') { ?> checked<?
            } ?>>
            <label for="i23">Разъездная работа</label>
          </div>
        </div>
      </div>

      <p><strong>График работы</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i31" value="2377" name="PROPERTY[GRAFIK]"<? if ($arResult['ELEMENT']['PROPERTIES']['GRAFIK']['VALUE_ENUM_ID'] == '2377') { ?> checked<?
            } ?>>
            <label for="i31">Полный рабочий день (5/2)</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i32" value="2378" name="PROPERTY[GRAFIK]"<? if ($arResult['ELEMENT']['PROPERTIES']['GRAFIK']['VALUE_ENUM_ID'] == '2378') { ?> checked<?
            } ?>>
            <label for="i32">Сменный график</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i33" value="2379" name="PROPERTY[GRAFIK]"<? if ($arResult['ELEMENT']['PROPERTIES']['GRAFIK']['VALUE_ENUM_ID'] == '2379') { ?> checked<?
            } ?>>
            <label for="i33">Вахтовый метод</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i34" value="2380" name="PROPERTY[GRAFIK]"<? if ($arResult['ELEMENT']['PROPERTIES']['GRAFIK']['VALUE_ENUM_ID'] == '2380') { ?> checked<?
            } ?>>
            <label for="i34">Гибкий график</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i35" value="2381" name="PROPERTY[GRAFIK]"<? if ($arResult['ELEMENT']['PROPERTIES']['GRAFIK']['VALUE_ENUM_ID'] == '2381') { ?> checked<?
            } ?>>
            <label for="i35">Подработка</label>
          </div>
        </div>
      </div>

      <p><strong>Предоставляется</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <?
            $prop = '';
            foreach ($arResult['ELEMENT']['PROPERTIES']['PREDOSTAV']['VALUE_ENUM_ID'] as $vals) {
              $prop[$vals] = $vals;
            }

            ?>
            <input type="checkbox" class="styled" id="i41" value="2382" name="PROPERTY[PREDOSTAV][]"<? if ($prop[2382] == '2382') { ?> checked<?
            } ?>>
            <label for="i41">Проживание</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i42" value="2383" name="PROPERTY[PREDOSTAV][]"<? if ($prop[2383] == '2383') { ?> checked<?
            } ?>>
            <label for="i42">Питание</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i43" value="2384" name="PROPERTY[PREDOSTAV][]"<? if ($prop[2384] == '2384') { ?> checked<?
            } ?>>
            <label for="i43">Обучение</label>
          </div>
        </div>
      </div>

      <h2>Условия работы</h2>
      <div class="form-groups">
        <div class="form-group">
          <div class="input-group">
            <textarea class="form-control" placeholder="Опишите условия работы" name="PROPERTY[USLOVIY]"><?= $arResult['ELEMENT']['PROPERTIES']['USLOVIY']['VALUE']['TEXT'] ?></textarea>
          </div>
        </div>
      </div>

      <h2>Обязанности</h2>
      <div class="form-groups">
        <div class="form-group">
          <div class="input-group">
            <textarea class="form-control" placeholder="Опишите обязанности" name="PROPERTY[OBYZANN]"><?= $arResult['ELEMENT']['PROPERTIES']['OBYZANN']['VALUE']['TEXT'] ?></textarea>
          </div>
        </div>
      </div>

      <div class="form-bottom">
        <a href="/personal/vacancy/" class="btn btn--red">Назад</a>
        <input type="submit" class="btn btn--blue js_step_1" value="Продолжить">
      </div>

    </form>
  </div>
</div>