<?php
declare(strict_types=1);

namespace StudioMitte\PowermailFreebie\DataProcessor;

use In2code\Powermail\DataProcessor\AbstractDataProcessor;
use StudioMitte\PowermailFreebie\Utility\SessionUtility;

class SessionDataProcessor extends AbstractDataProcessor
{

    public function saveSessionDataProcessor(): void
    {
        $uniqueHash = $this->getUniqueHash($this->getSettings());
        if ($uniqueHash && $this->getActionMethodName() === 'createAction') {

            SessionUtility::save($uniqueHash, 1);
        }
    }

    protected function getUniqueHash(array $settings): string
    {
        $enabled = $settings['powermailFreebie']['enabled'] ?? false;
        if (!$enabled) {
            return '';
        }

        $hash = $settings['powermailFreebie']['uniqueId'] ?? '';
        return trim($hash);
    }

}