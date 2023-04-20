<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Keyword\FilterField;
use Vaened\CriteriaCore\Keyword\FilterOperator;
use Vaened\CriteriaCore\Keyword\FilterValue;

/**
 * Class SelfContainedExpression
 *
 * Represents a single-valued expression.
 *
 * @package Components\Criteria
 */
abstract class SingleFilterExpression implements Expression, Filter
{
    private readonly FilterField $field;

    protected function __construct(
        string                          $field,
        private readonly FilterOperator $operator,
        private readonly FilterValue    $value,
    )
    {
        $this->field = new FilterField($field);
    }

    public function field(): FilterField
    {
        return $this->field;
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): FilterValue
    {
        return $this->value;
    }

    public function filters(): Filters
    {
        return Filters::from([$this]);
    }
}
