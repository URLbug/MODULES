<?php
if (!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED)
{
    die();
}
/** @var CBitrixComponent $this */
/** @var $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

$arParams['CACHE_TIME'] = (int)($arParams['CACHE_TIME'] ?? 0);

$arDefaultUrlTemplates404 = array(
    "main" => "",
    "section" => "",
    "detail" => "#ELEMENT_ID#/",
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
    "SECTION_ID",
    "SECTION_CODE",
    "ELEMENT_ID",
    "ELEMENT_CODE",
);

$arParams['VARIABLE_ALIASES'] ??= [];

if($arParams["SEF_MODE"] == "Y")
{
    $arVariables = array();

    $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
    $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

    $engine = new CComponentEngine($this);
    if (CModule::IncludeModule('iblock'))
    {
        $engine->addGreedyPart("#SECTION_CODE_PATH#");
        $engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
    }
    $componentPage = $engine->guessComponentPath(
        $arParams["SEF_FOLDER"],
        $arUrlTemplates,
        $arVariables
    );

    $b404 = false;
    if(!$componentPage)
    {
        $componentPage = "main";
        $b404 = true;
    }

    if($componentPage == "section")
    {
        if (isset($arVariables["SECTION_ID"]))
            $b404 |= (intval($arVariables["SECTION_ID"])."" !== $arVariables["SECTION_ID"]);
        else
            $b404 |= !isset($arVariables["SECTION_CODE"]);
    }

    if($b404 && CModule::IncludeModule('iblock'))
    {
        $folder404 = str_replace("\\", "/", $arParams["SEF_FOLDER"]);
        if ($folder404 != "/")
            $folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
        if (mb_substr($folder404, -1) == "/")
            $folder404 .= "index.php";

        if ($folder404 != $APPLICATION->GetCurPage(true))
        {
            \Bitrix\Iblock\Component\Tools::process404(
                ""
                ,($arParams["SET_STATUS_404"] === "Y")
                ,($arParams["SET_STATUS_404"] === "Y")
                ,($arParams["SHOW_404"] === "Y")
                ,$arParams["FILE_404"]
            );
        }
    }

    CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);

    $arResult = array(
        "FOLDER" => $arParams["SEF_FOLDER"],
        "URL_TEMPLATES" => $arUrlTemplates,
        "VARIABLES" => $arVariables,
        "ALIASES" => $arVariableAliases,
    );
}
else
{
    $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
    CComponentEngine::initComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

    $componentPage = "";

    if(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
        $componentPage = "detail";
    elseif(isset($arVariables["ELEMENT_CODE"]) && $arVariables["ELEMENT_CODE"] <> '')
        $componentPage = "detail";
    elseif(isset($arVariables["SECTION_ID"]) && intval($arVariables["SECTION_ID"]) > 0)
    {
        $componentPage = "section";
    }
    elseif(isset($arVariables["SECTION_CODE"]) && $arVariables["SECTION_CODE"] <> '')
    {
        $componentPage = "section";
    }
    else
        $componentPage = "main";

    $arResult = array(
        "FOLDER" => "",
        "URL_TEMPLATES" => array(
            "main" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
            "section" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"),
            "detail" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#"),
            ),
        "VARIABLES" => $arVariables,
        "ALIASES" => $arVariableAliases
    );
}

$arResult["VARIABLES"]["ELEMENT_ID"] ??= '';
$arResult["VARIABLES"]["ELEMENT_CODE"] ??= '';
$arResult["VARIABLES"]["SECTION_ID"] ??= '';
$arResult["VARIABLES"]["SECTION_CODE"] ??= '';

$arResult['TITLE'] = $arParams['TITLE'];
$arResult['CASH_TIME'] = $arParams['CASH_TIME'];

$this->includeComponentTemplate($componentPage);
