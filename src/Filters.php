<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Filter;
use Vaened\Support\Types\SecureList;

final class Filters extends SecureList
{
    public static function from(iterable $scopes): self
    {
        return new self($scopes);
    }

    public static function type(): string
    {
        return Filter::class;
    }
}
