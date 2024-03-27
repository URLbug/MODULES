<?php

if(!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponent $component */

$APPLICATION->IncludeComponent(
  'modular:modular.users',
  '',
  [
      'CASH_TIME' => $arResult['CASH_TIME'],
      'TITLE' => $arResult['TITLE'],
  ],
  $component
);
