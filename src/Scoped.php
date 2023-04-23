<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Scope;

class Scoped implements Scope
{
    public function __construct(private readonly string $relationName, private readonly Expressions $expressions)
    {
    }

    public static function of(string $relationName, array $expressions): static
    {
        return new static($relationName, Expressions::from($expressions));
    }

    final public function isLocal(): bool
    {
        return false;
    }

    public function name(): string
    {
        return $this->relationName;
    }

    public function expressions(): Expressions
    {
        return $this->expressions;
    }
}
