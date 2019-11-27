<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
$CURRENT_DIR=$APPLICATION->GetCurDir();
$arCurDir = explode('/', $CURRENT_DIR);
$strGroups = CUser::GetUserGroupArray();
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="theme-color" content="#0072c6">
    <title><? $APPLICATION->ShowTitle() ?></title>

    <!-- Place favicon.ico in the root directory -->
    <?

    use \Bitrix\Main\Page\Asset;

    $asset = Asset::getInstance();

    $asset->addCss(SITE_TEMPLATE_PATH . '/css/reset.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/normalize.css');

    // if($APPLICATION->GetCurPage() == "/") {
    $asset->addCss(SITE_TEMPLATE_PATH . '/js/vendor/slick-slider/slick.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/js/vendor/slick-slider/slick-theme.css');
    // }
    // $asset->addCss(SITE_TEMPLATE_PATH.'/js/vendor/fancybox/jquery.fancybox.min.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/typography.css');

    $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery-1.8.2.min.js');
    // if($APPLICATION->GetCurPage() == "/") {
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/vendor/slick-slider/slick.min.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/amt.js',true);
    // }
    // $asset->addJs(SITE_TEMPLATE_PATH.'/js/vendor/fancybox/jquery.fancybox.min.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/main.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/app.js');
    $asset->addJs(SITE_TEMPLATE_PATH . '/js/custom.js');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/custom.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/assets/css/personal.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/personal.menu.css');
    $asset->addCss(SITE_TEMPLATE_PATH . '/css/personal.css');
    ?>
    <?
    $canonical = $_SERVER["REQUEST_URI"];
    $canonical = explode('?', $canonical);
    $canonical = $canonical[0];
    ?>
    <link rel="canonical" href="https://jobhostel.ru<?= $canonical ?>">
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<?
$page = $APPLICATION->GetCurPage();
$leftColumn = $APPLICATION->GetProperty("no_left_col");
?>

