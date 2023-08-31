<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Scope;
use Vaened\Support\Types\AbstractList;

class Scoped implements Scope
{
    public function __construct(private readonly string $name, private readonly Expressions $expressions)
    {
    }

    public static function of(string $name, iterable $expressions): static
    {
        return new static($name, Expressions::from($expressions));
    }

    public static function as(string $name): static
    {
        return new static($name, new Expressions(AbstractList::Empty));
    }

    final public function isLocal(): bool
    {
        return false;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function expressions(): Expressions
    {
        return $this->expressions;
    }
}
