<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Purify;

use Vaened\CriteriaCore\Concept;
use Vaened\CriteriaCore\Expression;
use Vaened\CriteriaCore\Expressions;
use Vaened\CriteriaCore\Filter;
use Vaened\CriteriaCore\Scope;
use Vaened\Support\Types\ArrayList;

final class ExpressionsPurifier
{
    public function __construct(private readonly FilterPurifier $filterPurifier)
    {
    }

    public function extract(array $criterias): Expressions
    {
        return Expressions::from(
            ArrayList::from($criterias)
                ->filter($this->onlyExpressions())
                ->map($this->cleanDuplicatesOfExpressions())
                ->filter($this->notEmpty())
                ->values()
        );
    }

    public function cleanDuplicatesOfExpressions(): callable
    {
        return fn(
            Expression $expression
        ) => $expression->filters()->some($this->anyRepeat()) ?
            new Concept($expression->filters()->filter($this->filterPurifier->notRepeated())) :
            $expression;
    }

    public function anyRepeat(): callable
    {
        return fn(Filter $filter) => $this->filterPurifier->isRepeat($filter);
    }

    private function notEmpty(): callable
    {
        return static fn(Expression $expression) => !$expression->filters()->isEmpty();
    }

    private function onlyExpressions(): callable
    {
        return static fn(Scope|Expression|Filter $criteria) => $criteria instanceof Expression;
    }
}
