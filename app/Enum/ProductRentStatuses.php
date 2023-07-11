<?php

namespace App\Enum;

enum ProductRentStatuses
{
    public const ACTIVE = 'active';
    public const EXPIRED = 'expired';

    public static function getValues(): array
    {
        return [
            self::ACTIVE,
            self::EXPIRED
        ];
    }
}
