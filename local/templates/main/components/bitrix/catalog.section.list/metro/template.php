<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true); ?>
<?$APPLICATION->AddHeadScript('/js/functions(1).js');?>
<?global $page;?>
<?global $sorting;?>
<h1><?$APPLICATION->ShowTitle(false)?></h1>
<div class="dormitory-filter">
   <div class="dormitory list 333">
      <div class="dormitory-sort">
         <div class="form-for-metro form_bug2_ie7">
            <form name="search_menu" method="get">
               <div class="fields">
                  <div class="sel_1 full_width">
                     <span>Округ </span>
                     <select name="mskokruga">
                        <option value="#">Все</option>
                        <option value="/obshejitiye-v-svao/">Северо-Восточный Административный Округ</option>
                        <option value="/obshejitiye-v-sao/">Северный Административный Округ</option>
                        <option value="/obshejitiye-v-vao/">Восточный Административный Округ</option>
                        <option value="/obshejitiye-v-uvao/">Юго-Восточный Административный Округ</option>
                        <option value="/obshejitiye-v-uao/">Южный Административный Округ</option>
                        <option value="/obshejitiye-v-uzao/">Юго-Западный Административный Округ</option>
                        <option value="/obshejitiye-v-zao/">Западный Административный Округ</option>
                        <option value="/obshejitiye-v-szao/">Северо-Западный Административный Округ</option>
                        <option value="/obshejitiye-v-cao/">Центральный Административный Округ</option>
                     </select>
                  </div>
               </div>
               <div class="search_but_for_metro"><input type="button" value="Найти" onClick="linklist(document.search_menu.mskokruga)" name="submit"></div>
            </form>
         </div>
         <div class="bottom-part " style="width: 100%;">
            <div class="vis-type">
               <div class="change list ">Списком</div>
               <div class="change tile">Плиткой</div>
            </div>
            <div class="metro-choose">
               <div class="map">
                  <a href="javascript:void(0);">На карте</a>
               </div>
            </div>
            <div class="price-sort">
               <?
                  if (strpos($_SERVER['REQUEST_URI'],'sortby=price')===false) $sort_by_price = '';
                  else $sort_by_price = '';
                  if (strpos($_SERVER['REQUEST_URI'],'?')===false) $sort_by_price .= '?';
                  else $sort_by_price .= '&';
                  $sort_by_price .= 'sortby=price';
                  if (strpos($_SERVER['REQUEST_URI'],'priceorder')===false) $sort_by_price .= '&priceorder=desc';
                  else $sort_by_price = str_replace('&priceorder=desc','',$sort_by_price);
                  
                  $uri = str_replace(array('&sortby=price','sortby=price','&priceorder=desc'),'',$_SERVER['REQUEST_URI']);
                  ?>
               <a href="<?=$uri.$sort_by_price?>" class="sort_1">Сортировать по цене</a>
            </div>
         </div>
         <?
            function sortDesc($a, $b) {
               if ($a['PRICES'] === $b['PRICES']) return 0;
               return $a['PRICES'] < $b['PRICES'] ? 1 : -1;
            }
            
            function sortAsc($a, $b) {
               if ($a['PRICES'] === $b['PRICES']) return 0;
               return $a['PRICES'] > $b['PRICES'] ? 1 : -1;
            }
            
            if($_GET['sortby'] && $_GET['priceorder']){
               uasort($arResult["ITEM"], 'sortDesc');
               $arResult["ITEM"] = array_values($arResult["ITEM"]);
            }else{
               uasort($arResult["ITEM"], 'sortAsc');
               $arResult["ITEM"] = array_values($arResult["ITEM"]);
            }
            ?> 
         <div class="title">
            <?=$arResult["SEO_OKRUG"]?>
         </div>
         <?if(!$arrFilter){$arrFilter=array("ACTIVE" => "Y","PROPERTY_yandexmap" => "_%");}?>
         <script src="https://api-maps.yandex.ru/2.1.40/?lang=ru_RU" type="text/javascript"></script>
         <div class="bx-yandex-view-layout">
            <div class="bx-yandex-view-map"></div>
         </div>
         <div class="item-for-metro">
            <?    
               for ($i = 0; $i < count($arResult["ITEM"]); $i++): ?>
            <?
               $img = CFile::GetPath($arResult["ITEM"][$i]['PREVIEW_PICTURE']);
               
               $arPrice = GetCatalogProductPriceList($arResult["ITEM"][$i]['ID'], "SORT", "ASC");
               $price = preg_replace('/\.00/', '' , $arPrice[0]["PRICE"]);
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Восточный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-vao/">Восточный Административный Округ</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Западный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-zao/">Западный Административный Округ</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Юго-Западный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-uzao/">Юго-Западный Административный Округ</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Юго-Восточный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-uvao/">Юго-Восточный Административный Округ</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Южный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-uao/">Южный Административный Округ</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Северо-Западный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-szao/">Северо-Западный Административный Округ</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Северо-Восточный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-svao/">Северо-Восточный Административный Округ</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Северный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-sao/">Общежития в Северном Административном Округе</a>';
            
            if($arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] == 'Центральный Административный Округ')
               $arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0] = '<a href="/obshejitiye-v-cao/">Центральный Административный Округ</a>';
               ?>       
            <div class="item" onclick="window.location.href = '<?= $arResult["ITEM"][$i]["DETAIL_PAGE_URL"] ?>';"
               id="sorting_<?= $arResult["ITEM"][$i]['ID']?>" style="<?=$style?>">
               <div class="name">
                  <div class="bg-img" style="background-image:url(<? if (strlen($img) > 1) echo "'".$img ."'"; else echo '/images/no_photo.jpg' ?>);"></div>
               </div>
               <div class="descr">
                  <p class="descr__name"><?= $arResult["ITEM"][$i]["NAME"]; ?></p>
                  <p class="descr__metro"><img alt="рядом с метро" src="/upload/metro.png"><?=$arResult["ITEM"][$i]["PROPERTIES"]["metro"]["VALUE"][0]; ?>
                  </p>
                  <p class="descr__street">
                     <a href="<?= $arResult["ITEM"][$i]["DETAIL_PAGE_URL"] . "#tomap"; ?>"><?= $arResult["ITEM"][$i]["PROPERTIES"]["ulica"]["~VALUE"]; ?></a>
                  </p>
              <p class="mans">
               <?=$arResult["ITEM"][$i]["PROPERTIES"]["mskokruga"]["VALUE"][0]?>
              </p>
              <p class="mans">
               Мест в комнате: 
               <span>
               <?
               foreach($arResult["ITEM"][$i]["PROPERTIES"]["kolchel"]["VALUE"] as $key => $man){
                  if($man == end($arResult["ITEM"][$i]["PROPERTIES"]["kolchel"]["VALUE"])){
                     echo $man;
                  }else{
                     echo $man.'&nbsp;/&nbsp;';
                  }
               }
               ?>
               </span>
              </p>
              <p class="mans">
               Гражданство заселяемых:&nbsp;             
               <?
               foreach($arResult["ITEM"][$i]["PROPERTIES"]["gragdanstvo"]["VALUE"] as $key => $man){  
                  if($man == end($arResult["ITEM"][$i]["PROPERTIES"]["gragdanstvo"]["VALUE"])){
                     if($man == 'Россия, Белоруссия')
                        $man = '<span>РФ</span><img src="/bitrix/images/rf.jpg" alt="РФ" title="РФ">';
                  
                     if($man == 'СНГ')
                        $man = '<span>СНГ</span><img src="/bitrix/images/sng.png" alt="СНГ" title="СНГ">';
                  
                     if($man == 'Дальнее зарубежье')
                        $man = '<span>Дал.Зарубежье</span><img src="/bitrix/images/world.jpg" alt="Дальнее зарубежье" title="Дальнее зарубежье">';
                     
                     echo $man;
                  }else{
                     if($man == 'Россия, Белоруссия')
                        $man = '<span>РФ</span><img src="/bitrix/images/rf.jpg" alt="РФ" title="РФ">';
                  
                     if($man == 'СНГ')
                        $man = '<span>СНГ</span><img src="/bitrix/images/sng.png" alt="СНГ" title="СНГ">';
                  
                     if($man == 'Дальнее зарубежье')
                        $man = '<span>Дал.Зарубежье</span><img src="/bitrix/images/world.jpg" alt="Дальнее зарубежье" title="Дальнее зарубежье">';
                     
                     echo $man.'&nbsp;/&nbsp;';
                  }
               }
               ?>             
              </p>
               </div>
               <div class="price">
                  <div class="catalog-price"><span class="price-num"><? echo $price;?></span> руб / сутки</div>
                  <a class="btn item__more" href="<?= $arResult["ITEM"][$i]["DETAIL_PAGE_URL"]; ?>">
                  <span>Подробнее</span>
                  </a>
               </div>
            </div>
            <? endfor?>
         </div>
      </div>
   </div>
</div>