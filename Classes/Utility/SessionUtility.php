<?php
declare(strict_types=1);

namespace StudioMitte\PowermailFreebie\Utility;

use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class SessionUtility
{

    private const KEY = 'powermail_freebie';

    public static function getAll(): array
    {
        $data = (string)self::getTyposcriptFrontendController()->fe_user->getKey('ses', self::KEY);
        return $data ? json_decode($data, true) : [];
    }


    public static function save(string $identifier, $value): void
    {
        $data = self::getAll();
        $data[$identifier] = $value;
        self::getTyposcriptFrontendController()->fe_user->setKey('ses', self::KEY, json_encode($data));
        self::getTyposcriptFrontendController()->storeSessionData();
    }

    public static function remove(string $identifier): void
    {
        $data = self::getAll();
        unset($data[$identifier]);

        self::getTyposcriptFrontendController()->fe_user->setKey('ses', self::KEY, json_encode($data));
    }

    protected static function getTyposcriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }

}
