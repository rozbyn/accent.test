<?php

use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;

if (!defined('B_PROLOG_INCLUDED')) {
    exit;
}

if (!defined('ACCENT_TEST_MODULE')) {
    define('ACCENT_TEST_MODULE', 'accent.test');
}


try {
    Loader::registerAutoLoadClasses(ACCENT_TEST_MODULE, [
        'Accent\Company\Options' => '/lib/Company/Options.php',
    ]);
} catch (LoaderException $e) {
    ShowError($e->getMessage());
}
