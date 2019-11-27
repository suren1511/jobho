<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<div class="news-list">
	<? foreach ($arResult["SECTIONS"] as $arSection) { ?>
		<div class="news-list__title">
			<a  href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["NAME"] ?></a>
		</div>
		<? if (CModule::IncludeModule("iblock"))
			$arFilter = Array("IBLOCK_ID" => $arResult['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "SECTION_ID" => $arSection["ID"], "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array("active_from" => "desc"), $arFilter, false, Array("nTopCount" => 5), Array());
		while ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields(); ?>

			<div class="news">
				<div class="news__date"> <?= $arFields["DATE_ACTIVE_FROM"] ?> </div>
				<div class="news__name"><a href="<?= $arFields["DETAIL_PAGE_URL"] ?>"><?= $arFields["NAME"] ?></a></div>
			</div>
		<? } ?>
		<div class="line"></div>
	<? } ?>

</div>