<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Keyword\FilterField;
use Vaened\CriteriaCore\Keyword\FilterOperator;
use Vaened\CriteriaCore\Keyword\FilterValue;

final class Statement implements Filter
{
    public function __construct(
        private readonly FilterField    $field,
        private readonly FilterOperator $operator,
        private readonly FilterValue    $value
    ) {
    }

    public static function that(string $fieldName, FilterOperator $operator, mixed $value): self
    {
        return new self(new FilterField($fieldName), $operator, new FilterValue($value));
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
}
