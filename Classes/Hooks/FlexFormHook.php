<?php
declare(strict_types=1);

namespace StudioMitte\PowermailFreebie\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class FlexFormHook
{

    /**
     * @param array $dataStructure
     * @param array $identifier
     * @return array
     */
    public function parseDataStructureByIdentifierPostProcess(array $dataStructure, array $identifier): array
    {
        if ($identifier['type'] === 'tca' && $identifier['tableName'] === 'tt_content' && $identifier['dataStructureKey'] === 'powermail_pi1,list') {
            $file = PATH_site . '/typo3conf/ext/powermail_freebie/Configuration/FlexForms/PowermailFreebie.xml';
            $content = @file_get_contents($file);
            if ($content) {
                $dataStructure['sheets']['powermailFreebie'] = GeneralUtility::xml2array($content);
            }
        }
        return $dataStructure;
    }
}