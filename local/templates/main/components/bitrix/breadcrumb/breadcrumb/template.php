<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

$strReturn .= '<div class="bx-breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	//$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	//$child = ($index > 0? ' itemprop="child"' : '');
	$arrow = ($index > 0? '<font class="fa fa-angle-double-right"></font>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<div class="bx-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"'.'>
				'.$arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
					<span itemprop="name">'.$title.'</span>
					<meta itemprop="position" content="'.$index.'">
				</a>
			</div>';
	}
	else
	{
		$strReturn .= '
			<div class="bx-breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
              <a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
                    '.$arrow.'
                    <span itemprop="name">'.$title.'</span>
                    <meta itemprop="position" content="'.$index.'">
			    </a>
			</div>';
	}
}

$strReturn .= '<div style="clear:both"></div></div>';

return $strReturn;