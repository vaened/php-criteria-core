<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Expression;
use Vaened\Support\Types\SecureList;

final class Expressions extends SecureList
{
    public static function from(iterable $scopes): self
    {
        return new self($scopes);
    }

    public function push(Expression $expression): void
    {
        $this->items[] = $expression;
    }

    protected static function type(): string
    {
        return Expression::class;
    }
}
