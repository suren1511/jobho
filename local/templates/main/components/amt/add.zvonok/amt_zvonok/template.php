<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<?
//echo "<pre>Template arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
//exit();

?>

<? if (count($arResult["ERRORS"])): ?>
  <?= ShowError(implode("<br />", $arResult["ERRORS"])) ?>
<? endif ?>
<? if (strlen($arResult["MESSAGE"]) > 0): ?>
  <?= ShowNote($arResult["MESSAGE"]) ?>
<? endif ?>
<div class="vertical-form">
  <form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data" id="add_objekt">

    <div class="form-groups">

      <?= bitrix_sessid_post() ?>

      <? if ($arParams["MAX_FILE_SIZE"] > 0): ?>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?= $arParams["MAX_FILE_SIZE"] ?>"/>
      <? endif ?>


      <? if (is_array($arResult["PROPERTY_LIST"]) && count($arResult["PROPERTY_LIST"] > 0)): ?>


        <? foreach ($arResult["PROPERTY_LIST"] as $propertyID): ?>
          <!--<? print_r($propertyID)?>-->
          <!--<? print_r($i)?>-->
          <? if ($propertyID == '526'){?>
            <p><strong>Выберите типa звонка</strong></p>
          <?}?>

          <? if ($propertyID != '526'){?>
          <div class="form-group"<? if ($propertyID == 'NAME'){?> style="display: none" <?}?>>

            <label>
              <? if (intval($propertyID) > 0): ?>

                <?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] ?><? else: ?>

                <?= !empty($arParams["CUSTOM_TITLE_" . $propertyID]) ? $arParams["CUSTOM_TITLE_" . $propertyID] : GetMessage("IBLOCK_FIELD_" . $propertyID) ?><? endif ?>
              <? if (in_array($propertyID, $arResult["PROPERTY_REQUIRED"])): ?><span class="starrequired">*</span><? endif ?>
            </label>
            <?}?>


              <?
              //echo "<pre>"; print_r($arResult["PROPERTY_LIST_FULL"]); echo "</pre>";
              if (intval($propertyID) > 0) {
                if (
                  $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
                  &&
                  $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
                )
                  $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
                elseif (
                  (
                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
                    ||
                    $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
                  )
                  &&
                  $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
                )
                  $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
              }
              elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
                $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

              if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y") {
                $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
                $inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
              }
              else {
                $inputNum = 1;
              }

              if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
                $INPUT_TYPE = "USER_TYPE";
              else
                $INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

              switch ($INPUT_TYPE):
                case "USER_TYPE":
                  for ($i = 0; $i < $inputNum; $i++) {
                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                      $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
                      $description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
                    }
                    elseif ($i == 0) {
                      $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                      $description = "";
                    }
                    else {
                      $value = "";
                      $description = "";
                    }
                    echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
                      array(
                        $arResult["PROPERTY_LIST_FULL"][$propertyID],
                        array(
                          "VALUE" => $value,
                          "DESCRIPTION" => $description,
                        ),
                        array(
                          "VALUE" => "PROPERTY[" . $propertyID . "][" . $i . "][VALUE]",
                          "DESCRIPTION" => "PROPERTY[" . $propertyID . "][" . $i . "][DESCRIPTION]",
                          "FORM_NAME" => "iblock_add",
                        ),
                      ));

                  }
                  break;
                case "TAGS":
                  $APPLICATION->IncludeComponent(
                    "bitrix:search.tags.input",
                    "",
                    array(
                      "VALUE" => $arResult["ELEMENT"][$propertyID],
                      "NAME" => "PROPERTY[" . $propertyID . "][0]",
                      "TEXT" => 'size="' . $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] . '"',
                    ), null, array("HIDE_ICONS" => "Y")
                  );
                  break;
                case "HTML":
                  $LHE = new CLightHTMLEditor;
                  $LHE->Show(array(
                    'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[" . $propertyID . "][0]"),
                    'width' => '100%',
                    'height' => '200px',
                    'inputName' => "PROPERTY[" . $propertyID . "][0]",
                    'content' => $arResult["ELEMENT"][$propertyID],
                    'bUseFileDialogs' => false,
                    'bFloatingToolbar' => false,
                    'bArisingToolbar' => false,
                    'toolbarConfig' => array(
                      'Bold', 'Italic', 'Underline', 'RemoveFormat',
                      'CreateLink', 'DeleteLink', 'Image', 'Video',
                      'BackColor', 'ForeColor',
                      'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull',
                      'InsertOrderedList', 'InsertUnorderedList', 'Outdent', 'Indent',
                      'StyleList', 'HeaderList',
                      'FontList', 'FontSizeList',
                    ),
                  ));
                  break;
                case "T":
                  for ($i = 0; $i < $inputNum; $i++) {

                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                      $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                    }
                    elseif ($i == 0) {
                      $value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
                    }
                    else {
                      $value = "";
                    }
                    ?>
                    <textarea cols="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"] ?>" rows="<?= $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] ?>" name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"><?= $value ?></textarea>
                    <?
                  }
                  break;

                case "S":
                case "N":
                  for ($i = 0; $i < $inputNum; $i++) {
                    if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                      $value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
                    }
                    elseif ($i == 0) {
                      $value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

                    }
                    else {
                      $value = "";
                    }
                    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]['ID'] == '511'){
                      $value=$USER->GetID();
                    }
                    ?>



                    <input type="text" name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"  value="<?= $value ?>" class="form-control"/>

                    <?
                    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
                      $APPLICATION->IncludeComponent(
                        'bitrix:main.calendar',
                        '',
                        array(
                          'FORM_NAME' => 'iblock_add',
                          'INPUT_NAME' => "PROPERTY[" . $propertyID . "][" . $i . "]",
                          'INPUT_VALUE' => $value,
                        ),
                        null,
                        array('HIDE_ICONS' => 'Y')
                      );
                      ?><small><?= GetMessage("IBLOCK_FORM_DATE_FORMAT") ?><?= FORMAT_DATETIME ?></small><?
                    endif
                    ?><?
                  }
                  break;

                case "F":

