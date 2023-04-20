<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

interface Scope
{
    public function isLocal(): bool;

    public function name(): string;

    public function expressions(): Expressions;
}
