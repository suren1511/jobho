<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<!--<div class="subscribe-form">-->
	<form action="<?= $arResult["FORM_ACTION"] ?>">

		<? foreach ($arResult["RUBRICS"] as $itemID => $itemValue): ?>
			<label style="display:none;" for="sf_RUB_ID_<?= $itemValue["ID"] ?>">
				<input style="display:none;" type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?= $itemValue["ID"] ?>"
					   value="<?= $itemValue["ID"] ?>"<? if ($itemValue["CHECKED"]) echo " checked" ?> /> <?= $itemValue["NAME"] ?>
			</label><br/>
		<? endforeach; ?>
		<div class="subscribe_input">
			<input type="text" placeholder="Введите адрес электронной почты" name="sf_EMAIL"  value="<?= $arResult["EMAIL"] ?>"
				   title="<?= GetMessage("subscr_form_email_title") ?>"/>
			<input class="btn btn--blue" type="submit" name="OK" value="<?= GetMessage("subscr_form_button") ?>"/>
		</div>
        <p class="subscribe_notice">
            <label for="politics"><input type="checkbox" checked id="politics"> Нажимая кнопку "<?=GetMessage("subscr_form_button")?>", вы принимаете условия <a href="/politics.php">пользовательского соглашения</a></label>
        </p>
	</form>
<!--</div>-->
