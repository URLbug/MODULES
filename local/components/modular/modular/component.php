<?php
if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

/** @var CBitrixComponent $this */
/** @var $arParams */
/** @global CMain $APPLICATION */

$arParams['CACHE_TIME'] = (int)($arParams['CACHE_TIME'] ?? 0);

$arDefaultUrlTemplates404 =[
    'main' => '',
    'detail' => '#ELEMENT_ID#/',
];

$arDefaultVariableAliases404 = [];

$arDefaultVariableAliases = [];

$arComponentVariables =[
    'ELEMENT_ID',
];

$arParams['VARIABLE_ALIASES'] ??= [];

if($arParams['SEF_MODE'] == 'Y')
{
    $arVariables = [];

    $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates(
        $arDefaultUrlTemplates404,
        $arParams['SEF_URL_TEMPLATES']
    );

    $arVariableAliases = CComponentEngine::makeComponentVariableAliases(
        $arDefaultVariableAliases404,
        $arParams['VARIABLE_ALIASES']
    );

    $engine = new CComponentEngine($this);

    $componentPage = $engine->guessComponentPath(
        $arParams['SEF_FOLDER'],
        $arUrlTemplates,
        $arVariables
    );

    if(!$componentPage)
    {
        $componentPage = 'main';
    }

    CComponentEngine::initComponentVariables(
        $componentPage,
        $arComponentVariables,
        $arVariableAliases,
        $arVariables
    );


    $arResult =[
        'FOLDER' => $arParams['SEF_FOLDER'],
        'URL_TEMPLATES' => $arUrlTemplates,
        'VARIABLES' => $arVariables,
        'ALIASES' => $arVariableAliases,
    ];
}
else
{
    $arVariableAliases = CComponentEngine::makeComponentVariableAliases(
        $arDefaultVariableAliases,
        $arParams['VARIABLE_ALIASES']
    );

    CComponentEngine::initComponentVariables(
        false,
        $arComponentVariables,
        $arVariableAliases,
        $arVariables
    );

    $componentPage = '';

    if(
        isset($arVariables['ELEMENT_ID']) &&
        intval($arVariables['ELEMENT_ID']) > 0
    ) {
        $componentPage = 'detail';
    }
    else
    {
        $componentPage = 'main';
    }

    $arResult =[
        'FOLDER' => '',
        'URL_TEMPLATES' =>[
            'main' => htmlspecialcharsbx($APPLICATION->GetCurPage()),
            'detail' => htmlspecialcharsbx($APPLICATION->GetCurPage().'?'.$arVariableAliases['ELEMENT_ID'].'=#ELEMENT_ID#'),
            ],
        'VARIABLES' => $arVariables,
        'ALIASES' => $arVariableAliases,
    ];
}

$arResult['VARIABLES']['ELEMENT_ID'] ??= '';

$arResult['TITLE'] = $arParams['TITLE'];
$arResult['CASH_TIME'] = $arParams['CASH_TIME'];

$this->includeComponentTemplate($componentPage);
