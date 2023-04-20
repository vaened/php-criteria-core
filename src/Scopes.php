<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;


use Vaened\Support\Types\ArrayObject;

/**
 * @extends ArrayObject<int, Scope>
 */
final class Scopes extends ArrayObject
{
    protected function type(): string
    {
        return Scope::class;
    }

    public function push(Scope $scope): void
    {
        $this->items[] = $scope;
    }
}
