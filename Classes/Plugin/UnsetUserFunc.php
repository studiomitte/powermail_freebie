<?php

declare(strict_types=1);

namespace StudioMitte\PowermailFreebie\Plugin;

use StudioMitte\PowermailFreebie\Utility\SessionUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class UnsetUserFunc extends ContentObjectRenderer
{

    /** @var ContentObjectRenderer */
    protected $cObj;

    public function run($content, $conf): void
    {

        $this->getTyposcriptFrontendController()->set_no_cache('No caching due to freebie restriction');
        $freebieCode = $this->cObj->data['freebie_code'] ?? '';
        if (!empty($freebieCode)) {
            SessionUtility::remove($freebieCode);
        }
    }

    protected function getTyposcriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}