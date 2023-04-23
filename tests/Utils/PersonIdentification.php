<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Tests\Utils;

use Vaened\CriteriaCore\Directives\Expression;
use Vaened\CriteriaCore\Filters;

final class PersonIdentification implements Expression
{
    public function __construct(
        private readonly string $personDocumentNumber,
        private readonly int    $personDocumentTypeId,
    ) {
    }

    public static function are(string $personDocumentNumber, int $personDocumentTypeId): self
    {
        return new self($personDocumentNumber, $personDocumentTypeId);
    }

    public function filters(): Filters
    {
        return Filters::from([
            PersonDocumentNumber::equals($this->personDocumentNumber),
            PersonDocumentType::equals($this->personDocumentTypeId),
        ]);
    }
}
