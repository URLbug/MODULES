<?php

if(!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

$arComponentParameters =[
    'PARAMETERS' => [
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

        'VARIABLE_ALIASES' => [
        ],

        'SEF_MODE' => [
            'detail' => [
                'NAME' => GetMessage('DETAIL_NAME'),
                'DEFAULT' => '#ELEMENT_ID#/',
                'VARIABLES' => ['ELEMENT_ID'],
            ],
        ],
    ],
];
