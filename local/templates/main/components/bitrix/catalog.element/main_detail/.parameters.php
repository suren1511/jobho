<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 */

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock'))
	return;

CBitrixComponent::includeComponentClass($componentName);

$defaultValue = array('-' => GetMessage('CP_BCE_TPL_PROP_EMPTY'));

$arFilePropList = $defaultValue;

if (isset($arCurrentValues['IBLOCK_ID']) && intval($arCurrentValues['IBLOCK_ID']) > 0)
{
	$rsProps = CIBlockProperty::GetList(
		array('SORT' => 'ASC', 'ID' => 'ASC'),
		array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y')
	);
	while ($arProp = $rsProps->Fetch())
	{
		$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];
		if ($arProp['PROPERTY_TYPE'] === 'F')
		{
			$arFilePropList[$arProp['CODE']] = $strPropName;
		}
	}

	$arTemplateParameters['ADD_PICT_PROP'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_ADD_PICT_PROP'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'ADDITIONAL_VALUES' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => '-',
		'VALUES' => $arFilePropList
	);
}

$arTemplateParameters['SHOW_SLIDER'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_SHOW_SLIDER'),
	'TYPE' => 'CHECKBOX',
	'MULTIPLE' => 'N',
	'REFRESH' => 'Y',
	'DEFAULT' => 'N'
);

if (isset($arCurrentValues['SHOW_SLIDER']) && $arCurrentValues['SHOW_SLIDER'] === 'Y')
{
	$arTemplateParameters['SLIDER_INTERVAL'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_SLIDER_INTERVAL'),
		'TYPE' => 'TEXT',
		'MULTIPLE' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => '5000'
	);
	$arTemplateParameters['SLIDER_PROGRESS'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BCE_TPL_SLIDER_PROGRESS'),
		'TYPE' => 'CHECKBOX',
		'MULTIPLE' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => 'N'
	);
}

$arTemplateParameters['DETAIL_PICTURE_MODE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_DETAIL_PICTURE_MODE'),
	'TYPE' => 'LIST',
	'MULTIPLE' => 'Y',
	'DEFAULT' => array('POPUP', 'MAGNIFIER'),
	'VALUES' => array(
		'POPUP' => GetMessage('DETAIL_PICTURE_MODE_POPUP'),
		'MAGNIFIER' => GetMessage('DETAIL_PICTURE_MODE_MAGNIFIER')
	)
);
$arTemplateParameters['ADD_DETAIL_TO_SLIDER'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_ADD_DETAIL_TO_SLIDER'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N'
);
$arTemplateParameters['SHOW_PREVIEW_PICTURE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BCE_TPL_SHOW_PREVIEW_PICTURE'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N'
);

