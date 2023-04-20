<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Keyword\FilterField;
use Vaened\CriteriaCore\Keyword\FilterOperator;
use Vaened\CriteriaCore\Keyword\FilterValue;

interface Filter
{
    public function field(): FilterField;

    public function operator(): FilterOperator;

    public function value(): FilterValue;
}
