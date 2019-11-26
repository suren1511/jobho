<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Личный кабинет");

	if(!$USER->IsAuthorized())
	{
        LocalRedirect(SITE_DIR.'personal/');
	}
	elseif(!empty( $_REQUEST["backurl"] )) {
		LocalRedirect( $_REQUEST["backurl"] );
	} else {
        $strGroups = CUser::GetUserGroupArray();

        if (in_array(10, $strGroups) || in_array(11, $strGroups))
            LocalRedirect(SITE_DIR.'personal/applicant/');

        $APPLICATION->SetAdditionalCss(SITE_TEMPLATE_PATH."/css/personal.menu.css");

		?>
		<div class="personal-menu">
			<ul class="onelevel">
				<li>
					<span class="submenu-link">Вакансии<span class="left-menu__link__arr js-left-menu-arr"></span></span>
                    <ul class="twolevel">
                        <li><a href="/personal/vacancy/new_vacancy.php">Создать новую вакансию</a></li>
                        <li><a href="#">Мои вакансии</a></li>
                        <li><a href="#">Шаблоны вакансий</a></li>
                        <li><a href="#">Архив вакансий</a></li>
                    </ul>
				</li>
				<li>
					<span class="submenu-link">Резюме<span class="left-menu__link__arr js-left-menu-arr"></span></span>
					<ul class="twolevel">
						<li><a href="#">Входящие резюме</a></li>
						<li><a href="#">Избранные резюме</a></li>
					</ul>
				</li>
				<li>
					<span class="submenu-link">Настройки<span class="left-menu__link__arr js-left-menu-arr"></span></span>
					<ul class="twolevel">
						<li><a href="#">Основные</a></li>
						<li><a href="#">Пароль</a></li>
						<li><a href="#">Коллеги</a></li>
						<li><a href="#">Логотип</a></li>
						<li><a href="#">Шаблоны уведомлений</a></li>
					</ul>
				</li>
				<li>
					<span class="submenu-link"><?=(in_array(8, $strGroups)? "Мои объекты" : "Аренда жилья")?><span class="left-menu__link__arr js-left-menu-arr"></span></span>
					<ul class="twolevel">
						<li><a href="#"><?=(in_array(8, $strGroups)? "Разместить новый объект" : "Избранные объекты")?></a></li>
						<li><a href="#">Мои объекты</a></li>
					</ul>
				</li>
				<li>
					<span class="submenu-link">Помощь<span class="left-menu__link__arr js-left-menu-arr"></span></span>
					<ul class="twolevel">
						<li><a href="#">Тех.поддержка он-лайн</a></li>
						<li><a href="#">Вопросы и ответы</a></li>
						<li><a href="#">Заказать звонок</a></li>
						<li><a href="#">Контактные телефоны</a></li>
						<li><a href="#">Правила работы сайта</a></li>
					</ul>
				</li>
				<li>
					<span class="submenu-link">Мой счёт<span class="left-menu__link__arr js-left-menu-arr"></span></span>
					<ul class="twolevel">
						<li><a href="#">Состояние и история</a></li>
						<li><a href="#">Договор</a></li>
						<li><a href="#">Акты</a></li>
						<li><a href="#">Счета</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<?
	}

	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>