<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказать звонок");
?>


  <div class="vertical-form">
    <form action="#">
      <p><strong>Выберите типa звонка</strong></p>
      <div class="form-groups">
        <div class="form-group">
          <div class="form-group-mini col-4">
            <input id="cb1" type="checkbox" class="styled align-top">
            <label for="cb1"><b>Техподдержка.</b><span>Вопросы и консультации по работе с сайтом, техническая поддержка и предложения по улучшению сайта и сервисов</span></label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-group-mini col-4">
            <input id="cb2" type="checkbox" class="styled align-top">
            <label for="cb2"><b>Консультация по ценам.</b><span>Вопросы по подбору услуг и сервисов.</span></label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-group-mini col-4">
            <input id="cb3" type="checkbox" class="styled align-top">
            <label for="cb3"><b>Бухгалтерские документы.</b><span>Вопросы по подбору услуг и сервисов.</span></label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-group-mini col-4">
            <input id="cb4" type="checkbox" class="styled">
            <label for="cb4"><b>Другая тема звонка.</b></label>
          </div>
        </div>
        <div class="form-group">
          <label for="i1">Телефон</label>
          <div class="input-group">
            <input class="form-control" type="text" id="i1" value="">
          </div>
        </div>

        <div class="form-group">
          <label for="i2">Дата звонка</label>
          <div class="input-group">
            <div class="flex-row">
              <div class="col-2">
                <input class="form-control" type="text" id="i2" value="">
              </div>
              <div class="col-2">
                <label for="i21">Время для звонка (МСК)</label>
              </div>
              <div class="col-2">
                <input class="form-control" type="text" id="i21" value="">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group align-top">
          <label for="i3">Комментарий</label>
          <div class="input-group">
            <textarea class="form-control" id="i3"></textarea>
          </div>
        </div>

      </div>

      <div class="form-bottom">
        <input type="submit" class="btn btn--red" value="Заказать звонок">
      </div>
    </form>
  </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>