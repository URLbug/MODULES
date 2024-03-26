<?php

if(!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED) die();

$arComponentParameters = array(
    'PARAMETERS' => array(
        'CASH_TIME' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('CASH_TIME_NAME'),
            'TYPE' => 'INT',
            'DEFAULT' => 36000,
        ],

        'TITLE' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('TITLE_NAME'),
            'TYPE' => 'STRING',
        ],

        "VARIABLE_ALIASES" => [
            "SECTION_ID" => ["NAME" => 'Индефикатор раздела'],
            "ELEMENT_ID" => ["NAME" => 'Индефикатор страницы'],
        ],

        "SEF_MODE" => [
            "main" => [
                "NAME" => 'Главная страница',
                "DEFAULT" => "",
                "VARIABLES" => [],
            ],
            "section" => [
                "NAME" => 'Раздел',
                "DEFAULT" => "",
                "VARIABLES" => ["SECTION_ID"],
            ],
            "detail" => [
                "NAME" => 'Детальная страница',
                "DEFAULT" => "#ELEMENT_ID#/",
                "VARIABLES" => ["ELEMENT_ID", "SECTION_ID"],
            ],
        ],
    ),
);