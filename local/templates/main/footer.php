<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

						</div>
					</div>
				</div>
			</main>
			<footer class="footer-wrap js-footer">
				<div class="site-width">
					<div class="footer">
						<div class="footer__logo-wrap">
							<div class="footer__logo">
								<?if ($page != '/') {?><a href="/"><?}?>
								<?$APPLICATION->IncludeComponent(
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
								);?>
								<?if ($page != '/') {?></a><?}?>
							</div>

							<div class="footer__copyright">© 2009-<?=date("Y");?> JOBHOSTEL<span class="footer__copyright-rights"><br>Все права защищены</span></div>
						</div>

						<div class="footer__menu">
							<?$APPLICATION->IncludeComponent("bitrix:menu", "footer-menu", Array(
								"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
									"CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
									"DELAY" => "N",	// Откладывать выполнение шаблона меню
									"MAX_LEVEL" => "1",	// Уровень вложенности меню
									"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
									"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
									"MENU_CACHE_TYPE" => "A",	// Тип кеширования
									"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
									"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
									"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
									"COMPONENT_TEMPLATE" => ".default"
								),
								false
							);?>
						
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"footer-menu", 
								array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "left",
									"DELAY" => "N",
									"MAX_LEVEL" => "1",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"ROOT_MENU_TYPE" => "left",
									"USE_EXT" => "N",
									"COMPONENT_TEMPLATE" => "footer-menu"
								),
								false
							);?>
						</div>

						<div class="footer__call">
							<span class="footer__phone">
								<?$APPLICATION->IncludeComponent(
									"alma:phone.change",
									"",
									Array(
										"PHONE_MOSCOW" => "+7 (495) 215-10-53",
										"PHONE_PITER" => "+7 (812) 643-21-38",
										"USE_GOAL_PHONE" => "Y",
										"TARGET_CALL_NUMBER_CLASS" => "Y"
									)
								);?>
							</span>

							<a class="btn dobob" onclick="ga('send', 'event', 'Разместить_общежитие', 'клик'); yaCounter21524935.reachGoal('RAZMOB'); return true;">Разместить общежитие</a>
							<a class="btn request-call-phone" onclick="ga('send', 'event', 'Заказать  звонок', 'клик'); yaCounter21524935.reachGoal('PEREZVONIT1'); return true;">Заказать звонок</a>
                            <? if ($USER->IsAuthorized()): ?>
                                <div class="footer__auth"><a href="/personal/">Персональный раздел</a> / <a href="/?logout=yes">Выйти</a></div>
                            <? else: ?>
                                <div class="footer__auth"><a href="/personal/">Войти</a> / <a href="/auth/registration/">Зарегистрироваться</a></div>
                            <? endif; ?>
						</div>
					</div>
				</div>
			</footer>
			<div id="bx-request-call-phone"></div>
			<div id="bx-dobob"></div>
			<div id="bx-book-hostel"></div>
			<div id="bx-open-login"></div>
		</div>
	
		<?CUtil::InitJSCore(Array("ajax", "popup", "masked_input"));?>
		
		<?echo (\Bitrix\Main\Config\Option::get("present", "yandex_counter_code_".SITE_ID));?>
		<?echo (\Bitrix\Main\Config\Option::get("present", "google_counter_".SITE_ID));?>		

		
<script>
$(window).resize(function () {
	$.each($('.btn.btn_red.no-livequery'),function (key, object) {
		if(key > 0) {
			$(object).remove();
		}
	});
	if(window.location.pathname === '/') {
		if($(window).width() < 1000) {
			$('.btn.btn_red.no-livequery').show();	
		} else {
			$('.btn.btn_red.no-livequery').hide();	
		}
	}		
});
</script>  

<script>
	window.onload = function() {

		$(".ya-phone").each(
		  function()
		  {
			
			if ($(this).closest("a").length > 0 ) {
				$tel_a = $(this).closest("a").attr('href').replace(/[^+0-9]/g,'');
			}
			else {
				$tel_span = $(this).text().replace(/[^+0-9]/g,'');
			    $(this).closest("a").attr("href", 'tel:'+$tel_span);
			}
		  }
		);
	};
</script>
<script async data-skip-moving="true">
       (function(w,d,u){
              var s=d.createElement('script');s.async=1;s.src=u+'?'+(Date.now()/60000|0);
              var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
      })(window,document,'https://cdn.bitrix24.ru/b21783/crm/site_button/loader_2_3mufxl.js');
</script>

