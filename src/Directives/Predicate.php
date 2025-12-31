<?php
/**
 * @author enea dhack <contact@vaened.dev>
 * @link https://vaened.dev DevFolio
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Directives;

interface Predicate
{
    public function criterias(): array;
}