<div class="wrapper">
    <header class="header-wrap js-header">
        <div class="site-width">
            <div class="header">
                <div class="header__logo">
                    <? if ($page != '/') { ?><a href="/"><? } ?>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "/includes/header-logo.php",
                                "EDIT_TEMPLATE" => "",
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => "/includes/header-logo.php"
                            ),
                            false
                        ); ?>
                        <? if ($page != '/') { ?></a><? } ?>
                </div>

                <div class="header__content">
                    <div class="header__call">
                        <a onclick="ga('send', 'event', 'Заказать обратный звонок', 'клик'); yaCounter21524935.reachGoal('PEREZVONIT1'); return true;"
                           href="javascript:void(0)" class="btn btn--red request-call-phone">Заказать обратный
                            звонок</a>

                        <span class="header__phone">
									<? $APPLICATION->IncludeComponent(
                                        "alma:phone.change",
                                        "",
                                        Array(
                                            "PHONE_MOSCOW" => "+7 (495) 215-10-53",
                                            "PHONE_PITER" => "+7 (812) 643-21-38",
                                            "USE_GOAL_PHONE" => "Y",
                                            "TARGET_CALL_NUMBER_CLASS" => "Y"
                                        )
                                    ); ?>
								</span>
                    </div>

                    <div class="header__menu">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top-menu",
                            Array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "top",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(""),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "top",
                                "USE_EXT" => "N"
                            )
                        ); ?>
                    </div>
                    <!--                            <div class="login">-->
                    <!--                               --><? //$APPLICATION->IncludeComponent(
                    //                                "bitrix:system.auth.form",
                    //                                "cabinet",
                    //                                Array(
                    //                                "REGISTER_URL" => SITE_DIR."auth/registration/",
                    //                                "PROFILE_URL" => SITE_DIR."auth/forgot-password/",
                    //                                "SHOW_ERRORS" => "Y"
                    //                                )
                    //                                );
                    //                               ?>
                    <!--                            </div>-->
                </div>

                <div class="header__menu-toggle">
                    <div class="menu-toggle js-menu-open"><span></span></div>
                </div>
            </div>
        </div>
    </header>

    <? if (($page == '/') || ($leftColumn == 'Y')) { ?>
        <div class="left-mobile-menu left-mobile-menu--main js-left-mobile-menu">
            <div class="menu-toggle menu-toggle--black js-menu-close"><span></span></div>

            <? $APPLICATION->IncludeComponent("bitrix:menu", "left-menu", Array(
                "ROOT_MENU_TYPE" => "left",    // Тип меню для первого уровня
                "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                "MAX_LEVEL" => "2",    // Уровень вложенности меню
                "CHILD_MENU_TYPE" => "podmenu",    // Тип меню для остальных уровней
                "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                "DELAY" => "N",    // Откладывать выполнение шаблона меню
                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                "COMPONENT_TEMPLATE" => "left-menu"
            ),
                false
            ); ?>

            <a href="/obschezhitie-tsenyi/" class="btn btn--red">Цены на общежития</a>
            <a href="/best_deals/" class="btn btn--blue best-deals">Лучшие предложения</a>
            <a class="btn dobob"
               onclick="ga('send', 'event', 'Разместить_общежитие', 'клик'); yaCounter21524935.reachGoal('RAZMOB'); return true;">Разместить
                общежитие</a>
        </div>
    <? } ?>

    <main class="js-main">
        <div class="site-width">
            <div class="main-wrap">
                <? if (($page == '/') || ($leftColumn == 'Y')) { ?>
                <div class="page-content-full">
                    <? }else{ ?>
                    <div class="left-column">
                        <div class="left-mobile-menu js-left-mobile-menu">
                            <div class="menu-toggle menu-toggle--black js-menu-close"><span></span></div>
                            <? $APPLICATION->IncludeComponent("bitrix:menu", "left-menu", Array(
                                "ROOT_MENU_TYPE" => "mainleft",    // Тип меню для первого уровня
                                "MENU_CACHE_TYPE" => "A",    // Тип кеширования
                                "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                                "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                                "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                                "MAX_LEVEL" => "2",    // Уровень вложенности меню
                                "CHILD_MENU_TYPE" => "podmenu",    // Тип меню для остальных уровней
                                "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                                "DELAY" => "N",    // Откладывать выполнение шаблона меню
                                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                                "COMPONENT_TEMPLATE" => "left-menu"
                            ),
                                false
                            ); ?>

                            <a href="/obschezhitie-tsenyi/" class="btn btn--red">Цены на общежития</a>
                            <a href="/best_deals/" class="btn btn--blue best-deals">Лучшие предложения</a>
                            <a class="btn dobob"
                               onclick="ga('send', 'event', 'Разместить_общежитие', 'клик'); yaCounter21524935.reachGoal('RAZMOB'); return true;">Разместить
                                общежитие</a>

                        </div>

                        <div class="left-offers">
                            <div class="left-offers__head">
                                <? if ($page != '/best_deals/'){ ?><a href="/best_deals/"><? } ?>
                                    Лучшие предложения</a>
                                <? if ($page != '/best_deals/'){ ?></a><? } ?>
                            </div>

                            <? global $gorpredlfiltr;
                            if (!$gorpredlfiltr) {
                                $gorpredlfiltr = array("ACTIVE" => "Y", "!PROPERTY_gorpredl" => "~'0'");
                            } ?>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                "left-offers",
                                array(
                                    "IBLOCK_TYPE" => "xmlcatalog",
                                    "IBLOCK_ID" => "3",
                                    "SECTION_ID" => "",
                                    "SECTION_CODE" => "",
                                    "SECTION_USER_FIELDS" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "ELEMENT_SORT_FIELD" => "PROPERTY_gorpredl",
                                    "ELEMENT_SORT_ORDER" => "desc",
                                    "FILTER_NAME" => "gorpredlfiltr",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "SHOW_ALL_WO_SECTION" => "Y",
                                    "PAGE_ELEMENT_COUNT" => "10",
                                    "LINE_ELEMENT_COUNT" => "3",
                                    "PROPERTY_CODE" => array(
                                        0 => "gragdanstvo",
                                        1 => "metro",
                                        2 => "mskokruga",
                                        3 => "ulica",
                                        4 => "napr",
                                        5 => "gorpredl",
                                        6 => "",
                                    ),
                                    "SECTION_URL" => "",
                                    "DETAIL_URL" => "",
                                    "BASKET_URL" => "/personal/basket.php",
                                    "ACTION_VARIABLE" => "action",
                                    "PRODUCT_ID_VARIABLE" => "id",
                                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                    "PRODUCT_PROPS_VARIABLE" => "prop",
                                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "CACHE_GROUPS" => "N",
                                    "META_KEYWORDS" => "-",
                                    "META_DESCRIPTION" => "-",
                                    "BROWSER_TITLE" => "-",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "DISPLAY_COMPARE" => "N",
                                    "SET_TITLE" => "N",
                                    "SET_STATUS_404" => "Y",
                                    "CACHE_FILTER" => "N",
                                    "PRICE_CODE" => array(
                                        0 => "BASE",
                                    ),
                                    "USE_PRICE_COUNT" => "N",
                                    "SHOW_PRICE_COUNT" => "1",
                                    "PRICE_VAT_INCLUDE" => "Y",
                                    "PRODUCT_PROPERTIES" => array(
                                        0 => "metro",
                                    ),
                                    "USE_PRODUCT_QUANTITY" => "N",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "PAGER_TITLE" => "Товары",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => "",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "Y",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "COMPONENT_TEMPLATE" => "left-offers",
                                    "ELEMENT_SORT_FIELD2" => "id",
                                    "ELEMENT_SORT_ORDER2" => "desc",
                                    "HIDE_NOT_AVAILABLE" => "N",
                                    "OFFERS_LIMIT" => "5",
                                    "SET_BROWSER_TITLE" => "Y",
                                    "SET_META_KEYWORDS" => "Y",
                                    "SET_META_DESCRIPTION" => "Y",
                                    "CONVERT_CURRENCY" => "N",
                                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                    "CUSTOM_FILTER" => "",
                                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                    "BACKGROUND_IMAGE" => "-",
                                    "SEF_MODE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "USE_MAIN_ELEMENT_SECTION" => "N",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "SHOW_404" => "Y",
                                    "MESSAGE_404" => "",
                                    "COMPATIBLE_MODE" => "Y",
                                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                    "FILE_404" => ""
                                ),
                                false
                            ); ?>


                            <a class="btn btn--red dobob"
                               onclick="ga('send', 'event', 'Разместить_общежитие', 'клик');">Разместить общежитие</a>


                        </div>

                        <div class="left-news">
                            <div class="left-news__head">
                                <a <? if ($_SERVER['REQUEST_URI'] != '/news/'): ?>href="/news/"<? endif; ?>>Новости</a>
                            </div>

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "left-news",
                                array(
                                    "IBLOCK_TYPE" => "stateynie_katalogi",
                                    "IBLOCK_ID" => "8",
                                    "NEWS_COUNT" => "4",
                                    "SORT_BY1" => "ACTIVE_FROM",
                                    "SORT_ORDER1" => "DESC",
                                    "SORT_BY2" => "SORT",
                                    "SORT_ORDER2" => "ASC",
                                    "FILTER_NAME" => "",
                                    "FIELD_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "PROPERTY_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_URL" => "",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "CACHE_TYPE" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "N",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "SET_TITLE" => "N",
                                    "SET_STATUS_404" => "Y",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "Y",
                                    "PAGER_TITLE" => "Новости",
                                    "PAGER_SHOW_ALWAYS" => "Y",
                                    "PAGER_TEMPLATE" => "",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "Y",
                                    "DISPLAY_DATE" => "Y",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "Y",
                                    "DISPLAY_PREVIEW_TEXT" => "Y",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "COMPONENT_TEMPLATE" => "left-news",
                                    "SET_BROWSER_TITLE" => "Y",
                                    "SET_META_KEYWORDS" => "Y",
                                    "SET_META_DESCRIPTION" => "Y",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "SET_LAST_MODIFIED" => "N",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "SHOW_404" => "Y",
                                    "MESSAGE_404" => "",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "FILE_404" => ""
                                ),
                                false
                            ); ?>

                            <div style="width: 199px; background: none repeat scroll 0% 0% rgb(255, 255, 255); height: 7px;"></div>
                            <div class="leftmenu-bottom dbl">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "left-menu",
                                    array(
                                        "ROOT_MENU_TYPE" => "mainleft_bottom",
                                        "MENU_CACHE_TYPE" => "A",
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_CACHE_GET_VARS" => array(),
                                        "MAX_LEVEL" => "2",
                                        "CHILD_MENU_TYPE" => "podmenu_bottom",
                                        "USE_EXT" => "N",
                                        "DELAY" => "N",
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "COMPONENT_TEMPLATE" => "left-menu"
                                    ),
                                    false
                                );
                                ?>

                            </div>

                        </div>
                    </div>

                    <div class="page-content">
                      <? if ($arCurDir[1] != 'personal'){?>
                        <div class="breadcrumb">
                            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array(
                                "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                                "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                                "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                                "COMPONENT_TEMPLATE" => ".default"
                            ),
                                false
                            ); ?>
                        </div>
                        <? if (!$USER->IsAuthorized() && ($APPLICATION->GetCurPage() == '/personal/' || $APPLICATION->GetCurPage() == '/auth/registration/')) {
                          define('NOT_SHOW_H1', 'Y');
                        } ?>

                        <? if (!defined("NOT_SHOW_H1") && NOT_SHOW_H1 != 'Y'): ?>
                          <h1><?= $APPLICATION->ShowTitle(false); ?></h1>
                        <? endif; ?>
                        <?}
                        else{
                          ?>
                          <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personsl", 
	array(
		"COMPONENT_TEMPLATE" => "personsl",
		"ROOT_MENU_TYPE" => "personal",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
                          <div class="b-personal-header">
                            <h1><?= $APPLICATION->ShowTitle(false); ?></h1>
                          </div>
                          <?
                        }
                        ?>



                        <? } ?>

