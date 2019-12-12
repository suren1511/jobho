<?php
$arUrlRewrite=array (
  5 => 
  array (
    'CONDITION' => '#^/obshejitiya/obshejitiyespb_([a-zA-Z0-9\\-_]+).htm([a-zA-Z0-9\\-?_\\=&%\\w+\\W+]+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/detailspb.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/news/([a-zA-Z0-9\\-_]+)/([a-zA-Z0-9\\-_]+).htm([a-zA-Z0-9\\-?_\\=&\\w+\\W+]+)#',
    'RULE' => 'SECTION_CODE=$1&ELEMENT_CODE=$2',
    'ID' => '',
    'PATH' => '/news/detail.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/obshejitiyespb_([a-zA-Z0-9\\-_]+).htm([a-zA-Z0-9\\-?_\\=&%\\w+\\W+]+)#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/detailspb.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#/transportnye_uslugi/passazhirskie_perevozki/transport_([0-9]+)/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/transportnye_uslugi/detail.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/dormitory_suburbs/([a-zA-Z0-9\\-?_\\=&%\\w+\\W+]+)-napravlenie/#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/dormitory_suburbs/napr.php',
    'SORT' => 100,
  ),
  42 => 
  array (
    'CONDITION' => '#^/hostels_podmsc/([a-zA-Z0-9\\-?_\\=&%\\w+\\W+]+)-napravlenie/#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/hostels_podmsc/napr.php',
    'SORT' => 100,
  ),
  24 => 
  array (
    'CONDITION' => '#^/news/([a-zA-Z0-9\\-_]+).htm([a-zA-Z0-9\\-?_\\=&\\w+\\W+]+)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/news/list.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/jobs/([a-zA-Z0-9\\-_]+).htm([a-zA-Z0-9\\-?_\\=&\\w+\\W+]+)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/jobs/detail.php',
    'SORT' => 100,
  ),
  40 => 
  array (
    'CONDITION' => '#^/obshejitiye_([a-zA-Z0-9\\-?_\\=&%\\w+\\W+]+)/(\\$|\\?.*)#',
    'RULE' => 'CODE=$1',
    'ID' => 'bitrix:catalog.element',
    'PATH' => '/obshejitiya/detail.php',
    'SORT' => 100,
  ),
  41 => 
  array (
    'CONDITION' => '#^/obshejitiye_([a-zA-Z0-9\\-?_\\=&%\\w+\\W+]+)/#',
    'RULE' => 'CODE=$1',
    'ID' => 'bitrix:catalog.element',
    'PATH' => '/obshejitiya/detail.php',
    'SORT' => 100,
  ),
  23 => 
  array (
    'CONDITION' => '#^/dormitory_suburbs/([a-zA-Z0-9_]+)/$#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/dormitory_suburbs/oblrayoni.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/metro_([a-zA-Z0-9\\-?_\\=&%\\w+\\W+]+)/#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/metro/index.php',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/shosse-entuziastov.html$#',
    'RULE' => 'ID=14294',
    'ID' => '',
    'PATH' => '/obshejitiya/detail.php',
    'SORT' => 100,
  ),
  19 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-uzao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-uzao/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-svao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-svao/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-zlao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-zlao/index.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-uvao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-uvao/index.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-szao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-szao/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-uao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-uao/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-sao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-sao/index.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-cao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-cao/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-nao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-nao/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-vao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-vao/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/obshejitiye-v-zao/#',
    'RULE' => 'ID=$1',
    'ID' => '',
    'PATH' => '/obshejitiya/obshejitiye-v-zao/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  43 => 
  array (
    'CONDITION' => '#^/personal/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/personal/vacancy/index.php',
    'SORT' => 100,
  ),
  46 => 
  array (
    'CONDITION' => '#^/personal/manager/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/personal/manager/index.php',
    'SORT' => 100,
  ),
  45 => 
  array (
    'CONDITION' => '#^/personal/lessor/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/personal/lessor/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
