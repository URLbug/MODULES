<?php

if(!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED)
{
    die();
}

/**
 * @var $arParams
 */

$rsGroup = CGroup::GetByID($arParams['ID']);
$arGroup = $rsGroup->Fetch();

$arResult = [
    'TITLE' => $arParams['TITLE'],
    'GROUP_USER' => $arGroup,
];

$this->IncludeComponentTemplate();
