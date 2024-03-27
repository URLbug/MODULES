<?php

if(!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

/** @var array $arResult */
/** @var array $arParams */
/** @global CMain $APPLICATION */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$APPLICATION->IncludeComponent(
    'modular:modular.users',
    '',
    [
        'CASH_TIME' => $arParams['CASH_TIME'],
        'TITLE' => $arParams['TITLE'],
    ],
    $component,
    ['HIDE_ICONS' => 'Y']
);
