<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');

\CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
?>
<style>
    @font-face {
            font-family: 'FranklinGothicBookCondOSC';
            src: url('/local/templates/main/fonts/frangdc/frgbcosc-webfont.eot');
            src: url('/local/templates/main/fonts/frangdc/frgbcosc-webfont.eot?#iefix') format('embedded-opentype'),
                 url('/local/templates/main/fonts/frangdc/frgbcosc-webfont.ttf') format('truetype'),
                 url('/local/templates/main/fonts/frangdc/frgbcosc-webfont.svg#FranklinGothicBookCondOSC') format('svg');
            font-weight: normal;
            font-style: normal;

    }

    @font-face {
        font-family: 'FranklinGothicDemiCondC';
        src: url('/local/templates/main/fonts/frangdc/frangdc1-webfont.eot');
        src: url('/local/templates/main/fonts/frangdc/frangdc1-webfont.eot?#iefix') format('embedded-opentype'),
             url('/local/templates/main/fonts/frangdc/frangdc1-webfont.ttf') format('truetype'),
             url('/local/templates/main/fonts/frangdc/frangdc1-webfont.svg#FranklinGothicDemiCondC') format('svg');
        font-weight: normal;
        font-style: normal;

    }
</style>
<?$APPLICATION->SetTitle("404");
$APPLICATION->SetPageProperty("keywords", "Страница не найдена");
$APPLICATION->SetPageProperty("description", "Страница не найдена");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
        <meta name="robots" content="index, follow" />
        <meta name="keywords" content="Общежитие в Нахабино" />
        <meta name="description" content="Снять койко-место в общежитии  у метро  от , комфортные условия проживания, заселение в день обращения | ДжобХостел" />
        <link href="/local/templates/main/template_styles.css" type="text/css" rel="stylesheet" />
        <title> 404</title>
    </head>
    <body style="background: rgb(48,141,233);">
        <div class="error_404" align="center">
            <div class="logo">
              <a href="/">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="" width="105">
              </a>
            </div>
            <h1>Ошибка 404</h1>
            <div  class="tablo">
                <table>
                <tr>
                    <td colspan="3" class="text">
                    Вы попали на страницу которая устарела или была удалена, но Вы можете найти интересующую Вас информацию в других разделах нашего сайта:
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="/best_deals/" class="button">Общежития</a>
                    </td>
                    <td>
                        <a href="/podbor_personala/" class="button">Подбор персонала</a>
                    </td>
                    <td>
                        <a href="/organizaciya_pitaniya/" class="button">Питание</a>
                    </td>
                </tr>
                </table>
            </div>
        </div>
    </body>
</html>


<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');?>