<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История пополнений");
?>

  <div class="pa__block">
    <div class="pa__navi">
      <ul>
        <li><a href="/personal/billing/">Средства на счете</a></li>
        <li  class="active"><a href="/personal/billing/istoriya-popolneniy.php">История пополнения</a></li>
        <li><a href="/personal/billing/istoriya-raskhodov.php">История расходов</a></li>
      </ul>
    </div>
    <div class="pa__content">
      <div class="pa__balance">
        <?
CModule::IncludeModule("sale");
$res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => $USER->GetID()));

        ?>
        <table>
          <thead>
          <tr>
            <th>Дата</th>
            <th>Поступило</th>
            <th>Услуга</th>
          </tr>
          </thead>
          <tbody>
          <?
          while ($arFields = $res->Fetch())
          {
            if ($arFields['AMOUNT']>0 && $arFields['DEBIT'] == 'Y') {
              ?>
              <tr>
                <td><?= $arFields['TRANSACT_DATE'] ?></td>
                <td><?= number_format($arFields['AMOUNT'], 0, ',', ' ') ?> руб.</td>
                <td><?= $arFields['NOTES'] ?></td>
              </tr>

              <?
            }
            
          }
          ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>