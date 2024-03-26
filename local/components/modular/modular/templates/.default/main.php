<?php

if(!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED)
{
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
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
