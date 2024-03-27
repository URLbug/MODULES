<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("users");
?><?$APPLICATION->IncludeComponent(
	"modular:modular",
	"",
	Array(
		"CASH_TIME" => "36000",
		"SEF_FOLDER" => "/users/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("detail"=>"#ELEMENT_ID#/"),
		"TITLE" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>