<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");

if ($_REQUEST["confirm_registration"] == "yes") {
    $errors = '';
    if (!$_REQUEST["confirm_user"]) {
        $errors .= 'Неизвестный логин.<br>';
    }
    if (!$_REQUEST["confirm_code"]) {
        $errors .= 'Отсутствует код подтверждения.<br>';
    }
    if (!$errors) {
        $login = htmlspecialcharsbx($_REQUEST["confirm_user"]);
        global $USER;
        $rsUser = CUser::GetByLogin($login)->Fetch();
        if ($rsUser["UF_CONFIRM_CODE"] == $_REQUEST["confirm_code"]) {
            $user = new CUser;
            $fields = array(
                "ACTIVE" => "Y"
            );
            $user->Update($rsUser["ID"], $fields);
            $strError .= $user->LAST_ERROR;
            ?>
            <div class="alert alert-success"><?= $strError ?>Поздравляем, Вы успешно зарегистрированы на нашем ресурсе. <a href="/auth/">Авторизуйтесь</a> на сайте под указанным Вами e-mail адресом и паролем.</div>
            <?
        } else {
            ?>
            <div class="alert alert-danger">Неверный код подтверждения</div>
            <?
        }
    } else {
        ?>
        <div class="alert alert-danger"><?= $errors ?></div>
        <?
    }
} else {
    $APPLICATION->IncludeComponent(
        "amt:main.register",
        "custom",
        Array(
            "AUTH" => "N",
            "REQUIRED_FIELDS" => array(
                "LAST_NAME",
                "NAME",
                "LOGIN"
            ),
            "SET_TITLE" => "N",
            "SHOW_FIELDS" => array(
                "NAME",
                "LOGIN",
                "LAST_NAME",
                "WORK_PROFILE"
            ),
            "SUCCESS_PAGE" => "",
            "USER_PROPERTY" => array(
                "UF_USER_TYPE",
                "UF_TYPE_COMPANY",
                "UF_NAME_COMPANY",
                "UF_KADASTR",
                "UF_INN_COMPANY",
                "UF_CITY",
                "UF_COUNT_EMPLOYERS",
                "UF_SITE_COMPANY",
            ),
            "USER_PROPERTY_NAME" => "",
            "USE_BACKURL" => "Y"
        )
    );
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>