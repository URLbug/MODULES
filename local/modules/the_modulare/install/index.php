<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (class_exists('mymodule'))
	return;

class the_modulare extends CModule
{
	var $MODULE_ID = 'the_modulare';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = 'Y';

	public function __construct()
	{
		$arModuleVersion = array();

		include(__DIR__ . '/version.php');

		$this->MODULE_VERSION = $arModuleVersion['VERSION'];
		$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		$this->MODULE_NAME = Loc::getMessage('THE_MODULARE_NAME');
		$this->MODULE_DESCRIPTION = Loc::getMessage('THE_MODULARE_DESCRIPTION');
	}

	function InstallDB(): bool
	{
		RegisterModule($this->MODULE_ID);

		return true;
	}

	function UnInstallDB(): bool
	{
		UnRegisterModule($this->MODULE_ID);

		return true;
	}

	function InstallEvents(): bool
	{
        return true;
	}

	function UnInstallEvents(): bool
	{
		return true;
	}

	function InstallFiles($arParams = array()): bool
	{
        CopyDirFiles(
            $_SERVER['DOCUMENT_ROOT'] .
            '/local/modules/' . $this->MODULE_ID . '/install/components',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components/modular',
            true,
            true
        );

		return true;
	}

	function UnInstallFiles(): bool
	{
        DeleteDirFiles(
            $_SERVER['DOCUMENT_ROOT'] .
            '/local/modules/' . $this->MODULE_ID . '/install/components',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components/modular',
        );

        return true;
	}

	function DoInstall(): void
	{
        $this->InstallFiles();
        $this->InstallDB();
	}

	function DoUninstall(): void
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
	}
}
