<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\Support\Types\ArrayObject;

/**
 * Class Filters
 *
 * @package Components\Criteria
 * @extends ArrayObject<int, Filter>
 */
final class Filters extends ArrayObject
{
    protected function type(): string
    {
        return Filter::class;
    }
}
