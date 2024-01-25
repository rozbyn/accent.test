<?php

use Accent\Company\Options;
use Bitrix\Main\Loader;

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (!defined('ACCENT_TEST_MODULE')) {
    define('ACCENT_TEST_MODULE', 'accent.test');
}

Loader::requireModule(ACCENT_TEST_MODULE);
?>

Номер телефона: <?= Options::getPhone() ?> <br>
Email: <?= Options::getEmail() ?> <br>
Ватсап: <?= Options::getWhatsApp() ?> <br>
Телеграм: <?= Options::getTelegram() ?> <br>
Почтовый адрес: <?= Options::getAddress() ?> <br>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
