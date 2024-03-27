<?php

if (!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

use Bitrix\Iblock\Component\Tools;

class modularComponent extends CBitrixComponent
{
    /**
     * @var array|string[]
     */
    protected array $arComponentVariables = [
        'ELEMENT_ID',
    ];

    public function executeComponent()
    {

        if($this->arParams['SEF_MODE'] === 'Y')
        {
            $componentPage = $this->sefMode();
        }
        else
        {
            $componentPage = $this->noSefMode();
        }

        //Отдать 404 статус если не найден шаблон
        if (!$componentPage) {
            Tools::process404(
                $this->arParams['MESSAGE_404'],
                ($this->arParams['SET_STATUS_404'] === 'Y'),
                ($this->arParams['SET_STATUS_404'] === 'Y'),
                ($this->arParams['SHOW_404'] === 'Y'),
                $this->arParams['FILE_404']
            );
        }

        $this->IncludeComponentTemplate($componentPage);
    }

    protected function sefMode(): string
    {
        //Значение алиасов по умолчанию.
        $arDefaultVariableAliases404 = [];

        $arDefaultUrlTemplates404 =[
            'main' => '',
            'detail' => '#ELEMENT_ID#/',
        ];

        $arVariables = [];

        $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates(
            $arDefaultUrlTemplates404,
            $this->arParams['SEF_URL_TEMPLATES']
        );

        $arVariableAliases = CComponentEngine::makeComponentVariableAliases(
            $arDefaultVariableAliases404,
            $this->arParams['VARIABLE_ALIASES']
        );

        $engine = new CComponentEngine($this);

        $engine->addGreedyPart('#SECTION_CODE_PATH#');
        $engine->setResolveCallback([
            'CIBlockFindTools', 
            'resolveComponentEngine',
        ]);

        $componentPage = $engine->guessComponentPath(
            $this->arParams['SEF_FOLDER'],
            $arUrlTemplates,
            $arVariables
        );

        $b404 = false;

        if(!$componentPage)
        {
            $componentPage = 'main';

            $b404 = true;
        }

        if($b404)
        {
            $folder404 = str_replace(
                "\\",
                "/",
                $this->arParams["SEF_FOLDER"]);

            if ($folder404 !== "/")
            {
                $folder404 = "/" . trim($folder404, "/ \t\n\r\0\x0B") . "/";
            }

            if (mb_substr($folder404, -1) === "/")
            {
                $folder404 .= "index.php";
            }

            $cMain = new CMain();

            if ($folder404 !== $cMain->GetCurPage(true))
            {
                Tools::process404(
                    ""
                    ,($this->arParams["SET_STATUS_404"] === "Y")
                    ,($this->arParams["SET_STATUS_404"] === "Y")
                    ,($this->arParams["SHOW_404"] === "Y")
                    ,$this->arParams["FILE_404"]
                );
            }
        }

        CComponentEngine::initComponentVariables(
            $componentPage,
            $this->arComponentVariables,
            $arVariableAliases,
            $arVariables
        );

        $this->arResult = [
            'FOLDER' => $this->arParams['SEF_FOLDER'],
            'URL_TEMPLATES' => $arUrlTemplates,
            'VARIABLES' => $arVariables,
            'ALIASES' => $arVariableAliases,
            'TITLE' => $this->arParams['TITLE'],
            'CASH_TIME' => $this->arParams['CASH_TIME'],
        ];

        return $componentPage;
    }

    protected function noSefMode(): string
    {
        $arDefaultVariableAliases = [];

        $arVariableAliases = CComponentEngine::makeComponentVariableAliases(
            $arDefaultVariableAliases,
            $this->arParams['VARIABLE_ALIASES']
        );

        CComponentEngine::initComponentVariables(
            false,
            $this->arComponentVariables,
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

        $cMain = new CMain();

        $this->arResult = [
            'FOLDER' => '',
            'URL_TEMPLATES' =>[
                'main' => htmlspecialcharsbx($cMain->GetCurPage()),
                'detail' => htmlspecialcharsbx($cMain->GetCurPage().'?'.$arVariableAliases['ELEMENT_ID'].'=#ELEMENT_ID#'),
            ],
            'VARIABLES' => $arVariables,
            'ALIASES' => $arVariableAliases,
            'TITLE' => $this->arParams['TITLE'],
            'CASH_TIME' => $this->arParams['CASH_TIME'],
        ];

        return $componentPage;
    }
}
