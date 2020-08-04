<?php
declare(strict_types=1);

namespace StudioMitte\PowermailFreebie\Hooks;

use StudioMitte\PowermailFreebie\Database\Query\Restriction\FreebieRestriction;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class CacheHook
{

    public function run(array $params, TypoScriptFrontendController $typoScriptFrontendController): void
    {
        if ($count = $this->countFreebieContentOnPage($typoScriptFrontendController->page['uid'])) {
            $message = sprintf('Cache disabled because of %s freebie content records found for EXT:powermail_freebie', $count);
            $typoScriptFrontendController->set_no_cache($message);
        }
    }

    protected function countFreebieContentOnPage(int $pageId): int
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()->removeByType(FreebieRestriction::class);

        $rowCount = $queryBuilder->count('uid')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->neq(
                    'freebie_code',
                    $queryBuilder->createNamedParameter('', \PDO::PARAM_STR)
                ),
                $queryBuilder->expr()->isNotNull(
                    'freebie_code'
                ),
                $queryBuilder->expr()->eq(
                    'pid',
                    $queryBuilder->createNamedParameter($pageId, \PDO::PARAM_INT)
                )
            )
            ->execute()
            ->fetchColumn(0);

        return (int)$rowCount;
    }
}