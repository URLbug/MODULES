<?php

if(!defined('B_PROLOG_INCLUDED') || !B_PROLOG_INCLUDED)
{
    die();
}

$arComponentParameters = [
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

        'LINKS' => [
            'PARENT' => 'BASE',
            'NAME' => 'Ссылки',
            'TYPE' => 'STRING',
        ]
    ],
];