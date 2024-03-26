<?php

if(!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/assets/css/styles.css');

?>

<!DOCTYPE html>
<html>
<head>

    <title><?=$APPLICATION->ShowTitle();?></title>

    <?=$APPLICATION->ShowHead();?>

</head>
<body>

<?=$APPLICATION->ShowPanel();?>

<div class="container">
    <header>
        <h1>MODULES</h1>
    </header>

    <?$APPLICATION->IncludeComponent("bitrix:menu", "modules_main_menu", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "top",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "1",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>

