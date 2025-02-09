<?php

declare(strict_types=1);

namespace CuyZ\Valinor\Type\Types;

use CuyZ\Valinor\Type\Type;
use CuyZ\Valinor\Utility\IsSingleton;

/** @api */
final class NullType implements Type
{
    use IsSingleton;

    public function accepts($value): bool
    {
        return $value === null;
    }

    public function matches(Type $other): bool
    {
        if ($other instanceof UnionType) {
            return $other->isMatchedBy($this);
        }

        return $other instanceof self
            || $other instanceof MixedType;
    }

    public function __toString(): string
    {
        return 'null';
    }
}
