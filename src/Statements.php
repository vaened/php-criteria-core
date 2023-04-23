<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Expression;

final class Statements implements Expression
{
    public function __construct(private readonly Filters $filters)
    {
    }

    public static function of(array $filters): self
    {
        return new self(Filters::from($filters));
    }

    public function filters(): Filters
    {
        return $this->filters;
    }
}
