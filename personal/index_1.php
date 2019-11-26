<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел"); ?>
<?
if(!$USER->IsAuthorized())
{
    LocalRedirect('/auth/');
}
else {
    $strGroups = CUser::GetUserGroupArray();
    if (in_array(12, $strGroups)): //соискатели ?>


            <div class="vacancy__filter">
                <div class="select">
                    <select name="sort1" id="s1">
                        <option value="">по убыванию зп</option>
                    </select>
                </div>
                <div class="select">
                    <select name="sort2" id="s2">
                        <option value="">За месяц</option>
                    </select>
                </div>
            </div>


            <div class="vacancy_list">
                <div class="vacancy__item">
                    <div class="vacancy__item-head">
                        <div class="vacancy__item-name">
                            <a href="#">Менеджер по персоналу</a>
                        </div>
                        <div class="vacancy__item-salary">40 000-40 000 руб.</div>
                    </div>
                    <div class="vacancy__item-type">
                        <a href="#">ООО Эволюшн Менеджент</a>
                    </div>
                    <div class="vacancy__item-address">Нижний Новгород</div>
                    <div class="vacancy__item-text">
                        <p>Рекрутинг — ключевая задача. Самостоятельный подбор персонала, проведение собеседований, закрытие новых вакансий от стажеров до специалистов уровня среднего менеджмента.
                            Опыт работы в найме персонала более 1 года.</p>
                    </div>
                    <div class="vacancy__item-bottom align-right">
                        <div class="vacancy__item-actions">
                            <div class="vacancy__item-open"><a href="#">Откликнуться</a></div>
                            <div class="vacancy__item-open"><a href="#">Не показывать</a></div>
                            <div class="vacancy__item-open"><a href="#">В избранное</a></div>
                        </div>
                        <div class="vacancy__item-date"><time>16.06.2018</time></div>
                        <div class="vacancy__item-warning">
                            <a href="#popup-block1" class="show-current-popup"><i class="icon icon-warning"></i></a>
                            <div class="current-popup" id="popup-block1">
                                <div class="current-popup__back">
                                    <a href="#" class="close-current-popup"></a>
                                    <div class="vertical-form">
                                        <form action="#">
                                            <div class="form-groups">
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i213" value="before" name="salary2">
                                                    <label for="i213">Реклама в резюме</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i223" value="after" name="salary2">
                                                    <label for="i223">Отклик содержит бессмысленную информацию</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i233" value="after" name="salary2">
                                                    <label for="i233">Другое</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="qq"></textarea>
                                            </div>
                                            <div class="form-bottom">
                                                <input type="checkbox" id="popup-hide3" class="styled" name="hide" value="1">
                                                <label for="popup-hide3">Не показывать</label>
                                                <input type="submit" class="btn btn--blue" value="Отправить">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="vacancy__item">
                    <div class="vacancy__item-head">
                        <div class="vacancy__item-name">
                            <a href="#">Менеджер по персоналу</a>
                        </div>
                        <div class="vacancy__item-salary">40 000-40 000 руб.</div>
                    </div>
                    <div class="vacancy__item-type">
                        <a href="#">ООО Эволюшн Менеджент</a>
                    </div>
                    <div class="vacancy__item-address">Нижний Новгород</div>
                    <div class="vacancy__item-text">
                        <p>Рекрутинг — ключевая задача. Самостоятельный подбор персонала, проведение собеседований, закрытие новых вакансий от стажеров до специалистов уровня среднего менеджмента.
                            Опыт работы в найме персонала более 1 года.</p>
                    </div>
                    <div class="vacancy__item-bottom align-right">
                        <div class="vacancy__item-actions">
                            <div class="vacancy__item-open"><a href="#">Откликнуться</a></div>
                            <div class="vacancy__item-open"><a href="#">Не показывать</a></div>
                            <div class="vacancy__item-open"><a href="#">В избранное</a></div>
                        </div>
                        <div class="vacancy__item-date"><time>16.06.2018</time></div>
                        <div class="vacancy__item-warning">
                            <a href="#popup-block2" class="show-current-popup"><i class="icon icon-warning"></i></a>
                            <div class="current-popup" id="popup-block2">
                                <div class="current-popup__back">
                                    <a href="#" class="close-current-popup"></a>
                                    <div class="vertical-form">
                                        <form action="#">
                                            <div class="form-groups">
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i213" value="before" name="salary2">
                                                    <label for="i213">Реклама в резюме</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i223" value="after" name="salary2">
                                                    <label for="i223">Отклик содержит бессмысленную информацию</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i233" value="after" name="salary2">
                                                    <label for="i233">Другое</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="qq"></textarea>
                                            </div>
                                            <div class="form-bottom">
                                                <input type="checkbox" id="popup-hide3" class="styled" name="hide" value="1">
                                                <label for="popup-hide3">Не показывать</label>
                                                <input type="submit" class="btn btn--blue" value="Отправить">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="vacancy__item">
                    <div class="vacancy__item-head">
                        <div class="vacancy__item-name">
                            <a href="#">Менеджер по персоналу</a>
                        </div>
                        <div class="vacancy__item-salary">40 000-40 000 руб.</div>
                    </div>
                    <div class="vacancy__item-type">
                        <a href="#">ООО Эволюшн Менеджент</a>
                    </div>
                    <div class="vacancy__item-address">Нижний Новгород</div>
                    <div class="vacancy__item-text">
                        <p>Рекрутинг — ключевая задача. Самостоятельный подбор персонала, проведение собеседований, закрытие новых вакансий от стажеров до специалистов уровня среднего менеджмента.
                            Опыт работы в найме персонала более 1 года.</p>
                    </div>
                    <div class="vacancy__item-bottom align-right">
                        <div class="vacancy__item-actions">
                            <div class="vacancy__item-open"><a href="#">Откликнуться</a></div>
                            <div class="vacancy__item-open"><a href="#">Не показывать</a></div>
                            <div class="vacancy__item-open"><a href="#">В избранное</a></div>
                        </div>
                        <div class="vacancy__item-date"><time>16.06.2018</time></div>
                        <div class="vacancy__item-warning">
                            <a href="#popup-block3" class="show-current-popup"><i class="icon icon-warning"></i></a>
                            <div class="current-popup" id="popup-block3">
                                <div class="current-popup__back">
                                    <a href="#" class="close-current-popup"></a>
                                    <div class="vertical-form">
                                        <form action="#">
                                            <div class="form-groups">
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i213" value="before" name="salary2">
                                                    <label for="i213">Реклама в резюме</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i223" value="after" name="salary2">
                                                    <label for="i223">Отклик содержит бессмысленную информацию</label>
                                                </div>
                                                <div class="form-group">
                                                    <input type="radio" class="styled" id="i233" value="after" name="salary2">
                                                    <label for="i233">Другое</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="qq"></textarea>
                                            </div>
                                            <div class="form-bottom">
                                                <input type="checkbox" id="popup-hide3" class="styled" name="hide" value="1">
                                                <label for="popup-hide3">Не показывать</label>
                                                <input type="submit" class="btn btn--blue" value="Отправить">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-bottom">
                <a href="#" class="btn btn--red">Назад</a>
                <a href="#" class="btn btn--blue">Далее</a>
            </div>
    <? endif;
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>