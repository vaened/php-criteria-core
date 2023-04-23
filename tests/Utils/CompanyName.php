<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Tests\Utils;

use Vaened\CriteriaCore\Directives\Filter;
use Vaened\CriteriaCore\Keyword\FilterField;
use Vaened\CriteriaCore\Keyword\FilterOperator;
use Vaened\CriteriaCore\Keyword\FilterValue;

final class CompanyName implements Filter
{
    private readonly FilterValue $description;

    private function __construct(private readonly FilterOperator $operator, string $fullname)
    {
        $this->description = new FilterValue($fullname);
    }

    public static function startsWith(string $fullname): self
    {
        return new self(FilterOperator::StartsWith, $fullname);
    }

    public function field(): FilterField
    {
        return new FilterField('full_name');
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): FilterValue
    {
        return $this->description;
    }
}
