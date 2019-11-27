<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div>
	<?if($arResult["DETAIL_TEXT"]):?>
		<?=$arResult["DETAIL_TEXT"]?>
	<?elseif($arResult["PREVIEW_TEXT"]):?>
		<?=$arResult["PREVIEW_TEXT"]?>
	<?endif;?>
</div>

<div class="newsdetail__soc-wrap"><? $frame = $this->createFrame()->begin(); ?>
	<div id="od" style="float:left; margin-right:20px;">
		<div id="ok_shareWidget"></div>
		<script>
			!function(d, id, did, st) {
				var js = d.createElement("script");
				js.src = "https://connect.ok.ru/connect.js";
				js.onload = js.onreadystatechange = function() {
					if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
						if (!this.executed) {
							this.executed = true;
							setTimeout(function() {
								OK.CONNECT.insertShareWidget(id, did, st);
							}, 0);
						}
					}
				};
				d.documentElement.appendChild(js);
			}(document, "ok_shareWidget", "https://jobhostel.ru<?=$APPLICATION->GetCurPage()?>", "{width:170,height:30,st:'rounded',sz:20,ck:3}");
		</script>
	</div>
	<div id="tw" style="float:left; margin-right:20px;">
		<a href="https://twitter.com/share" rel="nofollow" class="twitter-share-button">Tweet</a>
		<script>!function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (!d.getElementById(id)) {
					js = d.createElement(s);
					js.id = id;
					js.src = "//platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js, fjs);
				}
			}(document, "script", "twitter-wjs");</script>
	</div>
	<div id="google" style="float:left; margin-right:20px;">
		<g:plusone size="medium"></g:plusone>

		<script type="text/javascript">
			window.___gcfg = {
				lang: 'en-US',
			};

			(function() {
				var po = document.createElement('script');
				po.type = 'text/javascript';
				po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(po, s);
			})();
		</script>
	</div>
	<div id="vk" style="float:left; margin-right:20px;">
		<!-- Put this script tag to the <head> of your page -->
		<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>

		<script type="text/javascript">
			VK.init({apiId: 4125885, onlyWidgets: true});
		</script>

		<!-- Put this div tag to the place, where the Like block will be -->
		<div id="vk_like"></div>
		<script type="text/javascript">
			VK.Widgets.Like("vk_like", {type: "button", verb: 1, height: 20});
		</script>
	</div>
	<div id="fb" style="">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true" data-font="arial"></div>
	</div>
	<? $frame->beginStub(); ?>
	Загрузка...
	<? $frame->end(); ?>
</div>
<?if(is_array($arResult["SECTION"])):?>
	<br /><a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><?=GetMessage("CATALOG_BACK")?></a>
<?endif?>