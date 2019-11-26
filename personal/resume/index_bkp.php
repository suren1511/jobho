<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?
if(!$USER->IsAuthorized())
{
    LocalRedirect('/auth/');
}
else {
    $strGroups = CUser::GetUserGroupArray();
    if (in_array(12, $strGroups)): //соискатели ?>
        <div class="b-personal-breadcrumbs">
            <ul>
                <li><a href="#">Вакансии</a></li>
                <li><a href="/personal/resume/">Резюме</a></li>
                <li><a href="#">Настройки</a></li>
                <li><a href="#">Объекты</a></li>
                <li><a href="#">Помощь</a></li>
                <li><a href="#">Финансы</a></li>
            </ul>
        </div>

        <div class="b-personal-header">
            <h1>Новое резюме</h1>
            <ul class="b-personal-header__links">
                <li><a href="#">Создать из шаблона</a></li>
            </ul>
        </div>

        <div class="steps">
            <?
            if ($_REQUEST["final"] || $_REQUEST["step"] == 3) {
                $step = 3;
            } elseif ($_REQUEST["step"] == 2) {
                $step = 2;
            } else {
                $step = 1;
            }
            ?>
            <div class="steps__item<?= $step == 1 ? ' steps__item-active' : '' ?>" data-step="1">1 <span>Шаг 1</span></div>
            <div class="steps__item<?= $step == 2 ? ' steps__item-active' : '' ?>" data-step="2">2 <span>Шаг 2</span></div>
            <div class="steps__item<?= $step == 3 ? ' steps__item-active' : '' ?>" data-step="3">3 <span>Шаг 3</span></div>
        </div>

        <div class="summary__desc">
            <p>Контакты, которые вы указываете при создании резюме, работодатель будет использовать для связи с
                вами. Также вы будете получать информацию о приглашениях на вакансии.</p>
        </div>
        <?
        $el = new CIBlockElement;
        $arUser = CUser::GetByID($USER->GetID())->Fetch();
        echo "<pre>";
        print_r($_REQUEST);
        echo "</pre>";
        if ($arUser["ID"]) {
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
                $resumeData = $arResume;
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
        }
        ?>
        <?
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
            if ($resumeData["ID"]) {
                $propFields = array(
                    "FIRST_NAME" => $_REQUEST["FIRST_NAME"] ? $_REQUEST["FIRST_NAME"] : $resumeData["PROPERTY_FIRST_NAME_VALUE"],
                    "LAST_NAME" => $_REQUEST["LAST_NAME"] ? $_REQUEST["LAST_NAME"] : $resumeData["PROPERTY_LAST_NAME_VALUE"],
                    "PHONE" => $_REQUEST["PHONE"] ? $_REQUEST["PHONE"] : $resumeData["PROPERTY_PHONE_VALUE"],
                    "EMAIL" => $_REQUEST["EMAIL"] ? $_REQUEST["EMAIL"] : $resumeData["PROPERTY_EMAIL_VALUE"],
                    "B_DATE" => $bDate ? $bDate : $resumeData["PROPERTY_B_DATE_VALUE"],
                    "GENDER" => $_REQUEST["GENDER"] ? $_REQUEST["GENDER"] : $resumeData["PROPERTY_GENDER_VALUE"],
                    "NATIONALITY" => $_REQUEST["NATIONALITY"] ? $_REQUEST["NATIONALITY"] : $resumeData["PROPERTY_NATIONALITY_VALUE"],
                    "WORK_ACCESS" => $_REQUEST["WORK_ACCESS"] ? $_REQUEST["WORK_ACCESS"] : $resumeData["PROPERTY_WORK_ACCESS_VALUE"],
                    "REGION" => $_REQUEST["REGION"] ? $_REQUEST["REGION"] : $resumeData["PROPERTY_REGION_VALUE"],
                    "RESUME_TYPE" => $_REQUEST["RESUME_TYPE"] ? $_REQUEST["RESUME_TYPE"] : $resumeData["PROPERTY_RESUME_TYPE_VALUE"],
                    "RESUME_SHOW" => $_REQUEST["RESUME_SHOW"] ? $_REQUEST["RESUME_SHOW"] : $resumeData["PROPERTY_RESUME_SHOW_VALUE"],
                    "EXP" => $_REQUEST["EXP"] ? $_REQUEST["EXP"] : $resumeData["PROPERTY_EXP_VALUE"],
                    "POSITION" => $_REQUEST["POSITION"] ? $_REQUEST["POSITION"] : $resumeData["PROPERTY_POSITION_VALUE"],
                    "PAY" => $_REQUEST["PAY"] ? $_REQUEST["PAY"] : $resumeData["PROPERTY_PAY_VALUE"],
                    "PROF_AREA" => $_REQUEST["PROF_AREA"] ? $_REQUEST["PROF_AREA"] : $resumeData["PROPERTY_PROF_AREA_VALUE"],
                    "USER" => $_REQUEST["USER"] ? $_REQUEST["USER"] : $resumeData["PROPERTY_USER_VALUE"],
                );
                $arFields = array(
                    "NAME" => "Резюме от " . $userName . " (" . date('d.m.Y') . ")",
                    "PROPERTY_VALUES" => $propFields
                );
                if ($_FILES["PREVIEW_PICTURE"]) {
                    $arFields["PREVIEW_PICTURE"] = $_FILES["PREVIEW_PICTURE"];
                }
                if ($_REQUEST["PREVIEW_TEXT"]) {
                    $arFields["PREVIEW_TEXT"] = htmlspecialcharsbx($_REQUEST["PREVIEW_TEXT"]);
                }
                $res = $el->Update($resumeData["ID"], $arFields);
                $productID = $resumeData["ID"];
            } else {
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
            }
            if ($productID) {
                if ($_REQUEST["WORK_COUNT"]) {
                    $workRequestItems = array();
                    for ($i = 1; $i <= $_REQUEST["WORK_COUNT"]; $i++) {
                        $beginWorkDate = $endWorkDate = '';
                        $beginWorkDate = $_REQUEST["WORK_BEGIN_DATE_" . $i] . '.' . SiteHelper::getMonthNumberByName($_REQUEST["WORK_BEGIN_MONTH_" . $i]) . '.' . $_REQUEST["WORK_BEGIN_YEAR_" . $i];
                        $endWorkDate = $_REQUEST["WORK_BEGIN_DATE_" . $i] . '.' . SiteHelper::getMonthNumberByName($_REQUEST["WORK_BEGIN_MONTH_" . $i]) . '.' . $_REQUEST["WORK_BEGIN_YEAR_" . $i];
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
        if ($arUser["ID"]) {
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
                echo "<pre>";
                print_r($resumeData);
                echo "</pre>";
                $resumeData = $arResume;
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
        }
        ?>
        <? if ($_REQUEST["final"]): ?>
            <div class="alert alert-success">
                Спасибо!<br>
                Ваше резюме будет опубликовано после проверки.
            </div>
        <? endif; ?>
        <? if (!$_REQUEST["final"] && (!$_REQUEST["step"] || $_REQUEST["step"] == 1)): ?>
            <div class="vertical-form">
                <form action="/personal/resume/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="step" value="2" />
                    <input type="hidden" name="USER" value="<?= $arUser["ID"] ?>" />
                    <input type="hidden" name="accept" value="Y" />
                    <div class="form-groups">
                        <div class="form-group">
                            <label for="i1">Имя</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i1" value="Михаил" name="FIRST_NAME">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i2" class="required">Фамилия</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i2" value="Иванов" name="LAST_NAME">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i3" class="required">Моб. телефон</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i3" value="+ 7 955 555 55 55" name="PHONE">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i4" class="required">E-mail</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i4" value="mihail@ya.ru" name="EMAIL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i5" class="required">Дата рождения</label>
                            <div class="input-group">
                                <div class="flex-row">
                                    <div class="col-2">
                                        <select class="form-control" id="i5" name="B_DATE_DATE">
                                            <option value="" selected>Дата</option>
                                            <? for ($i = 1; $i <= 31; $i++): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <? endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control" name="B_DATE_MONTH">
                                            <? $arMonths = SiteHelper::getMonthList(); ?>
                                            <option value="" selected>Месяц</option>
                                            <? foreach ($arMonths as $month): ?>
                                                <option value="<?= $month ?>"><?= $month ?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control" name="B_DATE_YEAR">
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
                                        ?>
                                        <div class="form-group-mini col-2">
                                            <input type="radio" class="styled" id="i6-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="GENDER"<?= !$counter ? ' checked' : '' ?>>
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
                                        ?>
                                        <div class="form-group-mini col-2">
                                            <input type="radio" class="styled" id="i7-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="NATIONALITY"<?= !$counter ? ' checked' : '' ?>>
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
                                <input class="form-control" type="text" id="i8" value="России" name="WORK_ACCESS">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i9" class="required">Регион проживания</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i9" value="Татарстан" name="REGION">
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
                                        ?>
                                        <div class="form-group-mini col-2">
                                            <input type="radio" class="styled" id="i10-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="RESUME_TYPE"<?= !$counter ? ' checked' : '' ?>>
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
                                        ?>
                                        <div class="form-group-mini col-2">
                                            <input type="radio" class="styled" id="i11-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="RESUME_SHOW"<?= !$counter ? ' checked' : '' ?>>
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
                                <input class="styled" type="file" id="i37" accept="image/*" data-label="Загрузить фото профиля" name="PREVIEW_PICTURE">
                            </div>
                        </div>
                    </div>
                    <div class="form-bottom align-right">
                        <input type="submit" class="btn btn--blue" value="Продолжить">
                    </div>
                </form>
            </div>
        <? endif; ?>
        <? if ($_REQUEST["step"] == 2): ?>
            <div class="vertical-form">
                <form action="/personal/resume/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="step" value="3" />
                    <input type="hidden" name="USER" value="<?= $arUser["ID"] ?>" />
                    <input type="hidden" name="accept" value="Y" />
                    <div class="summary__desc">
                        <h2>Желаемая работа</h2>
                        <p>Укажите, на какой должности вы хотите работать. Если вы готовы работать на разных должностях создайте для каждой из них отдельное резюме.</p>
                    </div>
                    <div class="form-groups">
                        <div class="form-group">
                            <label for="i6" class="required">Опыт работы</label>
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
                                        ?>
                                        <div class="form-group-mini col-2">
                                            <input type="radio" class="styled" id="i6-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="EXP"<?= !$counter ? ' checked' : '' ?>>
                                            <label for="i6-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                        </div>
                                        <?
                                        $counter++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i1">Желаемая должность</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i1" value="" name="POSITION">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i2" class="required">Зарплата</label>
                            <div class="input-group">
                                <div class="flex-row">
                                    <div class="col-4">
                                        <input class="form-control" type="text" id="i2" value="" name="PAY">
                                    </div>
                                    <div class="col-2 align-middle">На руки</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="i3">Проф. область</label>
                            <div class="input-group">
                                <select class="form-control" id="i3">
                                    <option value="" selected>Выбрать профессиональную область</option>
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
                                        ?>
                                        <option value="<?= $enumFields["ID"] ?>"><?= $enumFields["VALUE"] ?></option>
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
                                    <label for="i5_<?= $counter ?>">Начало работы</label>
                                    <div class="input-group">
                                        <div class="flex-row">
                                            <div class="col-2">
                                                <select class="form-control" id="i5_<?= $counter ?>" name="WORK_BEGIN_DATE_<?= $counter ?>">
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
                                            <input type="checkbox" class="styled end-data-checkbox" id="i7_<?= $counter ?>" value="По настоящее время" name="WORK_END_CURRENT_<?= $counter ?>"<?= $workItem["PROPERTY_WORK_END_VALUE"] == 'По настоящее время' ? ' checked' : '' ?>>
                                            <label for="i7_<?= $counter ?>">По настоящее время</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group end-data-container">
                                    <label for="i4_<?= $counter ?>">Дата окончания</label>
                                    <div class="input-group">
                                        <div class="flex-row">
                                            <div class="col-2">
                                                <select class="form-control" id="i4_<?= $counter ?>" name="WORK_END_DATE_<?= $counter ?>">
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
                                    <label for="i11_<?= $counter ?>">Организация</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i11_<?= $counter ?>" value="" name="ORG_<?= $counter ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i12_<?= $counter ?>">Должность</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i12_<?= $counter ?>" value="" name="WORK_POSITION_<?= $counter ?>">
                                    </div>
                                </div>
                                <p><strong>Обязанности, функции, достижения</strong></p>
                                <div class="form-group">
                                    <div class="input-group">
                                        <textarea class="form-control" type="text" name="WORK_DETAIL_<?= $counter ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            <? $counter++; ?>
                        <? endforeach; ?>
                    <? else: ?>
                        <div class="form-groups">
                            <div class="form-group">
                                <label for="i5_1">Начало работы</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <div class="col-2">
                                            <select class="form-control" id="i5_1" name="WORK_BEGIN_DATE_1">
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
                                        <input type="checkbox" class="styled" id="i7_1" value="before" name="WORK_BEGIN_CURRENT_1">
                                        <label for="i7_1">По настоящее время</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i4_1">Дата окончания</label>
                                <div class="input-group">
                                    <div class="flex-row">
                                        <div class="col-2">
                                            <select class="form-control" id="i4_1" name="WORK_END_DATE_1">
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
                                <label for="i11_1">Организация</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i11_1" value="" name="ORG_1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i12_1">Должность</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i12_1" value="" name="WORK_POSITION_1">
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
                        <input type="submit" class="btn btn--red" value="Назад" onclick="window.location = '/personal/resume/?step=1; return false;">
                        <input type="submit" class="btn btn--blue" value="Продолжить">
                    </div>

                </form>
            </div>
        <? endif; ?>
        <? if ($_REQUEST["step"] == 3): ?>
            <div class="vertical-form">
                <form action="/personal/resume/" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="final" value="Y" />
                    <input type="hidden" name="USER" value="<?= $arUser["ID"] ?>" />
                    <input type="hidden" name="accept" value="Y" />
                    <div class="form-groups">
                        <p><strong>Обо мне</strong></p>
                        <div class="form-group">
                            <div class="input-group">
                                <textarea class="form-control" type="text" name="PREVIEW_TEXT"></textarea>
                                <p class="nb">Расскажите дополнительную информацию, которая поможет работодателю лучше
                                    узнать вас. Поле необязательно для заполнения.</p>
                            </div>
                        </div>
                    </div>
                    <h2>Образование</h2>
                    <div class="form-groups">
                        <div class="form-group align-top">
                            <label for="i6">Уровень</label>
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
                                        ?>
                                        <div class="form-group-mini">
                                            <input type="radio" class="styled" id="i6-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="EDUC_LEVEL"<?= !$counter ? ' checked' : '' ?>>
                                            <label for="i6-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                        </div>
                                        <?
                                        $counter++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?
                        $counter = 1;
                        if (count($arEdu)): ?>
                            <? foreach ($arEdu as $arEduItem): ?>
                                <input type="hidden" name="EDU_ID_<?= $counter ?>" value="<?= $arEdu["ID"] ?>" />
                                <div class="form-group">
                                    <label for="i4-<?= $counter ?>">Учебное заведение</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i4-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_INSTITUT_VALUE"] ?>" name="EDU_INSTITUT_<?= $counter ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i5-<?= $counter ?>">Факультет</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i5-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_FAKULTET_VALUE"] ?>" name="EDU_FAKULTET_<?= $counter ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i6-<?= $counter ?>">Специализация</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i6-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_SPEC_VALUE"] ?>" name="EDU_SPEC_<?= $counter ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i7-<?= $counter ?>">Год окончания</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i7-<?= $counter ?>" value="<?= $arEduItem["PROPERTY_EDU_END_VALUE"] != "По настоящее время" ? $arEduItem["PROPERTY_EDU_END_VALUE"] : '' ?>" name="EDU_END_<?= $counter ?>">
                                    </div>
                                    <div class="input-group-append">
                                        <div class="form-group-mini">
                                            <input type="checkbox" class="styled" id="i71-<?= $counter ?>" value="По настоящее время" name="EDU_END_CURRENT_<?= $counter ?>"<?= $arEduItem["PROPERTY_EDU_END_VALUE"] == "По настоящее время" ? ' checked' : '' ?>>
                                            <label for="i71-<?= $counter ?>">По настоящее время</label>
                                        </div>
                                    </div>
                                </div>
                                <? $counter++; ?>
                            <? endforeach; ?>
                        <? else: ?>
                            <div class="form-group">
                                <label for="i4-<?= $counter ?>">Учебное заведение</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i4-<?= $counter ?>" value="" name="EDU_INSTITUT_1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i5-<?= $counter ?>">Факультет</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i5-<?= $counter ?>" value="" name="EDU_FAKULTET_1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i6-<?= $counter ?>">Специализация</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i6-<?= $counter ?>" value="" name="EDU_SPEC_1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i7-<?= $counter ?>">Год окончания</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="i7-<?= $counter ?>" value="" name="EDU_END_1">
                                </div>
                                <div class="input-group-append">
                                    <div class="form-group-mini">
                                        <input type="checkbox" class="styled" id="i71-<?= $counter ?>" value="По настоящее время" name="EDU_END_CURRENT_1">
                                        <label for="i71-<?= $counter ?>">По настоящее время</label>
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
                            <label for="i8">Родной язык</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i8" value="" name="LANG_NATIVE">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="i9">Иностранные языки</label>
                            <div class="input-group">
                                <input class="form-control" type="text" id="i9" value="" name="LANG_FOREIGN">
                            </div>
                        </div>
                    </div>

                    <h2>Дополнительно</h2>
                    <div class="form-groups">
                        <div class="form-group align-top">
                            <label for="i10">Переезд</label>
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
                                        ?>
                                        <div class="form-group-mini">
                                            <input type="radio" class="styled" id="i10-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="RELOCATION"<?= !$counter ? ' checked' : '' ?>>
                                            <label for="i10-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
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
                                ?>
                                <div class="form-group-mini">
                                    <input type="checkbox" class="styled" id="i1c-<?= $counter ?>" value="before" name="EMPLOYMENT">
                                    <label for="i1c-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
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
                                ?>
                                <div class="form-group-mini">
                                    <input type="checkbox" class="styled" id="i2c-<?= $counter ?>" value="before" name="SHEDULE">
                                    <label for="i2c-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
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
                                ?>
                                <div class="form-group-mini">
                                    <input type="radio" class="styled" id="i31-<?= $counter ?>" value="<?= $enumFields["ID"] ?>" name="HAVE_AUTO"<?= !$counter ? ' checked' : '' ?>>
                                    <label for="i31-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
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
                                    ?>
                                    <div class="form-group-mini">
                                        <input type="checkbox" class="styled" id="i4c-<?= $counter ?>" value="before" name="AUTO_CATEGORY">
                                        <label for="i4c-<?= $counter ?>"><?= $enumFields["VALUE"] ?></label>
                                    </div>
                                    <?
                                    $counter++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <input type="submit" class="btn btn--red" value="Назад" onclick="window.location = '/personal/resume/?step=2; return false;">
                        <a class="preview" href="#">Предварительный просмотр</a>
                        <input type="submit" class="btn btn--blue" value="Опубликовать резюме">
                    </div>
                </form>
            </div>
        <? endif; ?>
    <? endif;
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>