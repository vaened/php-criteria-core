<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Keyword\Order;

use function count;
use function Lambdish\Phunctional\each;

final class Criteria
{
    private readonly Order $order;

    public function __construct(
        private readonly Scopes $scopes,
        ?Order                  $order = null,
        private readonly ?int   $limit = null,
        private readonly ?int   $offset = null,
    )
    {
        $this->order = $order ?: Order::none();
    }

    public static function fromArray(array $scopes, Order $order = null): self
    {
        return self::create(Scopes::from($scopes), $order);
    }

    public static function create(Scopes $scopes, Order $order = null, ?int $limit = null): self
    {
        return new self($scopes, $order, $limit);
    }

    public function add(Scope $scope): void
    {
        $this->scopes->push($scope);
    }

    public function attach(array $scopes): void
    {
        each(fn(Scope $scope) => $this->add($scope), $scopes);
    }

    public function isEmpty(): bool
    {
        return count($this->scopes) === 0;
    }

    public function hasOrder(): bool
    {
        return !$this->order->isNone();
    }

    public function scopes(): Scopes
    {
        return $this->scopes;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function limit(): int
    {
        return $this->limit ?: 0;
    }
}
