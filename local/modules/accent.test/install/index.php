<?php

use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class accent_test extends CModule
{
    public function __construct()
    {
        $arModuleVersion = [];
        include __DIR__ . '/version.php';

        $this->MODULE_ID = 'accent.test';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'] ?? '1.0.0';
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'] ?? date('Y-m-d');
        $this->MODULE_NAME = Loc::getMessage('ACCENT_TEST_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('ACCENT_TEST_MODULE_DESCRIPTION');
    }


    /**
     * @return void
     */
    public function DoInstall(): void
    {
        $this->InstallDB();
    }


    /**
     * @return void
     */
    public function InstallDB(): void
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }


    /**
     * @return void
     * @throws ArgumentNullException
     * @throws LoaderException
     */
    public function DoUninstall(): void
    {
        $this->UnInstallDB();
    }


    /**
     * @return void
     * @throws ArgumentNullException
     * @throws LoaderException
     */
    public function UnInstallDB(): void
    {
        Loader::includeModule($this->MODULE_ID);
        Option::delete($this->MODULE_ID);
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

}
