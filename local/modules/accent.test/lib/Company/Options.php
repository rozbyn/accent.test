<?php

namespace Accent\Company;

use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Sender\Recipient\Validator;

/**
 *
 */
class Options
{
    public const PHONE = 'company_phone';
    public const ADDRESS = 'company_address';
    public const EMAIL = 'company_email';
    public const TELEGRAM = 'company_telegram';
    public const WHATSAPP = 'company_whatsapp';


    /**
     * @return string
     */
    public static function getPhone(): string
    {
        return self::getOption(self::PHONE);
    }


    /**
     * @return string
     */
    public static function getAddress(): string
    {
        return self::getOption(self::ADDRESS);
    }


    /**
     * @return string
     */
    public static function getEmail(): string
    {
        return self::getOption(self::EMAIL);
    }


    /**
     * @return string
     */
    public static function getTelegram(): string
    {
        return self::getOption(self::TELEGRAM);
    }


    /**
     * @return string
     */
    public static function getWhatsApp(): string
    {
        return self::getOption(self::WHATSAPP);
    }


    /**
     * @param string $optName
     * @return string
     */
    protected static function getOption(string $optName): string
    {
        return Option::get(ACCENT_TEST_MODULE, $optName);
    }


    /**
     * @param string $optName
     * @param string $optValue
     * @return bool
     * @throws LoaderException
     */
    public static function validateOption(string $optName, string $optValue): bool
    {
        Loader::requireModule('sender');
        return
            ($optName === self::TELEGRAM)
            || ($optName === self::ADDRESS)
            || (($optName === self::PHONE) && Validator::validatePhone($optValue))
            || (($optName === self::WHATSAPP) && Validator::validatePhone($optValue))
            || (($optName === self::EMAIL) && Validator::validateEmail($optValue))
        ;
    }


    /**
     * @param string $optName
     * @param string $optValue
     * @return void
     * @throws ArgumentOutOfRangeException
     */
    public static function setOption(string $optName, string $optValue): void
    {
        Option::set(ACCENT_TEST_MODULE, $optName, $optValue);
    }




}
