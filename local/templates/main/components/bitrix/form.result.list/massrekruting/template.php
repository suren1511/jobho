<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
    <?
    function showformcaption ($arResult,$name)
    {
    if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($name, $arResult['FORM_ERRORS']))
        {
		?><span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$name]?>"></span><?
	    }
        echo $arResult["QUESTIONS"][$name]["CAPTION"];
        if ($arQuestion["REQUIRED"] == "Y") echo " ".$arResult["REQUIRED_SIGN"]."  ";
		if ($arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y") echo "<br />".$arQuestion["IMAGE"]["HTML_CODE"];
    }
	?>
<?=$arResult["QUESTIONS"]["adresdostz_st"]["HTML_CODE"]?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<?=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y") 
{
?>
<?=$arResult["FORM_HEADER"]?>

<table>
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y") 
{ 
?>
	<tr>
		<td><?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"]) 
{
?>
	<h3><?=$arResult["FORM_TITLE"]?></h3>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?=$arResult["FORM_DESCRIPTION"]?></p>
		</td>
	</tr>
	<? 
} // endif 
	?>
</table>
<br />
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<?
  $arFilter = Array('IBLOCK_ID'=>'21','SECTION_ID'=>'278','GLOBAL_ACTIVE'=>'Y');
  $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
  while($result = $db_list->GetNext())
  {
    echo $result['ID'].' '.$result['NAME'].': '.$result['ELEMENT_CNT'].'<br>';
  }


$arFilter = Array("IBLOCK_ID"=>'21','SECTION_ID'=>'260', "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter);
while($ob = $res->GetNextElement())
{
  $arFields = $ob->GetFields();
  echo $arFields["NAME"];
}
?>
<table class="form-table data-table" style="width: 600px;">
	<thead>
		<tr>
			<th colspan="3">&nbsp;</th>
		</tr>
	</thead>
	<tbody>

	<tr><th><?showformcaption ($arResult,"name")?></th><th><?showformcaption ($arResult,"pol")?></th><th><?showformcaption ($arResult,"kolvochel")?></th></tr>
    <tr><td><?=$arResult["QUESTIONS"]["name"]["HTML_CODE"]?></td><td><?=$arResult["QUESTIONS"]["pol"]["HTML_CODE"]?></td><td><?=$arResult["QUESTIONS"]["kolvochel"]["HTML_CODE"]?></td></tr>
	<tr><th>Гражданство</th><th colspan="2">Квалификация</th></tr>
    <tr><td><?=$arResult["QUESTIONS"]["summa"]["HTML_CODE"]?></td><td colspan="2"></td></tr>
    <tr><th><?showformcaption ($arResult,"doljnobyazan")?></th><th colspan="2"><?showformcaption ($arResult,"treb")?></th></tr>
    <tr><td><?=$arResult["QUESTIONS"]["doljnobyazan"]["HTML_CODE"]?></td><td colspan="2"><?=$arResult["QUESTIONS"]["treb"]["HTML_CODE"]?></td></tr>
    <tr><th><?showformcaption ($arResult,"oplatatruda")?></th><td colspan="2"><?=$arResult["QUESTIONS"]["oplatatruda"]["HTML_CODE"]?></td></tr>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
		<tr>
			<th colspan="3"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
		</tr>
		<tr> 
			<td>&nbsp;</td>
			<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialchars($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
		</tr>
		<tr>
			<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
		</tr>
<?
} // isUseCaptcha
?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="3">
				<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];?>" />
				<?if ($arResult["F_RIGHT"] >= 15):?>
				&nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="<?=GetMessage("FORM_APPLY")?>" />
				<?endif;?>
				&nbsp;<input type="reset" value="<?=GetMessage("FORM_RESET");?>" />
			</th>
		</tr>
	</tfoot>
</table>
<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>

