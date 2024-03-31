<?php

if(!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED)
{
    die();
}

/**
 * @var $arResult
 */

?>
<h1><?=$arResult['TITLE'];?></h1>

<table class="table">
    <thead>
    <tr>
        <th scope="col"><?=GetMessage('ID');?></th>
        <th scope="col"><?=GetMessage('NAME');?></th>
        <th scope="col"><?=GetMessage('DESC');?></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($arResult['GROUP_USERS'] as $arGroup):?>
        <tr>
            <td><?=$arGroup['ID']?></td>
            <td><?=$arGroup['NAME']?></td>
            <td><?=$arGroup['DESCRIPTION']?></td>
        </tr>
    <?php endforeach;?>

    </tbody>
</table>


