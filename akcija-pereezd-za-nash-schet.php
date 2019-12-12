<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Переезд в Общежитие для рабочих за наш счёт! | Агрегатор общежитий ДжобХостел");
$APPLICATION->SetTitle("Переезд в Общежитие для рабочих за наш счёт!");
$APPLICATION->SetPageProperty("description", "Компания ДжобХостел проводит акцию среди своих старых и новых клиентов. Переезд за наш счет в любое общежитие Москвы! +7(495)646-83-43");
?><p>
	 Компания «ДжобХостел» проводит супер-акцию для своих Клиентов! При заселении от 30 человек, со сроком проживания не менее одного месяца, в любое общежитие Московского региона размещённое на сайте,&nbsp;мы за свой счет перевезем Ваших сотрудников из любой точки Москвы или МО!
</p>
<p>
 <img src="/local/templates/main/img/avt.jpg" style="margin: 0px auto 0px 122px;">
</p>
<h3 style="margin-bottom: 17px; font-size: 23px; color: #548dd4;">Что нужно для участия в Акции?</h3>
<p>
	 1. <b><a href="https://jobhostel.ru/hostel_in_msc/">Выбрать и забронировать, любое общежитие, представленное на нашем сайте.</a></b>
</p>
<p>
 <br>
</p>
<p>
	 2. Заключить договор на проживание и оплатить выставленный счет.<br>
 <br>
	 3. Сообщить нам, куда и в какое время подать автобус!
</p>
<p>
</p>
<h3 style="margin-bottom: 17px; font-size: 24px; color: #548dd4;">ЗВОНИТЕ <?$APPLICATION->IncludeComponent(
	"alma:phone.change",
	"",
	Array(
		"PHONE_MOSCOW" => "+7 (495) 215-10-53",
		"PHONE_PITER" => "+7 (812) 643-21-38",
		"TARGET_CALL_NUMBER_CLASS" => "Y",
		"USE_GOAL_PHONE" => "N"
	)
);?> </h3>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>