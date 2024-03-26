<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Первый компонент 1");
?>

<?$APPLICATION->IncludeComponent(
    "modular:modular.users",
    "",
    Array(
        "CASH_TIME" => "36000",
        "TITLE" => "Группа пользователей"
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>