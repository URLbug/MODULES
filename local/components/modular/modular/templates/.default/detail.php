<?php

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arGroups = CGroup::GetList();

$arUsersGroups = [];

if(intval($arGroups->SelectedRowsCount()) > 0)
{
    while ($arGroup = $arGroups->Fetch())
    {
        $arUsersGroups[] = $arGroup['ID'];
    }
}

if(!in_array($arResult['VARIABLES']['ELEMENT_ID'], $arUsersGroups))
{
    require(\Bitrix\Main\Application::getDocumentRoot()."/404.php");

    return;
}

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
