<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)){?>
  <div class="personal-menu">
  <ul class="onelevel">

  <?
  $previousLevel = 0;
foreach($arResult as $arItem){?>

  <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel){?>
    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
  <? }?>
  <? if ($arItem["IS_PARENT"]){?>
  <? if ($arItem["DEPTH_LEVEL"] == 1){?>
    <li><span class="submenu-link">
        <a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
      <span class="left-menu__link__arr js-left-menu-arr"></span>
      </span>
      <ul class="twolevel">
  <? }else{?>
  <li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><?=$arItem["TEXT"]?></a>
  <>
  <? }?>
  <? }else{?>

    <? if ($arItem["PERMISSION"] > "D"){?>

      <?if ($arItem["DEPTH_LEVEL"] == 1):?>
        <li><span class="submenu-link"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a><span class="left-menu__link__arr js-left-menu-arr"></span></span></li>
      <?else:?>
        <li><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
      <?endif?>

    <? }else{?>

      <? if ($arItem["DEPTH_LEVEL"] == 1){?>
    <li><span class="submenu-link"><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a><span class="left-menu__link__arr js-left-menu-arr"></span></span></li>
      <? }else{?>
        <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
      <? }?>

    <? }?>

  <? }?>
  <? $previousLevel = $arItem["DEPTH_LEVEL"];?>
<? }?>
  <? if ($previousLevel > 1){//close last item tags?>
    <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
  <? }?>

  </ul>
  </div>

<? }?>