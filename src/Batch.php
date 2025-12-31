<?php
/**
 * @author enea dhack <contact@vaened.dev>
 * @link https://vaened.dev DevFolio
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore;

use Vaened\CriteriaCore\Directives\Expression;
use Vaened\CriteriaCore\Directives\Filter;
use Vaened\CriteriaCore\Directives\Predicate;
use Vaened\CriteriaCore\Directives\Scope;

final class Batch implements Predicate
{
    public function __construct(private readonly array $criterias)
    {
    }

    public static function group(Filter|Expression|Scope|Predicate ...$criterias): self
    {
        return new self($criterias);
    }

    public static function from(array $criterias): self
    {
        return new self($criterias);
    }

    public function criterias(): array
    {
        return $this->criterias;
    }
}
