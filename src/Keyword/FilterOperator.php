<?php

declare(strict_types=1);

namespace Vaened\CriteriaCore\Keyword;

enum FilterOperator
{
    case Equal;

    case NotEqual;

    case Gt;

    case Gte;

    case Lt;

    case Lte;

    case In;

    case NotIn;

    case Contains;

    case StartsWith;

    case EndsWith;

    case Between;

    case NotBetween;
}
