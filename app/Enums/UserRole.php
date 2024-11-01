<?php

namespace App\Enums;

class UserRole extends Enum
{
    const User = 0;
    const Merchant = 1;
    const Admin = 2;

    public static function fromConstant($constant)
    {
        $class = new \ReflectionClass(__CLASS__);
        $constants = $class->getConstants();

        if (in_array($constant, $constants)) {
            return new static($constant);
        }

        throw new \InvalidArgumentException("Nilai '{$constant}' bukan merupakan konstanta yang valid untuk UserRole.");
    }
}
