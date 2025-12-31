<?php
/**
 * @author enea dhack <contact@vaened.dev>
 * @link https://vaened.dev DevFolio
 */

declare(strict_types=1);

namespace Vaened\CriteriaCore\Purify;

use Vaened\CriteriaCore\Predicate;

final class PredicateFlattener
{
    public static function unpack(array $criterias): array
    {
        $unpacked = [];

        foreach ($criterias as $criteria) {
            if ($criteria instanceof Predicate) {
                $unpacked = array_merge($unpacked, self::unpack($criteria->criterias()));
            } else {
                $unpacked[] = $criteria;
            }
        }

        return $unpacked;
    }
}
