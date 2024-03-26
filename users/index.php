<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("users");
?><?$APPLICATION->IncludeComponent(
	"modular:modular", 
	".default", 
	array(
		"CASH_TIME" => "36000",
		"SEF_FOLDER" => "/users/",
		"SEF_MODE" => "Y",
		"TITLE" => "TEST",
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_URL_TEMPLATES" => array(
			"main" => "",
			"section" => "",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>