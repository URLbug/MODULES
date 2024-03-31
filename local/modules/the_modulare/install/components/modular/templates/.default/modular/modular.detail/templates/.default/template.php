<?php

if(!defined("B_PROLOG_INCLUDED") || !B_PROLOG_INCLUDED)
{
    die();
}

/**
 * @var $arResult
 */

?>
111
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

        <tr>
            <td><?=$arResult['GROUP_USER']['ID']?></td>
            <td><?=$arResult['GROUP_USER']['NAME']?></td>
            <td><?=$arResult['GROUP_USER']['DESCRIPTION']?></td>
        </tr>

    </tbody>
</table>


