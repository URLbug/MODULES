<?php

if(!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED)
{
    die();
}

/**
 * @var array $arParams
 * @var CUser $USER
 * @global CMain $APPLICATION
 */

use Bitrix\Main\Data\Cache;

$arParams['CACHE_TIME'] = intval($arParams['CACHE_TIME']);

$cacheId = implode('|', [
    SITE_ID,
    $APPLICATION->GetCurPage(),
    $USER->GetGroups(),
]);

foreach ($arParams as $k => $v)
{
    if (strncmp('~', $k, 1))
    {
        $cacheId .= ',' . $k . '=' . $v;
    }
}

$cacheDir = '/' . SITE_ID . $this->GetRelativePath();

$cache = Cache::createInstance();

// Проверяем, выводим, на буферизацию HTML кода, либо выводит содержимое кеша если он ещё не истек
if(
    $cache->startDataCache(
        $arParams['CACHE_TIME'],
        $cacheId,
        $cacheDir)
) {
    $arUsersGroups = [];

    // Берем список групп пользователей
    $arGroups = CGroup::GetList();

    if(intval($arGroups->SelectedRowsCount()) > 0)
    {
        while($arGroup = $arGroups->Fetch())
        {
            $arUsersGroups[] = $arGroup;
        }
    }

    // Создаем итоговый массив
    $arResult = [
        'TITLE' => $arParams['TITLE'],
        'GROUP_USERS' => $arUsersGroups,
    ];

    // Подключение шаблона компонента
    $this->IncludeComponentTemplate();

    $templateCachedData = $this->GetTemplateCachedData();

    $cache->endDataCache([
        'arResult' => $arResult,
        'templateCachedData' => $templateCachedData,
    ]);
}
else
{
    extract($cache->GetVars());

    $this->SetTemplateCachedData($templateCachedData);
}
