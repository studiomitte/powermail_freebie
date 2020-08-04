<?php
declare(strict_types=1);

namespace StudioMitte\PowermailFreebie\Database\Query\Restriction;


use StudioMitte\PowermailFreebie\Utility\SessionUtility;
use TYPO3\CMS\Core\Database\Query\Expression\CompositeExpression;
use TYPO3\CMS\Core\Database\Query\Expression\ExpressionBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\EnforceableQueryRestrictionInterface;
use TYPO3\CMS\Core\Database\Query\Restriction\QueryRestrictionInterface;

class FreebieRestriction implements QueryRestrictionInterface, EnforceableQueryRestrictionInterface
{
    /**
     * @inheritDoc
     */
    public function isEnforced(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function buildExpression(array $queriedTables, ExpressionBuilder $expressionBuilder): CompositeExpression
    {
        $constraints = [];
        foreach ($queriedTables as $tableAlias => $tableName) {
            if (TYPO3_MODE === 'FE' && $tableName === 'tt_content') {
                $hashes = $this->getAllHashes();
                $subConstraints = [
                    $expressionBuilder->eq(
                        $tableAlias . '.freebie_code',
                        $expressionBuilder->literal('')
                    ),
                ];
                foreach ($hashes as $hash => $value) {
                    $subConstraints[] = $expressionBuilder->eq(
                        $tableAlias . '.freebie_code',
                        $expressionBuilder->literal($hash)
                    );
                }

                $constraints[] = $expressionBuilder->orX(...$subConstraints);
            }

        }
        return $expressionBuilder->andX(...$constraints);
    }

    protected function getAllHashes(): array
    {
        return SessionUtility::getAll();
    }
}