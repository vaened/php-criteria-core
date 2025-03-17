<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Expression;
use Vaened\CriteriaCore\Directives\Filter;
use Vaened\Support\Types\SecureList;

use function array_merge;
use function count;
use function Lambdish\Phunctional\filter;

final class Expressions extends SecureList
{
    public function __construct(iterable $expressions)
    {
        $filters     = filter(static fn(mixed $item) => $item instanceof Filter, $expressions);
        $expressions = filter(static fn(mixed $item) => !$item instanceof Filter, $expressions);

        parent::__construct(
            array_merge(
                $expressions,
                count($filters) > 1 ? Statements::of($filters) : []
            )
        );
    }

    public static function from(iterable $scopes): self
    {
        return new self($scopes);
    }

    public static function type(): string
    {
        return Expression::class;
    }

    public function push(Expression $expression): void
    {
        $this->items[] = $expression;
    }
}
