<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Резюме"); ?>
<?
if(!$USER->IsAuthorized())
{
    LocalRedirect('/auth/');
}
else {
    $strGroups = CUser::GetUserGroupArray();
    $arUser = CUser::GetByID($USER->GetID())->Fetch();

  if (in_array(12, $strGroups)){

  }

    if (in_array(12, $strGroups)): //соискатели ?>
        <? if ($arUser["ID"]): ?>
        <?
        $resResume = CIBlockElement::GetList(
            array(),
            array(
                "IBLOCK_ID" => 21,
                "=PROPERTY_USER" => $arUser["ID"]
            ),
            false,
            false,
            array(
                "ID",
                "PREVIEW_PICTURE",
                "PREVIEW_TEXT",
                "PROPERTY_FIRST_NAME",
                "PROPERTY_LAST_NAME",
                "PROPERTY_PHONE",
                "PROPERTY_EMAIL",
                "PROPERTY_B_DATE",
                "PROPERTY_GENDER",//
                "PROPERTY_NATIONALITY",//
                "PROPERTY_WORK_ACCESS",
                "PROPERTY_REGION",
                "PROPERTY_RESUME_TYPE",//
                "PROPERTY_RESUME_SHOW",//
                "PROPERTY_EXP",//
                "PROPERTY_POSITION",
                "PROPERTY_PAY",
                "PROPERTY_PROF_AREA",//
                "PROPERTY_USER",
                "PROPERTY_EDUC_LEVEL",//
                "PROPERTY_LANG_NATIVE",
                "PROPERTY_LANG_FOREIGN",
                "PROPERTY_RELOCATION",//
                "PROPERTY_HAVE_AUTO",//
            )
        );
        if ($arResume = $resResume->GetNext()) {
            $resumeData = array(
                "ID" => $arResume["ID"],
                "PROPERTY_FIRST_NAME_VALUE" => $arResume["PROPERTY_FIRST_NAME_VALUE"],
                "PROPERTY_LAST_NAME_VALUE" => $arResume["PROPERTY_LAST_NAME_VALUE"],
                "PROPERTY_PHONE_VALUE" => $arResume["PROPERTY_PHONE_VALUE"],
                "PROPERTY_EMAIL_VALUE" => $arResume["PROPERTY_EMAIL_VALUE"],
                "PROPERTY_B_DATE_VALUE" => $arResume["PROPERTY_B_DATE_VALUE"],
                "PROPERTY_GENDER_VALUE" => $arResume["PROPERTY_GENDER_ENUM_ID"],
                "PROPERTY_GENDER_SHOW_VALUE" => $arResume["PROPERTY_GENDER_VALUE"],
                "PROPERTY_NATIONALITY_VALUE" => $arResume["PROPERTY_NATIONALITY_ENUM_ID"],
                "PROPERTY_NATIONALITY_SHOW_VALUE" => $arResume["PROPERTY_NATIONALITY_VALUE"],
                "PROPERTY_WORK_ACCESS_VALUE" => $arResume["PROPERTY_WORK_ACCESS_VALUE"],
                "PROPERTY_REGION_VALUE" => $arResume["PROPERTY_REGION_VALUE"],
                "PROPERTY_RESUME_TYPE_VALUE" => $arResume["PROPERTY_RESUME_TYPE_ENUM_ID"],
                "PROPERTY_RESUME_TYPE_SHOW_VALUE" => $arResume["PROPERTY_RESUME_TYPE_VALUE"],
                "PROPERTY_RESUME_SHOW_VALUE" => $arResume["PROPERTY_RESUME_SHOW_ENUM_ID"],
                "PROPERTY_RESUME_SHOW_SHOW_VALUE" => $arResume["PROPERTY_RESUME_SHOW_VALUE"],
                "PROPERTY_EXP_VALUE" => $arResume["PROPERTY_EXP_ENUM_ID"],
                "PROPERTY_EXP_SHOW_VALUE" => $arResume["PROPERTY_EXP_VALUE"],
                "PROPERTY_POSITION_VALUE" => $arResume["PROPERTY_POSITION_VALUE"],
                "PROPERTY_PAY_VALUE" => $arResume["PROPERTY_PAY_VALUE"],
                "PROPERTY_PROF_AREA_VALUE" => $arResume["PROPERTY_PROF_AREA_ENUM_ID"],
                "PROPERTY_PROF_AREA_SHOW_VALUE" => $arResume["PROPERTY_PROF_AREA_VALUE"],
                "PROPERTY_USER_VALUE" => $arResume["PROPERTY_USER_VALUE"],
                "PROPERTY_EDUC_LEVEL_VALUE" => $arResume["PROPERTY_EDUC_LEVEL_ENUM_ID"],
                "PROPERTY_EDUC_LEVEL_SHOW_VALUE" => $arResume["PROPERTY_EDUC_LEVEL_VALUE"],
                "PROPERTY_LANG_NATIVE_VALUE" => $arResume["PROPERTY_LANG_NATIVE_VALUE"],
                "PROPERTY_LANG_FOREIGN_VALUE" => $arResume["PROPERTY_LANG_FOREIGN_VALUE"],
                "PROPERTY_RELOCATION_VALUE" => $arResume["PROPERTY_RELOCATION_ENUM_ID"],
                "PROPERTY_RELOCATION_SHOW_VALUE" => $arResume["PROPERTY_RELOCATION_VALUE"],
                "PROPERTY_HAVE_AUTO_VALUE" => $arResume["PROPERTY_HAVE_AUTO_ENUM_ID"],
                "PROPERTY_HAVE_AUTO_SHOW_VALUE" => $arResume["PROPERTY_HAVE_AUTO_VALUE"],
            );
            //$resumeData = $arResume;
            $dbProps = CIBlockElement::GetProperty(
                21,
                $arResume["ID"],
                array(),
                array(
                    "CODE" => "EMPLOYMENT"
                )
            );
            $resumeData["PROPERTY_EMPLOYMENT_VALUE"] = array();
            while ($arProps = $dbProps->Fetch()) {
                $resumeData["PROPERTY_EMPLOYMENT_VALUE"][] = $arProps["VALUE"];
                $resumeData["PROPERTY_EMPLOYMENT_SHOW_VALUE"][] = $arProps["VALUE_ENUM"];
            }
            $dbProps = CIBlockElement::GetProperty(
                21,
                $arResume["ID"],
                array(),
                array(
                    "CODE" => "SHEDULE"
                )
            );
            $resumeData["PROPERTY_SHEDULE_VALUE"] = array();
            while ($arProps = $dbProps->Fetch()) {
                $resumeData["PROPERTY_SHEDULE_VALUE"][] = $arProps["VALUE"];
                $resumeData["PROPERTY_SHEDULE_SHOW_VALUE"][] = $arProps["VALUE_ENUM"];
            }
            $dbProps = CIBlockElement::GetProperty(
                21,
                $arResume["ID"],
                array(),
                array(
                    "CODE" => "AUTO_CATEGORY"
                )
            );
            $resumeData["PROPERTY_AUTO_CATEGORY_VALUE"] = array();
            while ($arProps = $dbProps->Fetch()) {
                $resumeData["PROPERTY_AUTO_CATEGORY_VALUE"][] = $arProps["VALUE"];
                $resumeData["PROPERTY_AUTO_CATEGORY_SHOW_VALUE"][] = $arProps["VALUE_ENUM"];
            }
        }
        if ($resumeData["ID"]) {
            $resWork = CIBlockElement::GetList(
                array(),
                array(
                    "IBLOCK_ID" => 26,
                    "PROPERTY_RESUME" => $resumeData["ID"]
                ),
                false,
                false,
                array(
                    "PROPERTY_WORK_BEGIN",
                    "PROPERTY_WORK_END",
                    "PROPERTY_ORG",
                    "PROPERTY_WORK_POSITION",
                    "PROPERTY_WORK_DETAIL",
                    "PROPERTY_RESUME",
                )
            );
            $arWorks = array();
            while ($arWorkElem = $resWork->GetNext()) {
                $arWorks[] = $arWorkElem;
            }
            $resEdu = CIBlockElement::GetList(
                array(),
                array(
                    "IBLOCK_ID" => 27,
                    "PROPERTY_RESUME" => $resumeData["ID"]
                ),
                false,
                false,
                array(
                    "PROPERTY_EDU_INSTITUT",
                    "PROPERTY_EDU_FAKULTET",
                    "PROPERTY_EDU_SPEC",
                    "PROPERTY_EDU_END",
                )
            );
            $arEdu = array();
            while ($arEduElem = $resEdu->GetNext()) {
                $arEdu[] = $arEduElem;
            }
        }
        ?>
        <? endif; ?>

        <? if (!$resumeData["ID"] || $_REQUEST["edit"]): ?>
            <div class="b-personal-header">
                <h1>Новое резюме</h1>
                <ul class="b-personal-header__links">
                    <li><a href="#">Создать из шаблона</a></li>
                </ul>
            </div>

            <?
            if ($_REQUEST["accept"] || $_REQUEST["step"] == 3) {
                $step = 3;
            } elseif ($_REQUEST["step"] == 2) {
                $step = 2;
            } else {
                $step = 1;
            }
            ?>
            <div class="steps">
                <div class="steps__item<?= $step == 1 ? ' steps__item-active' : '' ?>" data-step="1">1 <span>Шаг 1</span></div>
                <div class="steps__item<?= $step == 2 ? ' steps__item-active' : '' ?>" data-step="2">2 <span>Шаг 2</span></div>
                <div class="steps__item<?= $step == 3 ? ' steps__item-active' : '' ?>" data-step="3">3 <span>Шаг 3</span></div>
            </div>
        <? elseif ($resumeData["ID"]): ?>

            <div class="summary__block">
                <div class="summary__block-top">
                    <div class="summary__block-photo">
                        <?
                        if ($resumeData["PREVIEW_PICTURE"]) {
                            $picture = CFile::GetFileArray($resumeData["PREVIEW_PICTURE"]);
                        } else {
                            $picture["SRC"] = SITE_TEMPLATE_PATH . '/assets/images/no_photo.png';
                        }
                        ?>
                        <img src="<?= $picture["SRC"] ?>" alt="">
                    </div>
                    <div class="summary__block-desc">
                        <div class="summary__block-head">
                            <div class="summary__block-name"><?= $resumeData["PROPERTY_FIRST_NAME_VALUE"] . ' ' . $resumeData["PROPERTY_LAST_NAME_VALUE"] ?></div>
                            <div class="summary__actions">
                                <div class="summary__actions-item"><a href="#"><i class="icon icon-remove"></i></a></div>
                                <div class="summary__actions-item"><a href="#"><i class="icon icon-print"></i></a></div>
                                <div class="summary__actions-item"><a href="#"><i class="icon icon-download-grey"></i></a></div>
                            </div>
                        </div>
                        <?
                        if ($resumeData["PROPERTY_GENDER_SHOW_VALUE"] == "Женский") {
                            $genderValue = 'Женщина';
                            $genderBornPhrase = 'родилась';
                        } else {
                            $genderValue = 'Мужчина';
                            $genderBornPhrase = 'родился';
                        }

                        ?>
                        <div class="summary__block-item"><?= $genderValue ?>, <?= SiteHelper::getHumanAge($resumeData["PROPERTY_B_DATE_VALUE"])?>, <?= $genderBornPhrase ?> <?= FormatDate("j F Y", MakeTimeStamp($resumeData["PROPERTY_B_DATE_VALUE"])) ?><br>
                            <?= $resumeData["PROPERTY_REGION_VALUE"] ?><?= $resumeData["PROPERTY_RELOCATION_VALUE"] == 2350 ? ', готова к переезду' : '' ?></div>
                        <div class="summary__block-item"><?= $resumeData["PROPERTY_PHONE_VALUE"] ?><br>
                            <?= $resumeData["PROPERTY_EMAIL_VALUE"] ?>
                        </div>
                        <div class="edit">
                            <a href="/personal/resume/?edit=Y&step=1">Редактировать</a>
                        </div>
                    </div>
                </div>

                <div class="summary__block-content">
                    <div class="summary__block-head">
                        <div class="summary__block-header"><?= $resumeData["PROPERTY_POSITION_VALUE"] ?></div>
                        <div class="edit">
                            <a href="/personal/resume/?edit=Y&step=2">Редактировать</a>
                        </div>
                    </div>
                    <div class="summary__block-item">
                        Занятость: <? foreach ($resumeData["PROPERTY_EMPLOYMENT_SHOW_VALUE"] as $key => $employmentItem):?>
                            <?= $key ? ', ' : '' ?><?= strtolower($employmentItem) ?>
                        <? endforeach; ?><br>
                        График работы: <? foreach ($resumeData["PROPERTY_SHEDULE_SHOW_VALUE"] as $key => $sheduleItem):?>
                            <?= $key ? ', ' : '' ?><?= strtolower($sheduleItem) ?>
                        <? endforeach; ?>
                    </div>
                    <?
                    $exp = array(
                        "months" => 0,
                        "years" => 0,
                    );
                    foreach ($arWorks as &$workItem) {
                        $begin = $workItem["PROPERTY_WORK_BEGIN_VALUE"];
                        if ($workItem["PROPERTY_WORK_END_VALUE"] == "По настоящее время") {
                            $end = date('d.m.Y');
                        } else {
                            $end = $workItem["PROPERTY_WORK_END_VALUE"];
                        }
                        $workItem["SUM_EXP"] = false;
                        $workItem["SUM_EXP"] = SiteHelper::getAgeDelta($begin, $end);
                        $exp = array(
                            "months" => $exp["months"] + $workItem["SUM_EXP"]["VALUE"]["months"],
                            "years"  => $exp["years"] + $workItem["SUM_EXP"]["VALUE"]["years"],
                        );
                    } ?>
                    <div class="summary__block-item">
                        <? while ($exp["months"] >= 12) {
                            $exp["months"] -= 12;
                            $exp["years"]++;
                        }
                        if ($exp["months"] > 0 || $exp["years"] > 0) {
                            $sumExp = SiteHelper::getMonthsAndYearsFormatted($exp["months"], $exp["years"]);
                        } else {
                            $sumExp = "Нет";
                        }
                        ?>
                        Опыт работы: <?= $sumExp ?>
                    </div>
                    <?
                    foreach ($arWorks as $workItemShow): ?>
                        <div class="summary__block-item">
                            <?
                            $begin = FormatDate("F Y", MakeTimeStamp($workItemShow["PROPERTY_WORK_BEGIN_VALUE"]));
                            if ($workItemShow["PROPERTY_WORK_END_VALUE"] == "По настоящее время") {
                                $end = "по настоящее время";
                            } else {
                                $end = FormatDate("F Y", MakeTimeStamp($workItemShow["PROPERTY_WORK_END_VALUE"]));
                            }
                            ?>
                            <?= $begin ?> — <?= $end ?><br>
                            <?= $workItemShow["SUM_EXP"]["VALUE_FORMATTED"] ?> <br>
                            <?= $workItemShow["PROPERTY_ORG_VALUE"] ?><br>
                            <?= $workItemShow["PROPERTY_WORK_POSITION_VALUE"] ?>
                        </div>
                        <div class="summary__block-item">
                            <?= $workItemShow["PROPERTY_WORK_DETAIL_VALUE"] ?>
                        </div>
                    <? endforeach; ?>
                    <br>
                </div>

                <? if (count($arEdu)): ?>
                    <div class="summary__block-content">
                        <div class="summary__block-head">
                            <div class="summary__block-header">Образование</div>
                            <div class="edit">
                                <a href="/personal/resume/?edit=Y&step=3">Редактировать</a>
                            </div>
                        </div>
                        <div class="summary__block-item">
                            <?= $resumeData["PROPERTY_EDUC_LEVEL_SHOW_VALUE"] ?><br>
                        </div>
                        <? foreach ($arEdu as $eduItem): ?>
                        <div class="summary__block-item">
                            <? if ($eduItem["PROPERTY_EDU_INSTITUT_VALUE"]): ?>
                                <?= $eduItem["PROPERTY_EDU_INSTITUT_VALUE"] ?><br>
                            <? endif; ?>
                            <? if ($eduItem["PROPERTY_EDU_FAKULTET_VALUE"]): ?>
                                Факультет: <?= $eduItem["PROPERTY_EDU_FAKULTET_VALUE"] ?><br>
                            <? endif; ?>
                            <? if ($eduItem["PROPERTY_EDU_SPEC_VALUE"]): ?>
                                Специальность: <?= $eduItem["PROPERTY_EDU_SPEC_VALUE"] ?><br>
                            <? endif; ?>
                            <? if ($eduItem["PROPERTY_EDU_END_VALUE"]): ?>
                                Год окончания: <?= $eduItem["PROPERTY_EDU_END_VALUE"] ?>
                            <? endif; ?>
                        </div>
                        <? endforeach; ?>
                    </div>
                <? endif; ?>

                <? if ($resumeData["PROPERTY_LANG_NATIVE_VALUE"] || $resumeData["PROPERTY_LANG_FOREIGN_VALUE"]): ?>
                <div class="summary__block-content">
                    <div class="summary__block-head">
                        <div class="summary__block-header">Знание языков</div>
                        <div class="edit">
                            <a href="/personal/resume/?edit=Y&step=3">Редактировать</a>
                        </div>
                    </div>
                    <div class="summary__block-item">
                        <? if ($resumeData["PROPERTY_LANG_NATIVE_VALUE"]): ?>
                            <?= $resumeData["PROPERTY_LANG_NATIVE_VALUE"] ?> — Родной <br>
                        <? endif; ?>
                        <? if ($resumeData["PROPERTY_LANG_FOREIGN_VALUE"]): ?>
                            <?= $resumeData["PROPERTY_LANG_FOREIGN_VALUE"] ?>
                        <? endif; ?>
                    </div>
                </div>
                <? endif; ?>

                <div class="summary__block-content">
                    <div class="summary__block-head">
                        <div class="summary__block-header">Гражданство</div>
                        <div class="edit">
                            <a href="/personal/resume/?edit=Y&step=1">Редактировать</a>
                        </div>
                    </div>
                    <div class="summary__block-item">
                        Гражданство: <?= $resumeData["PROPERTY_NATIONALITY_SHOW_VALUE"] ?>
                    </div>
                </div>

                <div class="form-bottom">
                    <a href="#" class="btn btn--red">Сохранить</a>
                    <a href="#" class="btn btn--blue">Опубликовать</a>
                </div>

            </div>
        <? endif; ?>

        <? if (!$_REQUEST["accept"] && !$resumeData["ID"]): ?>
        <div class="summary__desc">
            <p>Контакты, которые вы указываете при создании резюме, работодатель будет использовать для связи с
                вами. Также вы будете получать информацию о приглашениях на вакансии.</p>
        </div>
        <? endif; ?>
        <?
        $el = new CIBlockElement;
        $userName = $arUser["NAME"];
        if ($arUser["LAST_NAME"]) {
            $userName .= ' ' . $arUser["LAST_NAME"];
        }
        if ($_REQUEST["B_DATE_DATE"] && $_REQUEST["B_DATE_MONTH"] && $_REQUEST["B_DATE_YEAR"]) {
            $bDate = $_REQUEST["B_DATE_DATE"] . '.' . SiteHelper::getMonthNumberByName($_REQUEST["B_DATE_MONTH"]) . '.' . $_REQUEST["B_DATE_YEAR"];
        } else {
            $bDate = false;
        }
        if ($_REQUEST["accept"] == "Y") {
            $propFields = array(
                "FIRST_NAME" => $_REQUEST["FIRST_NAME"] ? $_REQUEST["FIRST_NAME"] : "",
                "LAST_NAME" => $_REQUEST["LAST_NAME"] ? $_REQUEST["LAST_NAME"] : "",
                "PHONE" => $_REQUEST["PHONE"] ? $_REQUEST["PHONE"] : "",
                "EMAIL" => $_REQUEST["EMAIL"] ? $_REQUEST["EMAIL"] : "",
                "B_DATE" => $bDate,
                "GENDER" => $_REQUEST["GENDER"] ? $_REQUEST["GENDER"] : "",
                "NATIONALITY" => $_REQUEST["NATIONALITY"] ? $_REQUEST["NATIONALITY"] : "",
                "WORK_ACCESS" => $_REQUEST["WORK_ACCESS"] ? $_REQUEST["WORK_ACCESS"] : "",
                "REGION" => $_REQUEST["REGION"] ? $_REQUEST["REGION"] : "",
                "RESUME_TYPE" => $_REQUEST["RESUME_TYPE"] ? $_REQUEST["RESUME_TYPE"] : "",
                "RESUME_SHOW" => $_REQUEST["RESUME_SHOW"] ? $_REQUEST["RESUME_SHOW"] : "",
                "EXP" => $_REQUEST["EXP"] ? $_REQUEST["EXP"] : "",
                "POSITION" => $_REQUEST["POSITION"] ? $_REQUEST["POSITION"] : "",
                "PAY" => $_REQUEST["PAY"] ? $_REQUEST["PAY"] : "",
                "PROF_AREA" => $_REQUEST["PROF_AREA"] ? $_REQUEST["PROF_AREA"] : "",
                "EDUC_LEVEL" => $_REQUEST["EDUC_LEVEL"] ? $_REQUEST["EDUC_LEVEL"] : "",
                "LANG_NATIVE" => $_REQUEST["LANG_NATIVE"] ? $_REQUEST["LANG_NATIVE"] : "",
                "LANG_FOREIGN" => $_REQUEST["LANG_FOREIGN"] ? $_REQUEST["LANG_FOREIGN"] : "",
                "RELOCATION" => $_REQUEST["RELOCATION"] ? $_REQUEST["RELOCATION"] : "",
                "EMPLOYMENT" => $_REQUEST["EMPLOYMENT"] ? $_REQUEST["EMPLOYMENT"] : "",
                "SHEDULE" => $_REQUEST["SHEDULE"] ? $_REQUEST["SHEDULE"] : "",
                "HAVE_AUTO" => $_REQUEST["EDUC_LEVEL"] ? $_REQUEST["HAVE_AUTO"] : "",
                "AUTO_CATEGORY" => $_REQUEST["EDUC_LEVEL"] ? $_REQUEST["AUTO_CATEGORY"] : "",
                "USER" => $_REQUEST["USER"] ? $_REQUEST["USER"] : "",
            );
            $arFields = array(
                "NAME" => "Резюме от " . $userName . " (" . date('d.m.Y') . ")",
                "PROPERTY_VALUES" => $propFields,
                "IBLOCK_ID" => 21,
            );
            if ($_FILES["PREVIEW_PICTURE"]) {
                $arFields["PREVIEW_PICTURE"] = $_FILES["PREVIEW_PICTURE"];
            }
            if ($_REQUEST["PREVIEW_TEXT"]) {
                $arFields["PREVIEW_TEXT"] = htmlspecialcharsbx($_REQUEST["PREVIEW_TEXT"]);
            }
            $productID = $el->Add($arFields);
            if ($productID) {
                if ($_REQUEST["WORK_COUNT"]) {
                    $workRequestItems = array();
                    for ($i = 1; $i <= $_REQUEST["WORK_COUNT"]; $i++) {
                        $beginWorkDate = $endWorkDate = '';
                        $beginWorkDate = $_REQUEST["WORK_BEGIN_DATE_" . $i] . '.' . SiteHelper::getMonthNumberByName($_REQUEST["WORK_BEGIN_MONTH_" . $i]) . '.' . $_REQUEST["WORK_BEGIN_YEAR_" . $i];
                        $endWorkDate = $_REQUEST["WORK_END_DATE_" . $i] . '.' . SiteHelper::getMonthNumberByName($_REQUEST["WORK_END_MONTH_" . $i]) . '.' . $_REQUEST["WORK_END_YEAR_" . $i];
                        $workProps = array(
                            "WORK_BEGIN" => $beginWorkDate,
                            "WORK_END" => !$_REQUEST["WORK_END_CURRENT_" . $i] ? $endWorkDate : "По настоящее время",
                            "ORG" => htmlspecialcharsbx($_REQUEST["ORG_" . $i]),
                            "WORK_POSITION" => htmlspecialcharsbx($_REQUEST["WORK_POSITION_" . $i]),
                            "WORK_DETAIL" => htmlspecialcharsbx($_REQUEST["WORK_DETAIL_" . $i]),
                            "RESUME" => $productID
                        );
                        if ($_REQUEST["WORK_POSITION_" . $i]) {
                            $arWorkFields = array(
                                "NAME" => $userName . " - Резюме №" . $productID,
                                "PROPERTY_VALUES" => $workProps
                            );
                            if (!$_REQUEST["WORK_ID_" . $i]) {
                                $arWorkFields["IBLOCK_ID"] = 26;
                                $workID = $el->Add($arWorkFields);
                            } else {
                                $resWork = $el->Update(intval($_REQUEST["WORK_ID_" . $i]), $arWorkFields);
                            }
                        }
                    }
                }
                if ($_REQUEST["EDU_COUNT"]) {
                    $eduRequestItems = array();
                    for ($i = 1; $i <= $_REQUEST["EDU_COUNT"]; $i++) {
                        $eduProps = array(
                            "EDU_INSTITUT" => htmlspecialcharsbx($_REQUEST["EDU_INSTITUT_" . $i]),
                            "EDU_FAKULTET" => htmlspecialcharsbx($_REQUEST["EDU_FAKULTET_" . $i]),
                            "EDU_SPEC" => htmlspecialcharsbx($_REQUEST["EDU_SPEC_" . $i]),
                            "EDU_END" => $_REQUEST["EDU_END_CURRENT_" . $i] ? htmlspecialcharsbx($_REQUEST["EDU_END_CURRENT_" . $i]) : htmlspecialcharsbx($_REQUEST["EDU_END_" . $i]),
                            "RESUME" => $productID
                        );
                        $arEduFields = array(
                            "NAME" => $userName . " - Резюме №" . $productID,
                            "PROPERTY_VALUES" => $eduProps
                        );
                        if ($_REQUEST["EDU_INSTITUT_" . $i] && $_REQUEST["EDU_END_" . $i]) {
                            if (!$_REQUEST["EDU_ID_" . $i]) {
                                $arEduFields["IBLOCK_ID"] = 27;
                                $eduID = $el->Add($arEduFields);
                            } else {
                                $resWork = $el->Update(intval($_REQUEST["EDU_ID_" . $i]), $arEduFields);
                            }
                        }
                    }
                }
            }
        }
        ?>
        <? if ($_REQUEST["accept"]): ?>
            <div class="alert alert-success">
                Спасибо!<br>
                Ваше резюме будет опубликовано после проверки.
            </div>
        <? elseif ($_REQUEST["edit"] || !$resumeData["ID"]): ?>
            <div class="vertical-form">
                <form action="/personal/resume/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="USER" value="<?= $arUser["ID"] ?>" />
                    <input type="hidden" name="accept" value="Y" />
                    <? if ($resumeData["ID"]): ?>
                        <input type="hidden" name="resume" value="<?= $resumeData["ID"] ?>" />
                    <? endif; ?>

                    <div class="step-item step-item-1"<?= $_REQUEST["step"] && $_REQUEST["step"] != 1 ? ' style="display: none;"' : '' ?>>
                        <div class="form-groups">
                            <div class="form-group">
                                <label for="i1">Имя</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i1" value="<?= $resumeData["PROPERTY_FIRST_NAME_VALUE"] ? $resumeData["PROPERTY_FIRST_NAME_VALUE"] : 'Михаил' ?>" name="FIRST_NAME">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i2" class="required">Фамилия</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i2" value="<?= $resumeData["PROPERTY_LAST_NAME_VALUE"] ? $resumeData["PROPERTY_LAST_NAME_VALUE"] : 'Иванов' ?>" name="LAST_NAME" data-req="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i3" class="required">Моб. телефон</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i3" value="<?= $resumeData["PROPERTY_PHONE_VALUE"] ? $resumeData["PROPERTY_PHONE_VALUE"] : '+ 7 955 555 55 55' ?>" name="PHONE" data-req="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i4" class="required">E-mail</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i4" value="<?= $resumeData["PROPERTY_EMAIL_VALUE"] ? $resumeData["PROPERTY_EMAIL_VALUE"] : 'mihail@ya.ru' ?>" name="EMAIL" data-req="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i5" class="required">Дата рождения</label>
                                <? if ($resumeData["PROPERTY_B_DATE_VALUE"]) {
                                    $date = strtotime($resumeData["PROPERTY_B_DATE_VALUE"]);
                                    $bDate = date('d', $date);
                                    $bMonth = SiteHelper::getMonthByNumber(date('m', $date));
                                    $bYear= date('Y', $date);
                                } ?>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <div class="col-2">
                                            <select class="form-control" id="i5" name="B_DATE_DATE" data-req="1">
                                                <option value=""<?= $bDate ? '' : ' selected' ?>>Дата</option>
                                                <? for ($i = 1; $i <= 31; $i++): ?>
                                                    <option value="<?= $i ?>"<?= $bDate && $bDate == $i ? ' selected' : '' ?>><?= $i ?></option>
                                                <? endfor; ?>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <select class="form-control" name="B_DATE_MONTH" data-req="1">
                                                <? $arMonths = SiteHelper::getMonthList(); ?>
                                                <option value="" selected>Месяц</option>
                                                <? foreach ($arMonths as $month): ?>
                                                    <option value="<?= $month ?>"<?= $bMonth && $bMonth == $month ? ' selected' : '' ?>><?= $month ?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <select class="form-control" name="B_DATE_YEAR" data-req="1">
                                                <option value="" selected>Год</option>
                                                <? for ($i = 1945; $i <= date('Y'); $i++): ?>
                                                    <option value="<?= $i ?>"<?= $bYear && $bYear == $i ? ' selected' : '' ?>><?= $i ?></option>
                                                <? endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i6" class="required">Пол</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <?
                                        $counter = 0;
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "GENDER"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_GENDER_VALUE"]) {
                                                if ($resumeData["PROPERTY_GENDER_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <div class="form-group-mini col-2">
                                                <input type="radio" class="styled" id="i6-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="GENDER"<?= $checked ? ' checked' : '' ?>>
                                                <label for="i6-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                            </div>
                                            <?
                                            $counter++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group align-top">
                                <label for="i7" class="required">Гражданство</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <?
                                        $counter = 0;
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "NATIONALITY"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_NATIONALITY_VALUE"]) {
                                                if ($resumeData["PROPERTY_NATIONALITY_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <div class="form-group-mini col-2">
                                                <input type="radio" class="styled" id="i7-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="NATIONALITY"<?= $checked ? ' checked' : '' ?>>
                                                <label for="i7-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                            </div>
                                            <?
                                            $counter++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i8" class="required">Разрешение на работу</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i8" value="<?= $resumeData["PROPERTY_WORK_ACCESS_VALUE"] ? $resumeData["PROPERTY_WORK_ACCESS_VALUE"] : 'России' ?>" name="WORK_ACCESS" data-req="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i9" class="required">Регион проживания</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i9" value="<?= $resumeData["PROPERTY_REGION_VALUE"] ? $resumeData["PROPERTY_REGION_VALUE"] : 'Татарстан' ?>" name="REGION" data-req="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i10" class="required">Резюме</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <?
                                        $counter = 0;
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "RESUME_TYPE"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_RESUME_TYPE_VALUE"]) {
                                                if ($resumeData["PROPERTY_RESUME_TYPE_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <div class="form-group-mini col-2">
                                                <input type="radio" class="styled" id="i10-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="RESUME_TYPE"<?= $checked ? ' checked' : '' ?>>
                                                <label for="i10-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                            </div>
                                            <?
                                            $counter++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p><strong>Показывать в резюме</strong></p>
                        <div class="form-groups">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="flex-row">
                                        <?
                                        $counter = 0;
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "RESUME_SHOW"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_RESUME_SHOW_VALUE"]) {
                                                if ($resumeData["PROPERTY_RESUME_SHOW_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <div class="form-group-mini col-2">
                                                <input type="radio" class="styled" id="i11-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="RESUME_SHOW"<?= $checked ? ' checked' : '' ?>>
                                                <label for="i11-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                            </div>
                                            <?
                                            $counter++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="styled" type="file" id="i12" accept="image/*" data-label="Загрузить фото профиля" name="PREVIEW_PICTURE">
                                </div>
                            </div>
                        </div>
                        <div class="form-bottom align-right">
                            <input type="submit" class="btn btn--blue accept-step-btn" data-step="2" value="Продолжить">
                        </div>
                    </div>

                    <div class="step-item step-item-2"<?= $_REQUEST["step"] != 2 ? ' style="display: none;"' : '' ?>>
                        <div class="summary__desc">
                            <h2>Желаемая работа</h2>
                            <p>Укажите, на какой должности вы хотите работать. Если вы готовы работать на разных должностях создайте для каждой из них отдельное резюме.</p>
                        </div>
                        <div class="form-groups">
                            <div class="form-group">
                                <label for="i13" class="required">Опыт работы</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <?
                                        $counter = 0;
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "EXP"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_EXP_VALUE"]) {
                                                if ($resumeData["PROPERTY_EXP_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <div class="form-group-mini col-2">
                                                <input type="radio" class="styled" id="i13-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="EXP"<?= $checked ? ' checked' : '' ?>>
                                                <label for="i13-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                            </div>
                                            <?
                                            $counter++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i14">Желаемая должность</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i14" value="<?= $resumeData["PROPERTY_POSITION_VALUE"] ? $resumeData["PROPERTY_POSITION_VALUE"] : '' ?>" name="POSITION">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i15" class="required">Зарплата</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <div class="col-4">
                                            <input class="form-control" type="text" id="i15" value="<?= $resumeData["PROPERTY_PAY_VALUE"] ? $resumeData["PROPERTY_PAY_VALUE"] : '' ?>" name="PAY" data-req="1">
                                        </div>
                                        <div class="col-2 align-middle">На руки</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="i16">Проф. область</label>
                                <div class="input-group">
                                    <select class="form-control" id="i16">
                                        <option value=""<?= !$resumeData["PROPERTY_PROF_AREA_VALUE"] ? ' selected' : '' ?>>Выбрать профессиональную область</option>
                                        <?
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "PROF_AREA"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_PROF_AREA_VALUE"]) {
                                                if ($resumeData["PROPERTY_PROF_AREA_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <option value="<?= $enumFields["ID"] ?>"<?= $checked ? ' selected' : '' ?>><?= $enumFields["VALUE"] ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="summary__desc">
                            <h2>Опыт работы</h2>
                            <p>Чем лучше и подробнее вы опишете свой опыт работы, тем больше шансов, что
                                работодатель обратит внимание на ваше резюме. Перечислите конкретные задачи,
                                которые вы выполняете, сделайте акцент на тех обязанностях, которые будут полезны
                                в желаемой работе. Если вы откликаетесь на вакансию, рекомендуем внимательно
                                изучить требования и учесть их при заполнении резюме.</p>
                        </div>
                        <?
                        $counter = 1;
                        if (count($arWorks)): ?>
                            <?
                            foreach ($arWorks as $workItem):
                                if ($workItem["PROPERTY_WORK_BEGIN_VALUE"]) {
                                    $date = strtotime($workItem["PROPERTY_WORK_BEGIN_VALUE"]);
                                    $workItem["WORK_BEGIN_DATE"] = date('d', $date);
                                    $workItem["WORK_BEGIN_MONTH"] = SiteHelper::getMonthByNumber(date('m', $date));
                                    $workItem["WORK_BEGIN_YEAR"] = date('Y', $date);
                                }
                                if ($workItem["PROPERTY_WORK_END_VALUE"] && $workItem["PROPERTY_WORK_END_VALUE"] != "По настоящее время") {
                                    $date = strtotime($workItem["PROPERTY_WORK_END_VALUE"]);
                                    $workItem["WORK_END_DATE"] = date('d', $date);
                                    $workItem["WORK_END_MONTH"] = SiteHelper::getMonthByNumber(date('m', $date));
                                    $workItem["WORK_END_YEAR"] = date('Y', $date);
                                }
                                ?>
                                <div class="form-groups">
                                    <input type="hidden" name="WORK_ID_<?= $counter ?>" value="<?= $workItem["ID"] ?>">
                                    <div class="form-group">
                                        <label for="i17_<?= $counter ?>">Начало работы</label>
                                        <div class="input-group">
                                            <div class="flex-row">
                                                <div class="col-2">
                                                    <select class="form-control" id="i17_<?= $counter ?>" name="WORK_BEGIN_DATE_<?= $counter ?>">
                                                        <option value=""<?= !$workItem["WORK_BEGIN_DATE"] ? ' selected' : '' ?>>Дата</option>
                                                        <? for ($i = 1; $i <= 31; $i++): ?>
                                                            <option value="<?= $i ?>"<?= $i == $workItem["WORK_BEGIN_DATE"] ? ' selected' : '' ?>><?= $i ?></option>
                                                        <? endfor; ?>
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control" name="WORK_BEGIN_MONTH_<?= $counter ?>">
                                                        <? $arMonths = SiteHelper::getMonthList(); ?>
                                                        <option value=""<?= !$workItem["WORK_BEGIN_MONTH"] ? ' selected' : '' ?>>Месяц</option>
                                                        <? foreach ($arMonths as $month): ?>
                                                            <option value="<?= $month ?>"<?= $month == $workItem["WORK_BEGIN_MONTH"] ? ' selected' : '' ?>><?= $month ?></option>
                                                        <? endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control" name="WORK_BEGIN_YEAR_<?= $counter ?>">
                                                        <option value=""<?= !$workItem["WORK_BEGIN_YEAR"] ? ' selected' : '' ?>>Год</option>
                                                        <? for ($i = 1945; $i <= date('Y'); $i++): ?>
                                                            <option value="<?= $i ?>"<?= $i == $workItem["WORK_BEGIN_YEAR"] ? ' selected' : '' ?>><?= $i ?></option>
                                                        <? endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group-append">
                                            <div class="form-group-mini">
                                                <input type="checkbox" class="styled end-data-checkbox" id="i18_<?= $counter ?>" value="По настоящее время" name="WORK_END_CURRENT_<?= $counter ?>"<?= $workItem["PROPERTY_WORK_END_VALUE"] == 'По настоящее время' ? ' checked' : '' ?>>
                                                <label for="i18_<?= $counter ?>">По настоящее время</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group end-data-container">
                                        <label for="i9_<?= $counter ?>">Дата окончания</label>
                                        <div class="input-group">
                                            <div class="flex-row">
                                                <div class="col-2">
                                                    <select class="form-control" id="i19_<?= $counter ?>" name="WORK_END_DATE_<?= $counter ?>">
                                                        <option value=""<?= !$workItem["WORK_END_DATE"] ? ' selected' : '' ?>>Дата</option>
                                                        <? for ($i = 1; $i <= 31; $i++): ?>
                                                            <option value="<?= $i ?>"<?= $i == $workItem["WORK_END_DATE"] ? ' selected' : '' ?>><?= $i ?></option>
                                                        <? endfor; ?>
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control" name="WORK_END_MONTH_<?= $counter ?>">
                                                        <? $arMonths = SiteHelper::getMonthList(); ?>
                                                        <option value=""<?= !$workItem["WORK_END_MONTH"] ? ' selected' : '' ?>>Месяц</option>
                                                        <? foreach ($arMonths as $month): ?>
                                                            <option value="<?= $month ?>"<?= $month == $workItem["WORK_END_MONTH"] ? ' selected' : '' ?>><?= $month ?></option>
                                                        <? endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <select class="form-control" name="WORK_END_YEAR_<?= $counter ?>">
                                                        <option value=""<?= !$workItem["WORK_END_YEAR"] ? ' selected' : '' ?>>Год</option>
                                                        <? for ($i = 1945; $i <= date('Y'); $i++): ?>
                                                            <option value="<?= $i ?>"<?= $i == $workItem["WORK_END_YEAR"] ? ' selected' : '' ?>><?= $i ?></option>
                                                        <? endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="i20_<?= $counter ?>">Организация</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="i20_<?= $counter ?>" value="<?= $workItem["PROPERTY_ORG_VALUE"] ?>" name="ORG_<?= $counter ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="i21_<?= $counter ?>">Должность</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="i21_<?= $counter ?>" value="<?= $workItem["PROPERTY_WORK_POSITION_VALUE"] ?>" name="WORK_POSITION_<?= $counter ?>">
                                        </div>
                                    </div>
                                    <p><strong>Обязанности, функции, достижения</strong></p>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <textarea class="form-control" type="text" name="WORK_DETAIL_<?= $counter ?>"><?= $workItem["PROPERTY_WORK_DETAIL_VALUE"] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <? $counter++; ?>
                            <? endforeach; ?>
                        <? else: ?>
                            <div class="form-groups">
                                <div class="form-group">
                                    <label for="i17_1">Начало работы</label>
                                    <div class="input-group">
                                        <div class="flex-row">
                                            <div class="col-2">
                                                <select class="form-control" id="i17_1" name="WORK_BEGIN_DATE_1">
                                                    <option value="" selected>Дата</option>
                                                    <? for ($i = 1; $i <= 31; $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <? endfor; ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <select class="form-control" name="WORK_BEGIN_MONTH_1">
                                                    <? $arMonths = SiteHelper::getMonthList(); ?>
                                                    <option value="" selected>Месяц</option>
                                                    <? foreach ($arMonths as $month): ?>
                                                        <option value="<?= $month ?>"><?= $month ?></option>
                                                    <? endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <select class="form-control" name="WORK_BEGIN_YEAR_1">
                                                    <option value="" selected>Год</option>
                                                    <? for ($i = 1945; $i <= date('Y'); $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <? endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="form-group-mini">
                                            <input type="checkbox" class="styled" id="i18_1" value="before" name="WORK_BEGIN_CURRENT_1">
                                            <label for="i18_1">По настоящее время</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i19_1">Дата окончания</label>
                                    <div class="input-group">
                                        <div class="flex-row">
                                            <div class="col-2">
                                                <select class="form-control" id="i19_1" name="WORK_END_DATE_1">
                                                    <option value="" selected>Дата</option>
                                                    <? for ($i = 1; $i <= 31; $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <? endfor; ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <select class="form-control" name="WORK_END_MONTH_1">
                                                    <? $arMonths = SiteHelper::getMonthList(); ?>
                                                    <option value="" selected>Месяц</option>
                                                    <? foreach ($arMonths as $month): ?>
                                                        <option value="<?= $month ?>"><?= $month ?></option>
                                                    <? endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <select class="form-control" name="WORK_END_YEAR_1">
                                                    <option value="" selected>Год</option>
                                                    <? for ($i = 1945; $i <= date('Y'); $i++): ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <? endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="i20_1">Организация</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i20_1" value="" name="ORG_1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i21_1">Должность</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i21_1" value="" name="WORK_POSITION_1">
                                    </div>
                                </div>
                                <p><strong>Обязанности, функции, достижения</strong></p>
                                <div class="form-group">
                                    <div class="input-group">
                                        <textarea class="form-control" type="text" name="WORK_DETAIL_1"></textarea>
                                    </div>
                                </div>
                            </div>
                        <? endif;
                        $counter++;
                        ?>
                        <div class="add-work-container"></div>
                        <div class="add-link"><a href="#" class="add-work-position" data-counter="<?= $counter ?>">+ Добавить место работы</a></div>
                        <input type="hidden" name="WORK_COUNT" value="<?= $counter ?>" >
                        <?
                        //TODO:: изменять количество работ при выборе опыта работы
                        ?>
                        <div class="form-bottom">
                            <input type="submit" class="btn btn--red step-back-btn" data-step="1" value="Назад">
                            <input type="submit" class="btn btn--blue accept-step-btn" data-step="3" value="Продолжить">
                        </div>
                    </div>

                    <div class="step-item step-item-3"<?= $_REQUEST["step"] != 2 ? ' style="display: none;"' : '' ?>>
                        <div class="form-groups">
                            <p><strong>Обо мне</strong></p>
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea class="form-control" type="text" name="PREVIEW_TEXT"><?= $resumeData["PREVIEW_TEXT"] ?></textarea>
                                    <p class="nb">Расскажите дополнительную информацию, которая поможет работодателю лучше
                                        узнать вас. Поле необязательно для заполнения.</p>
                                </div>
                            </div>
                        </div>
                        <h2>Образование</h2>
                        <div class="form-groups">
                            <div class="form-group align-top">
                                <label for="i22">Уровень</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <?
                                        $counter = 0;
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "EDUC_LEVEL"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_EDUC_LEVEL_VALUE"]) {
                                                if ($resumeData["PROPERTY_EDUC_LEVEL_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <div class="form-group-mini">
                                                <input type="radio" class="styled" id="i22-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="EDUC_LEVEL"<?= $checked ? ' checked' : '' ?>>
                                                <label for="i22-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                            </div>
                                            <?
                                            $counter++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?
                            $counter = 0;
                            if (count($arEdu)): ?>
                                <? foreach ($arEdu as $arEduItem): ?>
                                    <? $counter++; ?>
                                    <input type="hidden" name="EDU_ID_<?= $counter ?>" value="<?= $arEdu["ID"] ?>" />
                                    <div class="form-group">
                                        <label for="i23-<?= $counter ?>">Учебное заведение</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="i23-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_INSTITUT_VALUE"] ?>" name="EDU_INSTITUT_<?= $counter ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="i24-<?= $counter ?>">Факультет</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="i24-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_FAKULTET_VALUE"] ?>" name="EDU_FAKULTET_<?= $counter ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="i25-<?= $counter ?>">Специализация</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="i25-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_SPEC_VALUE"] ?>" name="EDU_SPEC_<?= $counter ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="i26-<?= $counter ?>">Год окончания</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" id="i26-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_END_VALUE"] != "По настоящее время" ? $arEduItem["PROPERTY_EDU_END_VALUE"] : '' ?>" name="EDU_END_<?= $counter ?>">
                                        </div>
                                        <div class="input-group-append">
                                            <div class="form-group-mini">
                                                <input type="checkbox" class="styled" id="i27-<?= $counter ?>" value="По настоящее время" name="EDU_END_CURRENT_<?= $counter ?>"<?= $arEduItem["PROPERTY_EDU_END_VALUE"] == "По настоящее время" ? ' checked' : '' ?>>
                                                <label for="i27-<?= $counter ?>">По настоящее время</label>
                                            </div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            <? else: ?>
                                <? $counter++; ?>
                                <div class="form-group">
                                    <label for="i23-<?= $counter ?>">Учебное заведение</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i23-<?= $counter ?>" value="" name="EDU_INSTITUT_1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i24-<?= $counter ?>">Факультет</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i24-<?= $counter ?>" value="" name="EDU_FAKULTET_1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i25-<?= $counter ?>">Специализация</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i25-<?= $counter ?>" value="" name="EDU_SPEC_1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i26-<?= $counter ?>">Год окончания</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i26-<?= $counter ?>" value="" name="EDU_END_1">
                                    </div>
                                    <div class="input-group-append">
                                        <div class="form-group-mini">
                                            <input type="checkbox" class="styled" id="i27-<?= $counter ?>" value="По настоящее время" name="EDU_END_CURRENT_1">
                                            <label for="i27-<?= $counter ?>">По настоящее время</label>
                                        </div>
                                    </div>
                                </div>
                            <? endif; ?>
                            <div class="add-edu-container"></div>
                            <div class="add-link"><a href="#" class="edu-add" data-counter="<?= $counter ?>">+ Добавить место обучения</a></div>
                            <input type="hidden" name="EDU_COUNT" value="<?= $counter ?>">

                        </div>

                        <h2>Владение языками</h2>
                        <div class="form-groups">
                            <div class="form-group">
                                <label for="i28">Родной язык</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i28" value="<?= $resumeData["PROPERTY_LANG_NATIVE_VALUE"] ?>" name="LANG_NATIVE">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i29">Иностранные языки</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i29" value="<?= $resumeData["PROPERTY_LANG_FOREIGN_VALUE"] ?>" name="LANG_FOREIGN">
                                </div>
                            </div>
                        </div>

                        <h2>Дополнительно</h2>
                        <div class="form-groups">
                            <div class="form-group align-top">
                                <label for="i30">Переезд</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <?
                                        $counter = 0;
                                        $propertyEnums = CIBlockPropertyEnum::GetList(
                                            array(
                                                "SORT" => "ASC"
                                            ),
                                            array(
                                                "IBLOCK_ID" => 21,
                                                "CODE" => "RELOCATION"
                                            )
                                        );
                                        while($enumFields = $propertyEnums->GetNext()) {
                                            $checked = false;
                                            if ($resumeData["PROPERTY_RELOCATION_VALUE"]) {
                                                if ($resumeData["PROPERTY_RELOCATION_VALUE"] == $enumFields["ID"]) {
                                                    $checked = true;
                                                }
                                            } else {
                                                if (!$counter) {
                                                    $checked = true;
                                                }
                                            }
                                            ?>
                                            <div class="form-group-mini">
                                                <input type="radio" class="styled" id="i30-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="RELOCATION"<?= $checked ? ' checked' : '' ?>>
                                                <label for="i30-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                            </div>
                                            <?
                                            $counter++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <p><strong>Занятость</strong></p>
                            <div class="form-group">
                                <?
                                $counter = 0;
                                $propertyEnums = CIBlockPropertyEnum::GetList(
                                    array(
                                        "SORT" => "ASC"
                                    ),
                                    array(
                                        "IBLOCK_ID" => 21,
                                        "CODE" => "EMPLOYMENT"
                                    )
                                );
                                while($enumFields = $propertyEnums->GetNext()) {
                                    $checked = false;
                                    if ($resumeData["PROPERTY_EMPLOYMENT_VALUE"]) {
                                        if (in_array($enumFields["ID"], $resumeData["PROPERTY_EMPLOYMENT_VALUE"])) {
                                            $checked = true;
                                        }
                                    } else {
                                        if (!$counter) {
                                            $checked = true;
                                        }
                                    }
                                    ?>
                                    <div class="form-group-mini">
                                        <input type="checkbox" class="styled" id="i31-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="EMPLOYMENT[]"<?= $checked ? ' checked' : '' ?>>
                                        <label for="i31-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                    </div>
                                    <?
                                    $counter++;
                                }
                                ?>
                            </div>
                            <p><strong>График работы</strong></p>
                            <div class="form-group">
                                <?
                                $counter = 0;
                                $propertyEnums = CIBlockPropertyEnum::GetList(
                                    array(
                                        "SORT" => "ASC"
                                    ),
                                    array(
                                        "IBLOCK_ID" => 21,
                                        "CODE" => "SHEDULE"
                                    )
                                );
                                while($enumFields = $propertyEnums->GetNext()) {
                                    $checked = false;
                                    if ($resumeData["PROPERTY_SHEDULE_VALUE"]) {
                                        if (in_array($enumFields["ID"], $resumeData["PROPERTY_SHEDULE_VALUE"])) {
                                            $checked = true;
                                        }
                                    } else {
                                        if (!$counter) {
                                            $checked = true;
                                        }
                                    }
                                    ?>
                                    <div class="form-group-mini">
                                        <input type="checkbox" class="styled" id="i32-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="SHEDULE[]"<?= $checked ? ' checked' : '' ?>>
                                        <label for="i32-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                    </div>
                                    <?
                                    $counter++;
                                }
                                ?>
                            </div>
                            <p><strong>Наличие личного автомобиля</strong></p>
                            <div class="form-group">
                                <?
                                $counter = 0;
                                $propertyEnums = CIBlockPropertyEnum::GetList(
                                    array(
                                        "SORT" => "ASC"
                                    ),
                                    array(
                                        "IBLOCK_ID" => 21,
                                        "CODE" => "HAVE_AUTO"
                                    )
                                );
                                while($enumFields = $propertyEnums->GetNext()) {
                                    $checked = false;
                                    if ($resumeData["PROPERTY_HAVE_AUTO_VALUE"]) {
                                        if ($resumeData["PROPERTY_HAVE_AUTO_VALUE"] == $enumFields["ID"]) {
                                            $checked = true;
                                        }
                                    } else {
                                        if (!$counter) {
                                            $checked = true;
                                        }
                                    }
                                    ?>
                                    <div class="form-group-mini">
                                        <input type="radio" class="styled" id="i33-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="HAVE_AUTO"<?= $checked ? ' checked' : '' ?>>
                                        <label for="i33-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                    </div>
                                    <?
                                    $counter++;
                                }
                                ?>
                            </div>

                            <p><strong>Категория водительских прав</strong></p>
                            <div class="form-groups">
                                <div class="form-group">
                                    <?
                                    $counter = 0;
                                    $propertyEnums = CIBlockPropertyEnum::GetList(
                                        array(
                                            "SORT" => "ASC"
                                        ),
                                        array(
                                            "IBLOCK_ID" => 21,
                                            "CODE" => "AUTO_CATEGORY"
                                        )
                                    );
                                    while($enumFields = $propertyEnums->GetNext()) {
                                        $checked = false;
                                        if ($resumeData["PROPERTY_AUTO_CATEGORY_VALUE"]) {
                                            if (in_array($enumFields["ID"], $resumeData["PROPERTY_AUTO_CATEGORY_VALUE"])) {
                                                $checked = true;
                                            }
                                        } else {
                                            if (!$counter) {
                                                $checked = true;
                                            }
                                        }
                                        ?>
                                        <div class="form-group-mini">
                                            <input type="checkbox" class="styled" id="i34-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="AUTO_CATEGORY[]"<?= $checked ? ' checked' : '' ?>>
                                            <label for="i34-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                        </div>
                                        <?
                                        $counter++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!--<input type="hidden" name="CREATE_COMPLETE" value="2370">-->
                        <div class="form-bottom">
                            <input type="submit" class="btn btn--red step-back-btn" value="Назад" data-step="2">
                            <a class="preview resume-preview-btn" href="#">Предварительный просмотр</a>
                            <input type="submit" class="btn btn--blue" value="Опубликовать резюме">
                        </div>
                    </div>
                </form>
            </div>
        <? endif; ?>
    <? endif;
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>