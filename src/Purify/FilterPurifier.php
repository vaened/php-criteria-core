<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Purify;

use Vaened\CriteriaCore\Directives\Expression;
use Vaened\CriteriaCore\Directives\Filter;
use Vaened\CriteriaCore\Directives\Scope;
use Vaened\CriteriaCore\Filters;
use Vaened\CriteriaCore\ValueStringify;
use Vaened\Support\Types\ArrayList;

use function in_array;
use function sprintf;

final class FilterPurifier
{
    public array $statements = [];

    public function __construct()
    {
    }

    public function extract(array $criterias): Filters
    {
        return Filters::from(
            ArrayList::from($criterias)
                ->filter($this->onlyFilters())
                ->filter($this->notRepeated())
                ->values()
        );
    }

    public function isRepeat(Filter $filter): bool
    {
        $statement = $this->compactStatement($filter);

        if (in_array($statement, $this->statements, true)) {
            return true;
        }

        $this->statements[] = $statement;

        return false;
    }

    public function notRepeated(): callable
    {
        return fn(Filter $filter) => !$this->isRepeat($filter);
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

    private function onlyFilters(): callable
    {
        return static fn(Scope|Expression|Filter $criteria) => $criteria instanceof Filter;
    }
}
