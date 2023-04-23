<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Scope;

final class LocalScope implements Scope
{
    public function __construct(private readonly Expressions $expressions)
    {
    }

    public static function includes(array $expressions): self
    {
        return new self(Expressions::from($expressions));
    }

    public function isLocal(): bool
    {
        return true;
    }

    public function name(): string
    {
        return '(local)';
    }

    public function expressions(): Expressions
    {
        return $this->expressions;
    }
}
