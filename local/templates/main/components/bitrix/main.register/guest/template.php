<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="bx-auth">
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?else:?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<noindex>
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="REGISTRATION" />


		<div class="popup__input">
			<span><?=GetMessage("AUTH_NAME")?></span>
			<input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="bx-auth-input" />
		</div>
		<div class="popup__input">
			<span><?=GetMessage("AUTH_LAST_NAME")?></span>
			<input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="bx-auth-input" />
		</div>
		<div class="popup__input">
			<span><i class="starrequired">*</i><?=GetMessage("AUTH_LOGIN_MIN")?></span>
			<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="bx-auth-input" />
		</div>
		<div class="popup__input">
			<span><i class="starrequired">*</i><?=GetMessage("AUTH_PASSWORD_REQ")?></span>
			<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>

		</div>
		<div class="popup__input">
			<span><i class="starrequired">*</i><?=GetMessage("AUTH_CONFIRM")?></span>
			<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
		</div>
		<div class="popup__input">
			<?if($arResult["EMAIL_REQUIRED"]):?><?endif?><span><i class="starrequired">*</i><?=GetMessage("AUTH_EMAIL")?></span>
			<input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input" />
		</div>
<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></div>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<div><?if ($arUserField["MANDATORY"]=="Y"):?><i class="starrequired">*</i><?endif;
		?><?=$arUserField["EDIT_FORM_LABEL"]?>:
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?></div>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************

	/* CAPTCHA */
	if ($arResult["USE_CAPTCHA"] == "Y")
	{
		?>
		<div>
			<b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b>
		</div>
		<div>
			
			
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			
		</div>
		<div>
			<i class="starrequired">*</i><span><?=GetMessage("CAPTCHA_REGF_PROMT")?></span>:
			<input type="text" name="captcha_word" maxlength="50" value="" />
		</div>
		<?
	}
	/* CAPTCHA */
	?>
		<div>
			
			
				<?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
					array(
						"ID" => COption::getOptionString("main", "new_user_agreement", ""),
						"IS_CHECKED" => "Y",
						"AUTO_SAVE" => "N",
						"IS_LOADED" => "Y",
						"ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
						"ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
						"INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
						"REPLACE" => array(
							"button_caption" => GetMessage("AUTH_REGISTER"),
							"fields" => array(
								rtrim(GetMessage("AUTH_NAME"), ":"),
								rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
								rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
								rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
								rtrim(GetMessage("AUTH_EMAIL"), ":"),
							)
						),
					)
				);?>
			
		</div>


		<div>
			
			<input type="submit" name="Register" class="btn btn--blue" value="<?=GetMessage("AUTH_REGISTER")?>" />
		</div>
	

<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p><br>
<p><i class="starrequired">*</i><span><?=GetMessage("AUTH_REQ")?></span></p>
<?$arResult["AUTH_AUTH_URL"] = SITE_DIR."personal/"?>
<p>
<a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a>
</p>

</form>
</noindex>
<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?endif?>
</div>