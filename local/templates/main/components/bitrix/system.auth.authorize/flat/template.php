<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */
?>
<div class="vertical-form wide-form">
    <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <?if (strlen($arResult["BACKURL"]) > 0):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>
        <div class="flex-row">
            <div class="col-3">
                <div class="form__auth">
                    <div class="form__auth-header">
                        <div class="form__auth-header-name">
                            <h1>Вход</h1>
                        </div>
                        <div class="form__auth-header-more">
                            <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" class="red-link">Регистрация</a>
                        </div>
                    </div>
                    <div class="form__auth-body">
                        <?
                        if(!empty($arParams["~AUTH_RESULT"]) && $_REQUEST["login"]):
                            $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                            ?>
                            <div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
                        <?endif?>

                        <?
                        if($arResult['ERROR_MESSAGE']):
                            $text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
                            ?>
                            <div class="alert alert-danger"><?=nl2br(htmlspecialcharsbx($text))?></div>
                        <?endif?>
                        <div class="form-group">
                            <label for="login">Логин</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="login" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="E-mail или телефон">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="USER_PASSWORD" maxlength="255" autocomplete="off">
                            </div>
                        </div>
                        <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
                            <div class="form-group">
                                <div class="col-2-offset col-4">
                                    <input type="checkbox" class="styled" value="Y" id="USER_REMEMBER" name="USER_REMEMBER">
                                    <label for="USER_REMEMBER" class="col-6">Запомнить меня</label>
                                </div>
                            </div>
                        <?endif?>
                        <div class="form-bottom">
                            <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="blue-link">Забыли пароль?</a>
                            <input type="submit" class="btn btn--blue" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

