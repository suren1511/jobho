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



<? if ($_REQUEST['STEP_NAZAD'] == 'ONE' && $_POST['ID']) {

  ?>
  <div class="steps">
    <div class="steps__item steps__item-active">1 <span>Шаг 1</span></div>
    <div class="steps__item">2 <span>Шаг 2</span></div>
    <div class="steps__item">3 <span>Шаг 3</span></div>
  </div>
  <div class="vertical-form">
    <form action="" method="post" id="step_one">
      <input type="hidden" name="STEP" value="TWO_DUBL">
      <input type="hidden" name="PROPERTY[CHERNOVIK]" value="2389">
      <input type="hidden" name="PROPERTY[USER]" value="<?= $USER->GetID() ?>">
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
<?
}
?>
<? if ($_REQUEST['STEP'] == 'ONE' || $_REQUEST['STEP_NAZAD'] == 'TWO' || $_REQUEST['STEP'] == 'TWO_DUBL') { ?>
  <div class="steps">
    <div class="steps__item">1 <span>Шаг 1</span></div>
    <div class="steps__item steps__item-active">2 <span>Шаг 2</span></div>
    <div class="steps__item">3 <span>Шаг 3</span></div>
  </div>
  <div class="vertical-form">
    <form action="" method="post" id="step_two">
      <input type="hidden" name="STEP" value="TWO">
      <input type="hidden" name="STEP_NAZAD" value="ONE">
      <input type="hidden" name="PROPERTY[CHERNOVIK]" value="2389">
      <input type="hidden" name="PROPERTY[USER]" value="<?= $USER->GetID() ?>">
      <input type="hidden" name="ID" value="<?= $arResult['ELEMENT']['ID'] ?>">


      <h2>Требования к кандидату</h2>
      <div class="form-groups">
        <div class="form-group">
          <div class="input-group">
            <textarea class="form-control" placeholder="Опишите какими навыками, инструментами и программами должен владеть кандидат" name="PROPERTY[TREBOVANIY]"><?= $arResult['ELEMENT']['PROPERTIES']['TREBOVANIY']['VALUE']['TEXT'] ?></textarea>
          </div>
        </div>
        <p class="nb">В соответствии с законом РФ № 1032-1 от 19.04.1991 в ред. от 02.07.2013
          г. запрещено размещать информацию, ограничивающую права или устанавливающую
          преимущества для соискателей по полу, возрасту, семейному положению и другим
          обстоятельствам, не связанным с деловыми качествами работников.</p>
      </div>

      <p><strong>Образование</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i31" value="2385" name="PROPERTY[OBRAZOVANIE]"<? if ($arResult['ELEMENT']['PROPERTIES']['OBRAZOVANIE']['VALUE_ENUM_ID'] == '2385') { ?> checked<? } ?>>
            <label for="i31">Высшее</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i32" value="2386" name="PROPERTY[OBRAZOVANIE]"<? if ($arResult['ELEMENT']['PROPERTIES']['OBRAZOVANIE']['VALUE_ENUM_ID'] == '2386') { ?> checked<? } ?>>
            <label for="i32">Среднее</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i33" value="2387" name="PROPERTY[OBRAZOVANIE]"<? if ($arResult['ELEMENT']['PROPERTIES']['OBRAZOVANIE']['VALUE_ENUM_ID'] == '2387') { ?> checked<? } ?>>
            <label for="i33">Неполное высшее</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i34" value="2388" name="PROPERTY[OBRAZOVANIE]"<? if ($arResult['ELEMENT']['PROPERTIES']['OBRAZOVANIE']['VALUE_ENUM_ID'] == '2388') { ?> checked<? } ?>>
            <label for="i34">Среднее специальное</label>
          </div>
        </div>
      </div>

      <p><strong>Категория водительских прав</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <?
            $prop = '';
            foreach ($arResult['ELEMENT']['PROPERTIES']['KATEGORY_PRAVA']['VALUE_ENUM_ID'] as $vals) {
              $prop[$vals] = $vals;
            }

            ?>
            <input type="checkbox" class="styled" id="i41" value="2390" name="PROPERTY[KATEGORY_PRAVA][]"<? if ($prop[2390] == '2390') { ?> checked<? } ?>>
            <label for="i41">A</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i42" value="2391" name="PROPERTY[KATEGORY_PRAVA][]"<? if ($prop[2391] == '2391') { ?> checked<? } ?>>
            <label for="i42">B</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i43" value="2392" name="PROPERTY[KATEGORY_PRAVA][]"<? if ($prop[2392] == '2392') { ?> checked<? } ?>>
            <label for="i43">C</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i44" value="2393" name="PROPERTY[KATEGORY_PRAVA][]"<? if ($prop[2393] == '2393') { ?> checked<? } ?>>
            <label for="i44">D</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i45" value="2394" name="PROPERTY[KATEGORY_PRAVA][]"<? if ($prop[2394] == '2394') { ?> checked<? } ?>>
            <label for="i45">E</label>
          </div>
        </div>
      </div>

      <p><strong>Опыт работы</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <?
            $prop = '';
            foreach ($arResult['ELEMENT']['PROPERTIES']['OPIT_RABOTI']['VALUE_ENUM_ID'] as $vals) {
              $prop[$vals] = $vals;
            }

            ?>
            <input type="checkbox" class="styled" id="i51" value="2395" name="PROPERTY[OPIT_RABOTI][]"<? if ($prop[2395] == '2395') { ?> checked<? } ?>>
            <label for="i51">Не важен</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i52" value="2396" name="PROPERTY[OPIT_RABOTI][]"<? if ($prop[2396] == '2396') { ?> checked<? } ?>>
            <label for="i52">от 3-5 лет</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i53" value="2397" name="PROPERTY[OPIT_RABOTI][]"<? if ($prop[2397] == '2397') { ?> checked<? } ?>>
            <label for="i53">от 1-3 лет</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i54" value="2398" name="PROPERTY[OPIT_RABOTI][]"<? if ($prop[2398] == '2398') { ?> checked<? } ?>>
            <label for="i54">более 6-ти лет</label>
          </div>
        </div>
      </div>

      <p><strong>Вакансия доступна соискателям</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <?
            $prop = '';
            foreach ($arResult['ELEMENT']['PROPERTIES']['DSOISKATEL']['VALUE_ENUM_ID'] as $vals) {
              $prop[$vals] = $vals;
            }

            ?>
            <input type="checkbox" class="styled" id="i61" value="2399" name="PROPERTY[DSOISKATEL][]"<? if ($prop[2399] == '2399') { ?> checked<? } ?>>
            <label for="i61">Из Регионов РФ</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i62" value="2400" name="PROPERTY[DSOISKATEL][]"<? if ($prop[2400] == '2400') { ?> checked<? } ?>>
            <label for="i62">Стран СНГ</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i63" value="2401" name="PROPERTY[DSOISKATEL][]"<? if ($prop[2401] == '2401') { ?> checked<? } ?>>
            <label for="i63">Стран ЕАЭС</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i64" value="2402" name="PROPERTY[DSOISKATEL][]"<? if ($prop[2402] == '2402') { ?> checked<? } ?>>
            <label for="i64">Дальнего зарубежья</label>
          </div>
        </div>
      </div>


      <div class="form-bottom">
        <input type="button" class="btn btn--red js_step_one" value="Назад">
        <input type="submit" class="btn btn--blue" value="Продолжить">
      </div>

    </form>
  </div>

<? } ?>
<? if ($_REQUEST['STEP'] == 'TWO') { ?>
  <div class="steps">
    <div class="steps__item">1 <span>Шаг 1</span></div>
    <div class="steps__item">2 <span>Шаг 2</span></div>
    <div class="steps__item steps__item-active">3 <span>Шаг 3</span></div>
  </div>

  <div class="vertical-form">
    <form action="" method="post" id="step_tree">
      <input type="hidden" name="STEP" value="TREE">
      <input type="hidden" name="PRED" value="Y">
      <input type="hidden" name="STEP_NAZAD" value="TWO">
      <input type="hidden" name="PROPERTY[CHERNOVIK]" value="2389">
      <input type="hidden" name="PROPERTY[MODERATOR]" value="2413">
      <input type="hidden" name="PROPERTY[USER]" value="<?= $USER->GetID() ?>">
      <input type="hidden" name="ID" value="<?= $arResult['ELEMENT']['ID'] ?>">
      <input type="hidden" value="" name="PROPERTY[OTKL]">
      <input type="hidden" value="" name="PROPERTY[PRICHINA]">
      <input type="hidden" value="" name="PROPERTY[hide]">

      <h2>Настройка публикации</h2>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini col-3 col-xs-6">
            <input type="radio" class="styled align-top" id="i01" value="2403" name="PROPERTY[OPENVAC]"<? if ($arResult['ELEMENT']['PROPERTIES']['OPENVAC']['VALUE_ENUM_ID'] == '2403') { ?> checked<? } ?>>
            <label for="i01">Открытая вакансия <span>Вакансия показывается на сайте и видна всем посетителям сайта.</span></label>
          </div>
          <div class="form-group-mini col-3 col-xs-6">
            <input type="radio" class="styled align-top" id="i02" value="2404" name="PROPERTY[OPENVAC]"<? if ($arResult['ELEMENT']['PROPERTIES']['OPENVAC']['VALUE_ENUM_ID'] == '2404') { ?> checked<? } ?>>
            <label for="i02">Закрытая вакансия <span>Вакансия не показывается на сайте. Вы самостоятельно ищете резюме и отправляете вакансию.</span></label>
          </div>
        </div>
      </div>

      <p><strong>Показывать в вакансии</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <?
            $prop = '';
            foreach ($arResult['ELEMENT']['PROPERTIES']['KONTATOPEN']['VALUE_ENUM_ID'] as $vals) {
              $prop[$vals] = $vals;
            }

            ?>
            <input type="checkbox" class="styled" id="i11" value="2405" name="PROPERTY[KONTATOPEN][]"<? if ($prop[2405] == '2405') { ?> checked<? } ?>>
            <label for="i11">Все контакты</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i12" value="2406" name="PROPERTY[KONTATOPEN][]"<? if ($prop[2406] == '2406') { ?> checked<? } ?>>
            <label for="i12">E-mail</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i13" value="2407" name="PROPERTY[KONTATOPEN][]"<? if ($prop[2407] == '2407') { ?> checked<? } ?>>
            <label for="i13">Телефон</label>
          </div>
          <div class="form-group-mini">
            <input type="checkbox" class="styled" id="i14" value="2408" name="PROPERTY[KONTATOPEN][]"<? if ($prop[2408] == '2408') { ?> checked<? } ?>>
            <label for="i14">Не указывать</label>
          </div>
        </div>
      </div>

      <h2>Контактные данные</h2>
      <div class="form-groups">
        <div class="form-group">
          <label for="i1">Контактное лицо</label>
          <div class="input-group">
            <input class="form-control" type="text" id="i1" value="<?= $arResult['ELEMENT']['PROPERTIES']['CONTACT']['VALUE'] ?>" name="PROPERTY[CONTACT]">
          </div>
        </div>
        <div class="form-group">
          <label for="i2">Телефон</label>
          <div class="input-group">
            <input class="form-control" type="text" id="i2" value="<?= $arResult['ELEMENT']['PROPERTIES']['PHONE']['VALUE'] ?>" name="PROPERTY[PHONE]" placeholder="+7 ___ ___ __ __">
          </div>
        </div>
        <div class="form-group">
          <label for="i3">E-mail</label>
          <div class="input-group">
            <input class="form-control" type="email" id="i3" value="<?= $arResult['ELEMENT']['PROPERTIES']['EMAIL']['VALUE'] ?>" name="PROPERTY[EMAIL]" placeholder="exemple@exemple.com">
          </div>
        </div>
      </div>

      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini col-6">
            <input type="checkbox" class="styled align-top" id="i20" value="2409" name="PROPERTY[SABLON]"<? if ($arResult['ELEMENT']['PROPERTIES']['SABLON']['VALUE_ENUM_ID'] == '2409') { ?> checked<? } ?>>
            <label for="i20"><b>Сохранить вакансию, как шаблон</b><span>Если вы часто создаёте однотипные вакансии в разных городах, сохраните вакансию как шаблон</span></label>
          </div>
        </div>
      </div>

      <p><strong>Тип вакансии</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i31" value="2410" name="PROPERTY[TYPE]"<? if ($arResult['ELEMENT']['PROPERTIES']['TYPE']['VALUE_ENUM_ID'] == '2410') { ?> checked<? } ?>>
            <label for="i31">Бесплатная</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i32" value="2411" name="PROPERTY[TYPE]"<? if ($arResult['ELEMENT']['PROPERTIES']['TYPE']['VALUE_ENUM_ID'] == '2411') { ?> checked<? } ?>>
            <label for="i32">Автообновление</label>
          </div>
          <div class="form-group-mini">
            <input type="radio" class="styled" id="i33" value="2412" name="PROPERTY[TYPE]"<? if ($arResult['ELEMENT']['PROPERTIES']['TYPE']['VALUE_ENUM_ID'] == '2412') { ?> checked<? } ?>>
            <label for="i33">Премиум</label>
          </div>
        </div>
      </div>


      <div class="form-bottom">
        <input type="button" class="btn btn--red js_step_two" value="Назад">
        <a class="preview" href="#">Предварительный просмотр</a>
        <input type="submit" class="btn btn--blue" value="Разместить вакансию">
      </div>

    </form>
  </div>

<? }
if ($_REQUEST['ID'] && $_REQUEST['PRED']=='Y'){
  $APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "amt_vacans_pred",
    array(
      "ACTIVE_DATE_FORMAT" => "j F Y",
      "ADD_ELEMENT_CHAIN" => "N",
      "ADD_SECTIONS_CHAIN" => "N",
      "AJAX_MODE" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "BROWSER_TITLE" => "-",
      "CACHE_GROUPS" => "Y",
      "CACHE_TIME" => "36000000",
      "CACHE_TYPE" => "A",
      "CHECK_DATES" => "N",
      "DETAIL_URL" => "",
      "DISPLAY_BOTTOM_PAGER" => "Y",
      "DISPLAY_DATE" => "Y",
      "DISPLAY_NAME" => "Y",
      "DISPLAY_PICTURE" => "Y",
      "DISPLAY_PREVIEW_TEXT" => "Y",
      "DISPLAY_TOP_PAGER" => "N",
      "ELEMENT_CODE" => "",
      "ELEMENT_ID" => $_REQUEST['ID'],
      "FIELD_CODE" => array(
        0 => "ID",
        1 => "CODE",
        2 => "XML_ID",
        3 => "NAME",
        4 => "TAGS",
        5 => "SORT",
        6 => "PREVIEW_TEXT",
        7 => "PREVIEW_PICTURE",
        8 => "DETAIL_TEXT",
        9 => "DETAIL_PICTURE",
        10 => "DATE_ACTIVE_FROM",
        11 => "ACTIVE_FROM",
        12 => "DATE_ACTIVE_TO",
        13 => "ACTIVE_TO",
        14 => "SHOW_COUNTER",
        15 => "SHOW_COUNTER_START",
        16 => "IBLOCK_TYPE_ID",
        17 => "IBLOCK_ID",
        18 => "IBLOCK_CODE",
        19 => "IBLOCK_NAME",
        20 => "IBLOCK_EXTERNAL_ID",
        21 => "DATE_CREATE",
        22 => "CREATED_BY",
        23 => "CREATED_USER_NAME",
        24 => "TIMESTAMP_X",
        25 => "MODIFIED_BY",
        26 => "USER_NAME",
        27 => "",
      ),
      "IBLOCK_ID" => "20",
      "IBLOCK_TYPE" => "cabinet",
      "IBLOCK_URL" => "",
      "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
      "MESSAGE_404" => "",
      "META_DESCRIPTION" => "-",
      "META_KEYWORDS" => "-",
      "PAGER_BASE_LINK_ENABLE" => "N",
      "PAGER_SHOW_ALL" => "N",
      "PAGER_TEMPLATE" => ".default",
      "PAGER_TITLE" => "Страница",
      "PROPERTY_CODE" => array(
        0 => "REGION",
        1 => "RAION",
        2 => "SYTI",
        3 => "METRO",
        4 => "STRIT",
        5 => "HOUM",
        6 => "STROENIE",
        7 => "CORPUS",
        8 => "OBRAZOVANIE",
        9 => "USLOVIY",
        10 => "OBYZANN",
        11 => "TREBOVANIY",
        12 => "DOHOD",
        13 => "OPIT_RABOTI",
        14 => "HARAKTER",
        15 => "GRAFIK",
        16 => "DSOISKATEL",
        17 => "USER",
        18 => "DOHOD_DO",
        19 => "DOHOD_OT",
        20 => "KATEGORY_PRAVA",
        21 => "CONTACT",
        22 => "OPENVAC",
        23 => "KONTATOPEN",
        24 => "PREDOSTAV",
        25 => "PHONE",
        26 => "TYPE",
        27 => "EMAIL",
        28 => "",
      ),
      "SET_BROWSER_TITLE" => "Y",
      "SET_CANONICAL_URL" => "N",
      "SET_LAST_MODIFIED" => "N",
      "SET_META_DESCRIPTION" => "N",
      "SET_META_KEYWORDS" => "Y",
      "SET_STATUS_404" => "N",
      "SET_TITLE" => "Y",
      "SHOW_404" => "N",
      "STRICT_SECTION_CHECK" => "N",
      "USE_PERMISSIONS" => "N",
      "USE_SHARE" => "N",
      "COMPONENT_TEMPLATE" => "amt_vacans"
    ),
    false
  );
}

?>
