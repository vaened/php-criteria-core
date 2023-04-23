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

final class PersonDocumentNumber implements Filter
{
    private readonly FilterValue $value;

    private function __construct(private readonly FilterOperator $operator, string|array $documentNumber)
    {
        $this->value = new FilterValue($documentNumber);
    }

    public static function equals(string $documentNumber): self
    {
        return new self(FilterOperator::Equal, $documentNumber);
    }

    public static function in(array $documentNumbers): self
    {
        return new self(FilterOperator::In, $documentNumbers);
    }

    public function field(): FilterField
    {
        return new FilterField('document_number');
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
