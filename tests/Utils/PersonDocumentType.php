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

final class PersonDocumentType implements Filter
{
    private readonly FilterValue $value;

    private function __construct(private readonly FilterOperator $operator, int|array $documentTypeId)
    {
        $this->value = new FilterValue($documentTypeId);
    }

    public static function equals(int $documentTypeId): self
    {
        return new self(FilterOperator::Equal, $documentTypeId);
    }

    public static function in(array $documentTypeIds): self
    {
        return new self(FilterOperator::In, $documentTypeIds);
    }

    public function field(): FilterField
    {
        return new FilterField('document_type_id');
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
