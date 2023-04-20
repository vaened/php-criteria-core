<?php

declare(strict_types=1);

namespace Vaened\CriteriaCore\Keyword;

final class Order
{
    public function __construct(private readonly string $orderBy, private readonly OrderType $orderType)
    {
    }

    public static function desc(string $orderColumn): Order
    {
        return new self($orderColumn, OrderType::Desc);
    }

    public static function asc(string $orderColumn): Order
    {
        return new self($orderColumn, OrderType::Asc);
    }

    public static function none(): Order
    {
        return new Order('', OrderType::None);
    }

    public function orderBy(): string
    {
        return $this->orderBy;
    }

    public function orderType(): OrderType
    {
        return $this->orderType;
    }

    public function isNone(): bool
    {
        return $this->orderType()->isNone();
    }
}
