<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use function in_array;
use function Lambdish\Phunctional\filter;
use function Lambdish\Phunctional\map;
use function sprintf;

final class CriteriaPurifier
{
    public array $statements = [];

    public function wrap(Scope|Expression|Filter $criteria): Scope
    {
        $criterias = $this->clean([$criteria]);
        return $criterias->items()[0];
    }

    public function clean(array $criterias): Scopes
    {
        $scopes      = $this->getScopes($criterias);
        $expressions = $this->getExpressions($criterias);
        $filters     = $this->getFilters($criterias);

        if (!$filters->isEmpty()) {
            $expressions->push(new Concept($filters));
        }

        if (!$expressions->isEmpty()) {
            $scopes->push(new LocalScope($expressions));
        }

        return $scopes;
    }

    private function getFilters(array $criterias): Filters
    {
        return Filters::from(
            filter($this->only(Filter::class), $criterias)
        )->filter($this->notRepeated());
    }

    private function getExpressions(array $criterias): Expressions
    {
        return Expressions::from(
            map(
                $this->cleanRepeatExpressions(),
                filter(
                    $this->only(Expression::class),
                    $criterias
                )
            )
        )->filter(fn(Expression $expression) => !$expression->filters()->isEmpty());
    }

    private function getScopes(array $criterias): Scopes
    {
        return Scopes::from(
            map(
                function (Scope $scope): Scope {
                    $expressions = $scope->expressions()->map($this->cleanRepeatExpressions());

                    return $scope->isLocal() ?
                        LocalScope::includes($expressions) :
                        Scoped::of($scope->name(), $expressions);
                },
                filter($this->only(Scope::class), $criterias)
            )
        );
    }

    private function cleanRepeatExpressions(): callable
    {
        return fn(Expression $expression) => new Concept(
            $expression->filters()->filter($this->notRepeated())
        );
    }

    private function notRepeated(): callable
    {
        return function (Filter $filter): bool {
            $statement = $this->compactStatement($filter);

            if (in_array($statement, $this->statements, true)) {
                return false;
            }

            $this->statements[] = $statement;
            return true;
        };
    }

    private function compactStatement(Filter $filter): string
    {
        return sprintf(
            '[%s]<%s>[%s]',
            $filter->field(),
            $filter->operator()->name,
            ValueStringify::stringify($filter->value())
        );
    }

    private function only(string $criteriaType): callable
    {
        return static fn(Scope|Expression|Filter $criteria) => $criteria instanceof $criteriaType;
    }
}
