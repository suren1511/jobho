<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?><br />
<?endif;?>


<a name="nav_start"></a>
<center>

<table cellpadding="0" cellspacing="0" border="0" class="form-table">

        <?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
        <tr>  <th style="background:none;border:none;padding:0;" colspan="2">
      <div class="title_4" style="background:none;">
          <strong><?=$arElement["NAME"]?>         </strong> 
      </div>
  </th></tr>
        <tr><td style="width:20%;padding:10px;">Информация для менеджеров</td>
        <td valign="top" style="padding:10px;width:80%;">
        <?if(is_array($arElement["PREVIEW_PICTURE"])):?><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arElement["NAME"]?>" /></a><?endif?>
        <div style="text-align:justify"><?=$arElement["PREVIEW_TEXT"]?></div>
        <br />
        <?echo $arElement["DISPLAY_PROPERTIES"]["priemzakazov"]["NAME"].":&nbsp;<br />".$arElement["DISPLAY_PROPERTIES"]["priemzakazov"]["DISPLAY_VALUE"];?>

        </td>
        </tr>
<?
global $USER;
if ($USER)
    {
    $dbUser = CUser::GetByID($USER->GetID());
    $arUser = $dbUser->Fetch();
    $arrGroups = $USER->GetUserGroupArray();
    }

?>
<?if(in_array("1",$arrGroups) || in_array("10",$arrGroups)):?>
<tr><td style="width:20%;padding:10px;">Информация для дирекции</td><td colspan="2"  style="width:80%;padding:10px;"><?echo $arElement["DISPLAY_PROPERTIES"]["kontakti"]["NAME"].":&nbsp;".$arElement["DISPLAY_PROPERTIES"]["kontakti"]["DISPLAY_VALUE"]."<br />";?></td></tr>
<?endif;?>
<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>



</table>
</center>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
