<?php

declare(strict_types=1);

namespace Vaened\CriteriaCore\Keyword;

use Stringable;

final class OrderBy implements Stringable
{
    public function __construct(private readonly string $order)
    {
    }

    public static function nothing(): self
    {
        return new self('');
    }

    public function __toString(): string
    {
        return $this->order;
    }
}
