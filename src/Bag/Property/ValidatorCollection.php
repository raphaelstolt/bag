<?php

declare(strict_types=1);

namespace Bag\Property;

use Bag\Attributes\Validation\Rule;
use Illuminate\Support\Collection;
use ReflectionAttribute;

class ValidatorCollection extends Collection
{
    public static function create(\ReflectionParameter|\ReflectionProperty $property): self
    {
        $validators = collect($property->getAttributes(Rule::class, ReflectionAttribute::IS_INSTANCEOF))->map(function (ReflectionAttribute $attribute) {
            return $attribute->newInstance()->rule;
        });

        return new self($validators);
    }
}
