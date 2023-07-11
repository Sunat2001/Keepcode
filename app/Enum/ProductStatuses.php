<?php

namespace App\Enum;

enum ProductStatuses
{
    public const ACTIVE = 'active';
    public const SOLD = 'sold';
    public const ON_RENT = 'on_rent';

    public static function getValues(): array
    {
        return [
            self::ACTIVE,
            self::SOLD,
            self::ON_RENT,
        ];
    }
}
