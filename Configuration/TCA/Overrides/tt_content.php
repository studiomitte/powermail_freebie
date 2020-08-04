<?php


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'powermail_freebie',
    'unset',
    'LLL:EXT:powermail_freebie/Resources/Private/Language/locallang.xlf:tt_content.plugin.freebie_unset'
);

$newColumns = [
    'freebie_code' => [
        'label' => 'LLL:EXT:powermail_freebie/Resources/Private/Language/locallang.xlf:tt_content.freebie_code',
        'config' => [
            'type' => 'input',
            'eval' => 'trim'
        ]
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $newColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content',
    'access', '--linebreak--,freebie_code');

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['powermailfreebie_unset'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['powermailfreebie_unset'] = 'freebie_code';