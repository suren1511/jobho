<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>
<div id="ajax-auth-form-wrapper" class="bx-system-auth-form">
<?if ($arResult['SHOW_ERRORS'] == 'Y' && !empty($arResult['ERROR'])):?>
    <div id="errors" class="errors"><? ShowMessage($arResult['ERROR_MESSAGE']);?></div>
<?endif;?>

<?if($arResult["FORM_TYPE"] == "login"):?>

<form id="formlogin" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
    <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?endif?>
    <?foreach ($arResult["POST"] as $key => $value):?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
    <?endforeach?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <input type="hidden" name="AJAX-ACTION" value="AUTH"/>

        <?=GetMessage("AUTH_LOGIN")?>:<br />
        <div class="popup__input">
            <input type="text" name="USER_LOGIN" class="inputtext" maxlength="50" value="" size="17" />
                <script>
                    BX.ready(function() {
                        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                        if (loginCookie)
                        {
                            var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                            var loginInput = form.elements["USER_LOGIN"];
                            loginInput.value = loginCookie;
                        }
                    });
                </script>
        </div>

        <?=GetMessage("AUTH_PASSWORD")?>:<br />
        <div class="popup__input">
                <input type="password" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off" />
        </div>
    <?if($arResult["SECURE_AUTH"]):?>
        <span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
            <div class="bx-auth-secure-icon"></div>
        </span>
        <noscript>
        <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
            <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
        </span>
        </noscript>
        <script type="text/javascript">
        document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
        </script>
    <?endif?>

    <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
        <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
        <label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label><br>
    <?endif?>
    <?if ($arResult["CAPTCHA_CODE"]):?>
        <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
        <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
        <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
        <input type="text" name="captcha_word" maxlength="50" value="" />
    <?endif?>
        <input type="submit" name="Login" class="popup__submit btn btn--red" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /><br>
    <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
        <br><noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex><br />
    <?endif?>
        <noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex>
    <?if($arResult["AUTH_SERVICES"]):?>
        <div class="bx-auth-lbl"><?=GetMessage("socserv_as_user_form")?></div>
        <?
        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
            array(
                "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                "SUFFIX"=>"form",
            ),
            $component,
            array("HIDE_ICONS"=>"Y")
        );
        ?>
    <?endif?>
</form>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"Y",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
<div class="registration-links Bloko-Tabs-Body">
    <div class="registration-h">Зарегистрироваться как:</div><br>
    <div class="registration-links__link">
        <a href="/auth/registration/?how=applicant" class="btn btn--blue applicant">Соискатель</a>
    </div>
    <div class="registration-links__link">
        <a href="/auth/registration/?how=employer" class="btn btn--blue employer">Работодатель</a>
    </div>
</div>
<style>
    .registration-h {
        text-align: center;
        font-size: 15px;
    }
    .registration-links {
        display: block;
        padding: 10px 30px 30px;
    }

    .registration-links__link {
        display: inline-block;
    }
</style>
<?
elseif($arResult["FORM_TYPE"] == "otp"):
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="OTP" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?echo GetMessage("auth_form_comp_otp")?><br />
			<input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
		</tr>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
<?if ($arResult["REMEMBER_OTP"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
		</tr>
<?endif?>
		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
		</tr>
	</table>
</form>

<?endif?>

</div>

<script>
    $('#ajax-auth-form-wrapper').on('submit', 'form', function(){
        var $this = $(this);
        var $form = {
            action: $('#formlogin').attr('action'),
            post: {
                'container': 'ajax-auth-form-wrapper'
            }
        };
        $.each($('input', $this), function(){
            if ($(this).attr('name').length) {
                $form.post[$(this).attr('name')] = $(this).val();
            }
        });
        $.post($form.action, $form.post, function(data){
            var errors = $(data).filter('#errors');

            if(errors.prevObject[0].innerText.length < 4) {
                BX("open-login").style.display = "none";
                document.location.reload(true);
            }
            $('#ajax-auth-form-wrapper').replaceWith(data);

        }, 'html');
        return false;
    });
</script>
