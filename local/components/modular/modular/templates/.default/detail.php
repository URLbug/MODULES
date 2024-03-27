<?php

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponent $component */

$APPLICATION->IncludeComponent(
    'modular:modular.detail',
    '',
    [
        'ID' => $arResult['VARIABLES']['ELEMENT_ID'],
    ],
    $component
);

?>

<a href="<?=$arResult['FOLDER'].$arResult['URL_TEMPLATES']['main']?>">
    <?=GetMessage('DETAIL_BACK');?>
</a>
