<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки");
?>                    <div class="vertical-form">
                        <form action="#">
                            <div class="form-groups">
                                <div class="form-group">
                                    <label for="i1">Название компании</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i1" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i2">ИНН</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i2" value="">
                                    </div>
                                </div>
                                <div class="form-group align-top">
                                    <label for="i3">Описание компании</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="i3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i4">Контактное лицо</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i4" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i5">Телефон</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i5" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i6">E-mail</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i6" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i7">Сайт компании</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" id="i7" value="">
                                    </div>
                                </div>
                            </div>

                            <p><strong>Уведомления</strong></p>
                            <div class="form-groups">
                                <div class="form-group">
                                    <div class="form-group-mini">
                                        <input type="checkbox" class="styled" id="i41" value="before" name="salary41">
                                        <label for="i41">Новые отклики на вакансии</label>
                                    </div>
                                    <div class="form-group-mini">
                                        <input type="checkbox" class="styled" id="i42" value="after" name="salary42">
                                        <label for="i42">Новые сообщения от соискателей</label>
                                    </div>
                                </div>
                            </div>

                            <h2>Пароль</h2>
                            <div class="form-groups">
                                <div class="form-group">
                                    <label for="i11">Старый пароль</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="i11" value="" name="password-old">
                                    </div>
                                    <div class="input-group-append">
                                        <p>Пароль может содержать только цифры и/или английские буквы</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="i12">Новый пароль</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="i12" value="" name="password-new">
                                    </div>
                                </div>
                                <div class="form-group align-top">
                                    <label for="i13">Повторите пароль</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="i13" value="" name="password-new-again">
                                    </div>
                                </div>
                            </div>


                            <div class="form-bottom">
                                <input type="submit" class="btn btn--red" value="Сохранить изменения">
                            </div>


                        </form>
                    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>