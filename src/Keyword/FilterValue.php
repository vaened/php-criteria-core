<?php

declare(strict_types=1);

namespace Vaened\CriteriaCore\Keyword;

use BackedEnum;

use function is_array;
use function Lambdish\Phunctional\map;

class FilterValue
{
    public function __construct(private readonly BackedEnum|null|string|int|float|bool|array $value)
    {
    }

    public static function null(): static
    {
        return new static(null);
    }

    public function primitive(): null|string|int|float|bool|array
    {
        if (is_array($this->value)) {
            return map(fn($value) => $this->format($value), $this->value);
        }

        return $this->format($this->value);
    }

    public function isNull(): bool
    {
        return $this->value === null;
    }

    private function format(BackedEnum|null|string|int|float|bool|array $value): null|string|int|float|bool|array
    {
        return $value instanceof BackedEnum ? $value->value : $value;
    }
}
