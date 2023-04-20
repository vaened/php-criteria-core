<?php

declare(strict_types=1);

namespace Vaened\CriteriaCore\Keyword;

use Stringable;

final class FilterField implements Stringable
{
    public function __construct(private readonly string $name)
    {
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
