<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Tests;

use Vaened\CriteriaCore\LocalScope;
use Vaened\CriteriaCore\Purifier;
use Vaened\CriteriaCore\Scoped;
use Vaened\CriteriaCore\Scopes;
use Vaened\CriteriaCore\Statements;
use Vaened\CriteriaCore\Tests\Utils\CompanyName;
use Vaened\CriteriaCore\Tests\Utils\PersonDocumentNumber;
use Vaened\CriteriaCore\Tests\Utils\PersonDocumentType;
use Vaened\CriteriaCore\Tests\Utils\PersonIdentification;
use Vaened\CriteriaCore\Tests\Utils\PersonName;

final class CriteriaPurifierTest extends TestCase
{
    public function test_purify_cleans_up_duplicates_and_groups(): void
    {
        $personNameStartsWith       = PersonName::startsWith('Jotaro');
        $personDocumentNumberEquals = PersonDocumentNumber::equals('12345678');
        $personDocumentTypeEquals   = PersonDocumentType::equals(1);
        $personIdentificationAre    = PersonIdentification::are('12345678', 1);
        $companyNameStartsWith      = CompanyName::startsWith('Nintendo');

        $this->assertEquals(
            Scopes::from([
                Scoped::of('company', [
                    Statements::of([
                        $companyNameStartsWith,
                    ]),
                ]),

                LocalScope::includes([
                    $personIdentificationAre,
                    Statements::of([
                        $personNameStartsWith,
                    ]),
                ]),
            ]),
            Purifier::clean([
                $personNameStartsWith,
                $personNameStartsWith,
                $personDocumentNumberEquals,
                $personDocumentTypeEquals,
                $personIdentificationAre,

                Scoped::of('company', [
                    Statements::of([
                        $companyNameStartsWith,
                    ]),
                ]),
            ])
        );
    }
}
