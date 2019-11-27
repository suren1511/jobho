<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 * @global CUser $USER
 * @global CMain $APPLICATION
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
  die();
if ($USER->IsAuthorized()) {
  LocalRedirect('/personal/');
}

use Bitrix\Main\Loader;

Loader::includeModule('seoexpert.smsru');
?>
<div class="vertical-form wide-form">
  <div class="alert alert-danger register-errors-container" style="display: none;"></div>
  <?
  if (count($arResult["ERRORS"]) > 0):
    foreach ($arResult["ERRORS"] as $key => $error)
      if (intval($key) == 0 && $key !== 0)
        $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
    ShowError(implode("<br />", $arResult["ERRORS"]));
  elseif ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"): ?>
    <div class="alert alert-danger"><? echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT") ?></div>
  <? endif ?>
  <? if ($arResult["VALUES"]["USER_ID"] > 0): ?>
    <?
    switch ($arResult["VALUES"]["UF_USER_TYPE"]) {
      case 1:
        $text = 'Вы успешно зарегистрировались в сервисе поиска работы и  жилья - JobHostel.ru.';
        break;
      case 2:
        $text = 'Вы успешно зарегистрировались в сервисе поиска и релокации персонала - JobHostel.ru.';
        break;
      case 3:
        $text = 'Вы успешно зарегистрировались в сервисе поиска работы  и жилья - JobHostel.ru.';
        break;
      case 4:
        $text = 'Вы успешно зарегистрировались в сервисе поиска работы и жилья - JobHostel.ru.';
        break;
      default:
        $text = 'Вы успешно зарегистрировались на сервисе JobHostel.ru.';
    }
    ?>
    <? if ($arResult["VALUES"]["UF_LOGIN_TYPE"] == 'phone'): ?>
      <?
      \Seoexpert\Smsru\Handlers\SmsHandler::setCode($arResult["VALUES"]["LOGIN"]);
      ?>
      <div class="alert alert-success confirm_code_container-success" style="display: none;">Поздравляем, Вы успешно зарегистрированы на нашем ресурсе. <a href="/auth/">Авторизуйтесь</a> на сайте под указанным Вами номером телефона и паролем.</div>
      <div class="confirm_code_container">
        <p><?= $text ?></p>
        <p>Мы отправили код подтверждения на указанный Вами номер - <?= $arResult["VALUES"]["LOGIN"] ?></p>
        <div class="alert alert-danger confirm_code_form_errors" style="display: none;"></div>
        <form id="confirm_code_form">
          <div class="form__auth-body">
            <div class="form-group">
              <label for="name">Введите полученный код </label>
              <div class="input-group">
                <input type="text" name="code" class="form-control" value=""/>
                <input type="hidden" name="phone" value="<?= $arResult["VALUES"]["LOGIN"] ?>"/>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn--blue confirm_code_form_submit" name="register_submit_button" value="Отправить">
        </form>
      </div>
    <? else: ?>
      <?
      $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      function generate_string($input, $strength = 16)
      {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
          $random_character = $input[mt_rand(0, $input_length - 1)];
          $random_string .= $random_character;
        }
        return $random_string;
      }

      $code = generate_string($permitted_chars, 20);
      $user = new CUser;
      $fields = array(
        "UF_CONFIRM_CODE" => $code
      );
      $user->Update($arResult["VALUES"]["USER_ID"], $fields);
      $arEventFields = [
        "CODE" => $code,
        "LOGIN" => $arResult["VALUES"]["LOGIN"],
      ];
      CEvent::Send("C_EMAIL_CONFIRM", SITE_ID, $arEventFields);
      ?>
      <p><?= $text ?></p>
      <p>
        Подтвердите адрес электронной почты . Мы отправили письмо-подтверждение по адресу <?= $arResult["VALUES"]["LOGIN"] ?>.
        Пожалуйста, пройдите по ссылке в письме. Вы сможете работать на нашем сайте сразу же после
        подтверждения.</p>
    <? endif; ?>
  <? else: ?>
    <form method="post" class="register-form" action="<?= POST_FORM_ACTION_URI ?>" name="regform" id="regform" enctype="multipart/form-data" data-type="client">
      <input name="GRUP" value="12" type="hidden">
      <?
      if ($arResult["BACKURL"] <> ''):
        ?>
        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
      <?
      endif;
      ?>
      <div class="form__auth">
        <div class="form__auth-column">
          <div class="form__auth-form">
            <div class="form__auth-header">
              <div class="form__auth-header-name">
                <h1>Регистрация </h1>
              </div>
              <div class="form__auth-header-more">
                <a href="/auth/" class="red-link">Вход</a>
              </div>
            </div>
            <div class="form__auth-body">
              <div class="form-group">
                <label for="name">Имя </label>
                <div class="input-group">
                  <input class="form-control" id="name" type="text" name="REGISTER[NAME]" value="<?= $arResult["VALUES"]["NAME"] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="family">Фамилия</label>
                <div class="input-group">
                  <input class="form-control" id="family" type="text" name="REGISTER[LAST_NAME]" value="<?= $arResult["VALUES"]["LAST_NAME"] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="phone">E-mail или телефон</label>
                <div class="input-group">
                  <input class="form-control" id="phone" type="text" name="REGISTER[LOGIN]" value="<?= $arResult["VALUES"]["LOGIN"] ?>">
                </div>
              </div>

              <p><strong>Пароль</strong></p>
              <div class="form-group">
                <label for="password">Придумайте пароль</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" name="REGISTER[PASSWORD]" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label for="password2">Повторите пароль</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password2" name="REGISTER[CONFIRM_PASSWORD]" autocomplete="off">
                </div>
              </div>


              <?
              /* CAPTCHA */
              if ($arResult["USE_CAPTCHA"] == "Y") {
                ?>
                <p><strong>Введите код с картинки</strong></p>
                <div class="form-group">
                  <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                  <div class="col-3"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" alt=""></div>
                  <div class="col-3">
                    <input type="text" name="captcha_word" maxlength="50" class="form-control" value=""/>
                  </div>
                </div>
                <?
              }
              /* !CAPTCHA */
              ?>

              <div class="form-bottom align-right">
                <input type="submit" class="btn btn--blue register-form-submit" name="register_submit_button" value="Зарегистрироваться">
              </div>
              <br>
              <p class="nb">Нажимая «Зарегистрироваться», вы подтверждаете, что ознакомлены, полностью согласны и принимаете условия «Соглашения об оказании услуг по содействию в трудоустройстве (оферта)»</p>
            </div>
          </div>
        </div>

        <input type="hidden" name="UF_LOGIN_TYPE" value="email">


        <div class="form__auth-column">
          <div class="form__registration-type">
            <div class="form-group">
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i21" value="1" name="UF_USER_TYPE" data-id="i21" data-grup="12" data-type="client" checked>
                <label for="i21-c">Соискатель <span>Ищу работу</span></label>
              </div>
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i22" value="2" name="UF_USER_TYPE" data-id="i22" data-grup="14" data-type="company">
                <label for="i22-c">Работодатель <span>Ищу сотрудников</span></label>
              </div>
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i23" value="3" name="UF_USER_TYPE" data-id="i23" data-grup="15" data-type="company">
                <label for="i23-c">Арендодатель <span>Сдаю жилье</span></label>
              </div>
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i24" value="4" name="UF_USER_TYPE" data-id="i24" data-grup="13" data-type="client">
                <label for="i24-c">Арендатор <span>Ищу жилье</span></label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <form method="post" class="register-form" action="<?= POST_FORM_ACTION_URI ?>" name="regform" id="regform-company" enctype="multipart/form-data" data-type="client" style="display: none;">
      <input name="GRUP" value="" type="hidden">

      <?
      if ($arResult["BACKURL"] <> ''):
        ?>
        <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
      <?
      endif;
      ?>
      <div class="form__auth">
        <div class="form__auth-column">
          <div class="form__auth-form">
            <div class="form__auth-header">
              <div class="form__auth-header-name">
                <h1>Регистрация </h1>
              </div>
              <div class="form__auth-header-more">
                <a href="/auth/" class="red-link">Вход</a>
              </div>
            </div>
            <div class="form__auth-body">
              <div class="form-group">
                <label for="type-c">Тип компании</label>
                <div class="input-group">
                  <select name="UF_TYPE_COMPANY" id="type-c" class="form-control">
                    <?
                    $rsField = CUserFieldEnum::GetList(array(), array(
                      "USER_FIELD_ID" => 30,
                    ));
                    while ($arField = $rsField->GetNext()) {
                      ?>
                      <option value="<?= $arField["ID"] ?>"><?= $arField["VALUE"] ?></option>
                      <?
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="company-c">Название компании</label>
                <div class="input-group">
                  <input type="text" name="UF_NAME_COMPANY" id="company-c" class="form-control" value="<?= $arResult["VALUES"]["UF_NAME_COMPANY"] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="agency-c">Кадровое агентство</label>
                <div class="input-group">
                  <input type="text" name="UF_KADASTR" id="agency-c" class="form-control" value="<?= $arResult["VALUES"]["UF_KADASTR"] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inn-c">ИНН компании</label>
                <div class="input-group">
                  <input type="text" name="UF_INN_COMPANY" id="inn-c" class="form-control" value="<?= $arResult["VALUES"]["UF_INN_COMPANY"] ?>">
                </div>
              </div>
              <div class="form-group align-top">
                <label for="desc-c">Описание компании</label>
                <div class="input-group">
                  <textarea name="REGISTER[WORK_PROFILE]" id="desc-c" class="form-control"><?= $arResult["VALUES"]["WORK_PROFILE"] ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="town-c">Город</label>
                <div class="input-group">
                  <input type="text" name="UF_CITY" id="town-c" class="form-control" value="<?= $arResult["VALUES"]["UF_CITY"] ?>">
                </div>
              </div>
              <div class="form-group align-top">
                <label for="coll-c">Кол-во работников</label>
                <div class="input-group">
                  <input type="number" name="UF_COUNT_EMPLOYERS" id="coll-c" class="form-control styled" min="1" max="999" value="<?= $arResult["VALUES"]["UF_COUNT_EMPLOYERS"] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="site-c">Сайт компании</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="site-c" name="UF_SITE_COMPANY" value="<?= $arResult["VALUES"]["UF_SITE_COMPANY"] ?>">
                </div>
              </div>

              <p><strong>Контактное лицо</strong></p>
              <div class="form-group">
                <label for="name-c">Имя </label>
                <div class="input-group">
                  <input class="form-control" id="name-c" type="text" name="REGISTER[NAME]" value="<?= $arResult["VALUES"]["NAME"] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="family-c">Фамилия</label>
                <div class="input-group">
                  <input class="form-control" id="family-c" type="text" name="REGISTER[LAST_NAME]" value="<?= $arResult["VALUES"]["LAST_NAME"] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="phone-c">E-mail или телефон</label>
                <div class="input-group">
                  <input class="form-control" id="phone-c" type="text" name="REGISTER[LOGIN]" value="<?= $arResult["VALUES"]["LOGIN"] ?>">
                </div>
              </div>

              <?
              /* CAPTCHA */
              if ($arResult["USE_CAPTCHA"] == "Y") {
                ?>
                <p><strong>Введите код с картинки</strong></p>
                <div class="form-group">
                  <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                  <div class="col-3"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" alt=""></div>
                  <div class="col-3">
                    <input type="text" name="captcha_word" maxlength="50" class="form-control" value=""/>
                  </div>
                </div>
                <?
              }
              /* !CAPTCHA */
              ?>

              <p><strong>Пароль</strong></p>
              <div class="form-group">
                <label for="password-c">Придумайте пароль</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password-c" name="REGISTER[PASSWORD]" autocomplete="off">
                </div>
              </div>
              <div class="form-group">
                <label for="password2-c">Повторите пароль</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password2-c" name="REGISTER[CONFIRM_PASSWORD]" autocomplete="off">
                </div>
              </div>

              <div class="form-bottom align-right">
                <input type="submit" class="btn btn--blue register-form-submit" name="register_submit_button" value="Зарегистрироваться">
              </div>
              <br>
              <p class="nb">Нажимая «Зарегистрироваться», вы подтверждаете, что ознакомлены, полностью согласны и принимаете условия «Соглашения об оказании услуг по содействию в трудоустройстве (оферта)»</p>
            </div>
          </div>
        </div>

        <input type="hidden" name="UF_LOGIN_TYPE" value="email">


        <div class="form__auth-column">
          <div class="form__registration-type">
            <div class="form-group">
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i21-c" value="1" name="UF_USER_TYPE" data-id="i21" data-grup="12" data-type="client" checked>
                <label for="i21-c">Соискатель <span>Ищу работу</span></label>
              </div>
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i22-c" value="2" name="UF_USER_TYPE" data-id="i22" data-grup="14" data-type="company">
                <label for="i22-c">Работодатель <span>Ищу сотрудников</span></label>
              </div>
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i23-c" value="3" name="UF_USER_TYPE" data-id="i23" data-grup="15" data-type="company">
                <label for="i23-c">Арендодатель <span>Сдаю жилье</span></label>
              </div>
              <div class="form-group-mini">
                <input type="radio" class="styled align-top" id="i24-c" value="4" name="UF_USER_TYPE" data-id="i24" data-grup="13" data-type="client">
                <label for="i24-c">Арендатор <span>Ищу жилье</span></label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  <? endif; ?>
</div>