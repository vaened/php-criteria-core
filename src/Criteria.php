<?php
/**
 * @author enea dhack <enea.so@live.com>
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Scope;
use Vaened\CriteriaCore\Keyword\Order;

use function count;
use function Lambdish\Phunctional\each;

final class Criteria
{
    private readonly Order $order;

    private Scopes $scopes;

    public function __construct(
        array                 $criterias,
        ?Order                $order = null,
        private readonly ?int $limit = null,
        private readonly ?int $offset = null,
    ) {
        $this->scopes = Purifier::clean($criterias);
        $this->order  = $order ?: Order::none();
    }

    public static function fromArray(array $criterias, Order $order = null): self
    {
        return self::create($criterias, $order);
    }

    public static function create(array $criterias, Order $order = null, ?int $limit = null): self
    {
        return new self($criterias, $order, $limit);
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
