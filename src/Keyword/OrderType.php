<?php

declare(strict_types=1);

namespace Vaened\CriteriaCore\Keyword;

enum OrderType: string
{
    case Asc = 'asc';

    case Desc = 'desc';

    case None = 'none';

    public function isNone(): bool
    {
        return $this === self::None;
    }
}
