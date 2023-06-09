<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Directives;

use Vaened\CriteriaCore\Filters;

interface Expression
{
    public function filters(): Filters;
}
