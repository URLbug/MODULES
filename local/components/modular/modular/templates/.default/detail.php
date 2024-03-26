<?php

if (!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED)
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
    "modular:modular.detail",
    "",
    Array(
        "ID" => $arResult['VARIABLES']['ELEMENT_ID'],
    ),
    $component,
    ['HIDE_ICONS' => 'Y']
);

?>

<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["main"]?>">
    <?=GetMessage('DETAIL_BACK');?>
</a>
