<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Purify\ExpressionsPurifier;
use Vaened\CriteriaCore\Purify\FilterPurifier;
use Vaened\CriteriaCore\Purify\ScopesPurifier;

final class Purifier
{
    public static function clean(array $criterias): Scopes
    {
        $filtersPurifier     = new FilterPurifier();
        $expressionsPurifier = new ExpressionsPurifier($filtersPurifier);
        $scopesPurifier      = new ScopesPurifier($expressionsPurifier);

        $scopes      = $scopesPurifier->extract($criterias);
        $expressions = $expressionsPurifier->extract($criterias);
        $filters     = $filtersPurifier->extract($criterias);

        if (!$filters->isEmpty()) {
            $expressions->push(new Statements($filters));
        }

        if (!$expressions->isEmpty()) {
            $scopes->push(new LocalScope($expressions));
        }

        return $scopes;
    }
}
