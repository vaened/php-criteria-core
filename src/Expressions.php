<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\Support\Types\ArrayObject;

/**
 * Class Expressions
 *
 * @package Components\Criteria
 * @extends ArrayObject<int, Expression>
 */
final class Expressions extends ArrayObject
{
    public function push(Expression $expression): void
    {
        $this->items[] = $expression;
    }

    protected function type(): string
    {
        return Expression::class;
    }
}
