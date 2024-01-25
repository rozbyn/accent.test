<?php

if (!defined('B_PROLOG_INCLUDED')) {
    exit;
}

if (!defined('ACCENT_TEST_MODULE')) {
    define('ACCENT_TEST_MODULE', 'accent.test');
}

use Accent\Company\Options;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

/** Bitrix */
global $APPLICATION;


Loc::loadMessages($_SERVER['DOCUMENT_ROOT'] . BX_ROOT . '/modules/main/options.php');
Loc::loadMessages(__FILE__);

/** @noinspection PhpUnhandledExceptionInspection */
Loader::includeModule(ACCENT_TEST_MODULE);
$request = HttpApplication::getInstance()->getContext()->getRequest();

//Описание опций
$aTabs = [
    [
        'DIV' => 'main_tab',
        'TAB' => Loc::getMessage('SETTINGS'),
        'TITLE' => Loc::getMessage('COMPANY_REQUISITES'),
        'OPTIONS' => [
            [Options::PHONE, Loc::getMessage('PHONE'), '', ['text', 25]],
            [Options::ADDRESS, Loc::getMessage('ADDRESS'), '', ['text', 25]],
            [Options::EMAIL, Loc::getMessage('EMAIL'), '', ['text', 25]],
            [Options::TELEGRAM, Loc::getMessage('TELEGRAM'), '', ['text', 25]],
            [Options::WHATSAPP, 'Whatsapp', '', ['text', 25]],
        ],
    ],
];
if ($request->isPost() && !check_bitrix_sessid()) {
    ShowError(Loc::getMessage('SESSID_ERROR'));
}
//region Сохранение & Обновление зависимостей
if (isset($request['Update']) && $request->isPost() && check_bitrix_sessid()) {
    foreach ($aTabs as $aTab) {
        foreach ((array)$aTab['OPTIONS'] as $arOption) {
            if (!is_array($arOption) || $arOption['note']) {
                continue;
            }
            if (Options::validateOption($arOption[0], $request->getPost($arOption[0]))) {
                Options::setOption($arOption[0], $request->getPost($arOption[0]));
            } else {
                ShowError(Loc::getMessage('OPTION_VALUE_INVALID') . ' "' . $arOption[1] . '"');
            }
        }
    }
}
//endregion

//region Вывод настроек
$tabControl = new CAdminTabControl('tabControl', $aTabs);
$url = $APPLICATION->GetCurPage() . '?mid=' . htmlspecialcharsbx($request['mid']) . '&amp;lang=' . $request['lang'];
$tabControl->Begin(); ?>
    <form method='post'
          action='<?= $url ?>'
          name='accent_test_settings'>
        <?php
        foreach ($aTabs as $aTab) {
            if (isset($aTab['OPTIONS'])) {
                $tabControl->BeginNextTab();
                /** @noinspection PhpUndefinedFunctionInspection */
                __AdmSettingsDrawList(ACCENT_TEST_MODULE, $aTab['OPTIONS']);
            }
        }
        $tabControl->BeginNextTab();
        $tabControl->Buttons();
        ?>
        <input type="submit" name="Update" value="<?= Loc::getMessage('MAIN_SAVE') ?>">
        <?= bitrix_sessid_post() ?>
    </form>
<?php
$tabControl->End();
//endregion
