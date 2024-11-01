<?php

namespace App\Enums;

abstract class Enum
{
    protected $value;

    public function __construct($value)
    {
        if (!static::isValid($value)) {
            throw new \InvalidArgumentException("Nilai '{$value}' bukan merupakan nilai yang valid untuk enum '" . static::class . "'");
        }

        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public static function isValid($value)
    {
        $reflector = new \ReflectionClass(static::class);
        return in_array($value, $reflector->getConstants(), true);
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