$propFail=$propertyID;

                  $APPLICATION->IncludeComponent("bitrix:main.file.input", "drag_n_drop_amt", Array(
                    "COMPONENT_TEMPLATE" => "drag_n_drop",
                    "INPUT_NAME" => $propFail,
                    "MULTIPLE" => "Y",
                    "MODULE_ID" => "iblock",
                    "MAX_FILE_SIZE" => "",
                    "ALLOW_UPLOAD" => "A",
                    "ALLOW_UPLOAD_EXT" => ""
                  ),
                    false
                  );


                  break;
                case "L":
                  ?>

                    <?

                    if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
                      $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
                    else
                      $type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

                    switch ($type):
                      case "checkbox":
                      case "radio":

                        //echo "<pre>"; print_r($arResult["PROPERTY_LIST_FULL"][$propertyID]); echo "</pre>";
                        $countList = count($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"]);

                        foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                          $checked = false;
                          if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                            if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID])) {
                              foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum) {
                                if ($arElEnum["VALUE"] == $key) {
                                  $checked = true;
                                  break;
                                }
                              }
                            }
                          }
                          else {
                            if ($arEnum["DEF"] == "Y") $checked = true;
                          }

                          ?>
                          <div class="form-group">
                            <div class="form-group-mini col-4">
                              <input type="<?= $type ?>" name="PROPERTY[<?= $propertyID ?>]<?= $type == "checkbox" ? "[" . $key . "]" : "" ?>" value="<?= $key ?>" id="property_<?= $key ?>"<?= $checked ? " checked=\"checked\"" : "" ?> class="styled align-top"<?
                              if ($arResult["PROPERTY_LIST_FULL"][$propertyID]['ID'] == '519') {
                                ?> checked<?
                              }
                              ?>/>
                              <label for="property_<?= $key ?>"><?= $arEnum["VALUE"] ?></label><br/>
                            </div>
                          </div>
                          <?
                        }
                        break;

                      case "dropdown":
                      case "multiselect":
                        ?>
                        <select name="PROPERTY[<?= $propertyID ?>]<?= $type == "multiselect" ? "[]\" size=\"" . $arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] . "\" multiple=\"multiple" : "" ?>">
                          <?
                          if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
                          else $sKey = "ELEMENT";

                          foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum) {
                            $checked = false;
                            if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                              foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum) {
                                if ($key == $arElEnum["VALUE"]) {
                                  $checked = true;
                                  break;
                                }
                              }
                            }
                            else {
                              if ($arEnum["DEF"] == "Y") $checked = true;
                            }
                            ?>
                            <option value="<?= $key ?>" <?= $checked ? " selected=\"selected\"" : "" ?>><?= $arEnum["VALUE"] ?></option>
                            <?
                          }
                          ?>
                        </select>
                        <?
                        break;

                    endswitch;
                    ?>

                  <?
                  break;
              endswitch; ?>
            <? if ($propertyID != '526'){?>
          </div>
          <?}?>
        <? endforeach; ?>
        <? if ($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0): ?>

          <?= GetMessage("IBLOCK_FORM_CAPTCHA_TITLE") ?>

          <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
          <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA"/>


          <?= GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT") ?><span class="starrequired">*</span>:
          <input type="text" name="captcha_word" maxlength="50" value=""/>

        <? endif ?>


      <? endif ?>
      <div class="message"></div>
      <input class="btn btn--red" type="submit" name="iblock_submit" value="<?= GetMessage("IBLOCK_FORM_SUBMIT") ?>"/>
      <? if (strlen($arParams["LIST_URL"]) > 0 && $arParams["ID"] > 0): ?><input type="submit" name="iblock_apply" value="<?= GetMessage("IBLOCK_FORM_APPLY") ?>" /><? endif ?>
      <? /*<input type="reset" value="<?=GetMessage("IBLOCK_FORM_RESET")?>" />*/ ?>





      <? if (strlen($arParams["LIST_URL"]) > 0): ?><a href="<?= $arParams["LIST_URL"] ?>"><?= GetMessage("IBLOCK_FORM_BACK") ?></a><? endif ?>

    </div>

  </form>
</div>