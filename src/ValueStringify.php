<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Keyword\FilterValue;

use function implode;
use function is_array;
use function is_bool;

final class ValueStringify
{
    public static function stringify(FilterValue $value): string
    {
        $primitive = $value->primitive();

        return match (true) {
            $value->isNull()     => 'NULL',
            is_bool($primitive)  => $primitive ? 'TRUE' : 'FALSE',
            is_array($primitive) => implode(',', $primitive),
            default              => (string)$primitive
        };
    }
}
