<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Purify;

use Vaened\CriteriaCore\Directives\Expression;
use Vaened\CriteriaCore\Directives\Filter;
use Vaened\CriteriaCore\Directives\Scope;
use Vaened\CriteriaCore\LocalScope;
use Vaened\CriteriaCore\Scoped;
use Vaened\CriteriaCore\Scopes;
use Vaened\Support\Types\ArrayList;

final class ScopesPurifier
{
    public function __construct(
        private readonly ExpressionsPurifier $expressionsPurifier,
    ) {
    }

    public function extract(array $criterias): Scopes
    {
        return Scopes::from(
            ArrayList::from($criterias)
                ->filter($this->onlyScopes())
                ->map($this->cleanDuplicatesOfScopes())
                ->filter($this->notEmpty())
                ->values()
        );
    }

    private function cleanDuplicatesOfScopes(): callable
    {
        return function (Scope $scope): Scope {
            $repeat = $scope->expressions()
                ->some(
                    fn(Expression $expression) => $expression->filters()
                        ->some($this->expressionsPurifier->anyRepeat())
                );

            if (!$repeat) {
                return $scope;
            }

            $expressions = $scope->expressions()->map($this->expressionsPurifier->cleanDuplicatesOfExpressions());

            return $scope->isLocal() ?
                LocalScope::includes($expressions) :
                Scoped::of($scope->name(), $expressions);
        };
    }

    private function notEmpty(): callable
    {
        return static fn(Scope $scope) => !$scope->expressions()->isEmpty();
    }

    private function onlyScopes(): callable
    {
        return static fn(Scope|Expression|Filter $criteria) => $criteria instanceof Scope;
    }
}
