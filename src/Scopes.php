<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Scope;
use Vaened\Support\Types\SecureList;

final class Scopes extends SecureList
{
    public static function from(iterable $scopes): self
    {
        return new self($scopes);
    }

    protected static function type(): string
    {
        return Scope::class;
    }

    public function push(Scope $scope): void
    {
        $this->items[] = $scope;
    }
}
