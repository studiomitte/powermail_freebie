<?php

// For 8x
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools::class]['flexParsing'][]
    = \StudioMitte\PowermailFreebie\Hooks\FlexFormHook::class;

if (!isset($GLOBALS['TYPO3_CONF_VARS']['DB']['additionalQueryRestrictions'][\StudioMitte\PowermailFreebie\Database\Query\Restriction\FreebieRestriction::class])) {
    $GLOBALS['TYPO3_CONF_VARS']['DB']['additionalQueryRestrictions'][\StudioMitte\PowermailFreebie\Database\Query\Restriction\FreebieRestriction::class] = [];
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all']['powermail_freebie'] =
    \StudioMitte\PowermailFreebie\Hooks\CacheHook::class . '->run';