<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (!IsModuleInstalled("catalog") || !CModule::IncludeModule("catalog")) return;
?>
<script>
	BX.ready(function() {
		var result = new BX.MaskedInput({
			mask: '+7 (999) 999-99-99',
			input: BX('org_pit'),
			placeholder: '_'
		});
	});
</script>
<noindex>
	<? if ($arResult["isFormErrors"] == "Y"): ?><?= $arResult["FORM_ERRORS_TEXT"]; ?><? endif; ?>

	<? //=$arResult["FORM_NOTE"]?>

	<? if ($arResult["isFormNote"] == "Y") { ?>
 		<script>
 		$( document ).ready(function() {
 			$(".message").fadeIn('slow', function () {
 				$(this).html("<?=$arResult['arForm']['DESCRIPTION']?>").addClass("success");
				setTimeout(function(){
                    $(".success").fadeOut('slow');
                    }, 5000);
            });
 			
 		});
    	</script>
	<? } ?>
	<?= $arResult["FORM_HEADER"] ?>
	<?
	/***********************************************************************************
	 * form questions
	 ***********************************************************************************/
	?>
	<div class="supply-org">
		<div class="supply-org__block">
			<div class="supply-org__kind breakfast">
				Завтрак
			</div>
			<div class="supply-org__descr">
				<?
				$res = CIBlockElement::GetByID("837");
				if ($obedvip = $res->GetNext())
					$name = htmlspecialcharsBack($obedvip['NAME']);
				?>
				<div class="supply-org__type"><?= $obedvip['NAME'] ?></div>
				<span><?= $obedvip['PREVIEW_TEXT']; ?></span>

			</div>
			<div class="supply-org__cost">
				<?
				$ar_res = CPrice::GetBasePrice("837");
				$price = explode('.',$ar_res["PRICE"]);
				echo "<span id=\"price_68\">" . $price[0] . "</span> руб";
				?>
				<div class="number">x<input type="text" size="2" value="0" name="form_text_68" id="form_text_68"
											class="inputtext" onkeyup="init('68');" maxlength="4"/></div>
				<span class="price"><span id="stoim_68">0</span> руб</span>
			</div>
		</div>
		<div class="supply-org__block">
			<div class="supply-org__kind lunch">
				Обед
			</div>
			<div class="supply-org__descr">
				<?
				$res = CIBlockElement::GetByID("840");
				if ($obedvip = $res->GetNext())
					$name = htmlspecialcharsBack($obedvip['NAME']);
				?>
				<div class="supply-org__type"><?= $obedvip['NAME'] ?></div>
				<span><?= $obedvip['PREVIEW_TEXT']; ?></span>

			</div>
			<div class="supply-org__cost">
				<?
				$ar_res = CPrice::GetBasePrice("840");
				$price = explode('.',$ar_res["PRICE"]);
				echo "<span id=\"price_77\">" . $price[0] . "</span> руб";
				?>
				<div class="number">x<input type="text" size="2" value="0" name="form_text_77" id="form_text_77"
											class="inputtext" onkeyup="init('77');" maxlength="4"/></div>
				<span class="price"><span id="stoim_77">0</span> руб</span>
			</div>
		</div>
		<div class="supply-org__block">
			<div class="supply-org__kind dinner">
				Ужин
			</div>
			<div class="supply-org__descr">
				<?
				$res = CIBlockElement::GetByID("843");
				if ($obedvip = $res->GetNext())
					$name = htmlspecialcharsBack($obedvip['NAME']);
				?>
				<div class="supply-org__type"><?= $obedvip['NAME'] ?></div>
				<span><?= $obedvip['PREVIEW_TEXT']; ?></span>
			</div>
			<div class="supply-org__cost">
				<?
				$ar_res = CPrice::GetBasePrice("843");
				$price = explode('.',$ar_res["PRICE"]);
				echo "<span id=\"price_90\">" . $price[0] . "</span> руб";
				?>
				<div class="number">x<input type="text" size="2" value="0" name="form_text_90" id="form_text_90"
											class="inputtext" onkeyup="init('90');" maxlength="4"/></div>
				<span class="price"><span id="stoim_90">0</span> руб</span>
			</div>
		</div>
	</div>

	<div class="order-supply" id="order_settings">
		<div class="order-supply-wrap">
			<div class="order-supply__input">
				<div class="order-supply__input-title">    <?= $arResult["QUESTIONS"]["adresdost"]["CAPTION"] ?></div>
				<?= $arResult["QUESTIONS"]["adresdost"]["HTML_CODE"] ?>
			</div>

			<div class="order-supply__input">
				<div
					class="order-supply__input-title">        <?= $arResult["QUESTIONS"]["vremyadost"]["CAPTION"] ?></div>
				<div class="inputmedium"><?= $arResult["QUESTIONS"]["vremyadost"]["HTML_CODE"] ?></div>
			</div>

			<div class="order-supply__input">

			<div class="order-supply__input-title">
				<label	for="select"><?= $arResult["QUESTIONS"]["upak"]["CAPTION"] ?></label>
			</div>
				<?= $arResult["QUESTIONS"]["upak"]["HTML_CODE"] ?>
			</div>

			<div class="order-supply__input">
				<div class="order-supply__input-title"><?= $arResult["QUESTIONS"]["kolvodney"]["CAPTION"] ?></div>
				<div class="inputsmall"><?= $arResult["QUESTIONS"]["kolvodney"]["HTML_CODE"] ?></div>
			</div>

			<div class="order-supply__input">
				<div class="order-supply__name">
					<p>Контактное лицо</p>
					<?= $arResult["QUESTIONS"]["name"]["HTML_CODE"] ?>
				</div>
				<div class="order-supply__phone">
					<p>Телефон</p>
					<?= $arResult["QUESTIONS"]["phone"]["HTML_CODE"] ?>
				</div>
			</div>

		</div>
		<div class="message"></div>
		<div class="order-supply__buttons">

			<div class="all_price">Итого:
				<div id="all_stoim">0</div>
			</div>
			<input <?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?> type="submit" id="order_pit" name="web_form_submit" value="<?=GetMessage("FORM_SEND_FORM")?>" class="btn btn_red"/>
		</div>
	</div>

	<?
	if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y") {
		?>
		<tr>
			<td><?
				/***********************************************************************************
				 * form header
				 ***********************************************************************************/

				if ($arResult["isFormImage"] == "Y") {
					?>
					<a href="<?= $arResult["FORM_IMAGE"]["URL"] ?>" target="_blank"
					   alt="<?= GetMessage("FORM_ENLARGE") ?>"><img src="<?= $arResult["FORM_IMAGE"]["URL"] ?>"
																	<? if ($arResult["FORM_IMAGE"]["WIDTH"] > 300): ?>width="300"
																	<? elseif ($arResult["FORM_IMAGE"]["HEIGHT"] > 200): ?>height="200"<? else: ?><?= $arResult["FORM_IMAGE"]["ATTR"] ?><? endif;
						?> hspace="3" vscape="3" border="0"/></a>
					<? //=$arResult["FORM_IMAGE"]["HTML_CODE"]
					?>
					<?
				} //endif
				?>

			</td>
		</tr>
		<?
	} // endif
	?>
	</table>
	<br/>

	<?= $arResult["FORM_FOOTER"] ?>
	<script type="text/javascript">

		function init(id) {

			var price = document.getElementById('price_' + id);
			var kol = document.getElementById('form_text_' + id);
			var kolvodney = document.getElementById('kolvodney');
			price = document.getElementById('price_' + id).innerHTML;
			price = price - 0;
			kol = document.getElementById('form_text_' + id).value;
			kol = kol - 0;
			kolvodney = document.getElementById('kolvodney').value;
			kolvodney = kolvodney - 0;

			var stoim_in = document.getElementById('stoim_' + id);
			var stoim = price * kol * kolvodney;
			stoim_in.innerHTML = "" + stoim + "";

			var stoim68 = document.getElementById('stoim_68').innerHTML;
			var st68 = parseInt(stoim68);
			var stoim77 = document.getElementById('stoim_77').innerHTML;
			var st77 = parseInt(stoim77);
			var stoim90 = document.getElementById('stoim_90').innerHTML;
			var st90 = parseInt(stoim90);
			var full_stoim = st68 + st77+ st90;
			var all_stoim = document.getElementById('all_stoim');
			all_stoim.innerHTML = full_stoim;

			$( "#kolvodney" ).change(function() {
				kolvodney = document.getElementById('kolvodney').value;
				console.log(kolvodney);
				stoim_in = document.getElementById('stoim_' + id);
				stoim = price * kol * kolvodney;
				stoim_in.innerHTML = "" + stoim + "";
				
				var stoim68 = document.getElementById('stoim_68').innerHTML;
				var st68 = parseInt(stoim68);
				var stoim77 = document.getElementById('stoim_77').innerHTML;
				var st77 = parseInt(stoim77);
				var stoim90 = document.getElementById('stoim_90').innerHTML;
				var st90 = parseInt(stoim90);
				var full_stoim = st68 + st77+ st90;
				var all_stoim = document.getElementById('all_stoim');
				all_stoim.innerHTML = full_stoim;
			});

		}


	</script>
</noindex>