<!-- calltouch code -->
<script async>
(function (w, d, nv, ls, yac){
    var lwait = function (w, on, trf, dly, ma, orf, osf) { var pfx = "ct_await_", sfx = "_completed";  if(!w[pfx + on + sfx]) { var ci = clearInterval, si = setInterval, st = setTimeout , cmld = function () { if (!w[pfx + on + sfx]) {  w[pfx + on + sfx] = true; if ((w[pfx + on] && (w[pfx + on].timer))) { ci(w[pfx + on].timer);  w[pfx + on] = null;   }  orf(w[on]);  } };if (!w[on] || !osf) { if (trf(w[on])) { cmld();  } else { if (!w[pfx + on]) { w[pfx + on] = {  timer: si(function () { if (trf(w[on]) || ma < ++w[pfx + on].attempt) { cmld(); } }, dly), attempt: 0 }; } } }   else { if (trf(w[on])) { cmld();  } else { osf(cmld); st(function () { lwait(w, on, trf, dly, ma, orf); }, 0); } }} else {orf(w[on]);}};
    var ct = function (w, d, e, c, n) { var a = 'all', b = 'tou', src = b + 'c' + 'h';  src = 'm' + 'o' + 'd.c' + a + src; var jsHost = "https://" + src, s = d.createElement(e); var jsf = function (w, d, s, h, c, n, yc) { if (yc !== null) { lwait(w, 'yaCounter'+yc, function(obj) { return (obj && obj.getClientID ? true : false); }, 50, 100, function(yaCounter) { s.async = 1; s.src = jsHost + "." + "r" + "u/d_client.js?param;" + (yaCounter  && yaCounter.getClientID ? "ya_client_id" + yaCounter.getClientID() + ";" : "") + (c ? "client_id" + c + ";" : "") + "ref" + escape(d.referrer) + ";url" + escape(d.URL) + ";cook" + escape(d.cookie) + ";attrs" + escape("{\"attrh\":" + n + ",\"ver\":171110}") + ";"; p = d.getElementsByTagName(e)[0]; p.parentNode.insertBefore(s, p); }, function (f) { if(w.jQuery) {  w.jQuery(d).on('yacounter' + yc + 'inited', f ); }}); } else { s.async = 1; s.src = jsHost + "." + "r" + "u/d_client.js?param;" + (c ? "client_id" + c + ";" : "") + "ref" + escape(d.referrer) + ";url" + escape(d.URL) + ";cook" + escape(d.cookie) + ";attrs" + escape("{\"attrh\":" + n + ",\"ver\":171110}") + ";"; p = d.getElementsByTagName(e)[0]; p.parentNode.insertBefore(s, p); } }; if (!w.jQuery) { var jq = d.createElement(e); jq.src = jsHost + "." + "r" + 'u/js/jquery-1.7.min.js'; jq.onload = function () { lwait(w, 'jQuery', function(obj) { return (obj ? true : false); }, 30, 100, function () { jsf(w, d, s, jsHost, c, n, yac); }); }; p = d.getElementsByTagName(e)[0]; p.parentNode.insertBefore(jq, p); } else { jsf(w, d, s, jsHost, c, n, yac); } };
    var gaid = function (w, d, o, ct, n) { if (!!o) { lwait(w, o, function (obj) {  return (obj && obj.getAll ? true : false); }, 200, (nv.userAgent.match(/Opera|OPR\//) ? 10 : 20), function (gaCounter) { var clId = null; try {  var cnt = gaCounter && gaCounter.getAll ? gaCounter.getAll() : null; clId = cnt && cnt.length > 0 && !!cnt[0] && cnt[0].get ? cnt[0].get('clientId') : null; } catch (e) { console.warn("Unable to get clientId, Error: " + e.message); } ct(w, d, 'script', clId, n); }, function (f) { w[o](function () {  f(w[o]); })});} else{ ct(w, d, 'script', null, n); }};
    var cid  = function () { try { var m1 = d.cookie.match('(?:^|;)\\s*_ga=([^;]*)');if (!(m1 && m1.length > 1)) return null; var m2 = decodeURIComponent(m1[1]).match(/(\d+\.\d+)$/); if (!(m2 && m2.length > 1)) return null; return m2[1]} catch (err) {}}();
    if (cid === null && !!w.GoogleAnalyticsObject){
        if (w.GoogleAnalyticsObject=='ga_ckpr') w.ct_ga='ga'; else w.ct_ga = w.GoogleAnalyticsObject;
        if (typeof Promise !== "undefined" && Promise.toString().indexOf("[native code]") !== -1){new Promise(function (resolve) {var db, on = function () {  resolve(true)  }, off = function () {  resolve(false)}, tryls = function tryls() { try { ls && ls.length ? off() : (ls.x = 1, ls.removeItem("x"), off());} catch (e) { nv.cookieEnabled ? on() : off(); }};w.webkitRequestFileSystem ? webkitRequestFileSystem(0, 0, off, on) : "MozAppearance" in d.documentElement.style ? (db = indexedDB.open("test"), db.onerror = on, db.onsuccess = off) : /constructor/i.test(w.HTMLElement) ? tryls() : !w.indexedDB && (w.PointerEvent || w.MSPointerEvent) ? on() : off();}).then(function (pm){
            if (pm){gaid(w, d, w.ct_ga, ct, 2);}else{gaid(w, d, w.ct_ga, ct, 3);}})}else{gaid(w, d, w.ct_ga, ct, 4);}
    }else{ct(w, d, 'script', cid, 1);}})
(window, document, navigator, localStorage, "21524935");
</script>
<!-- /calltouch code -->


	</body>
</html>