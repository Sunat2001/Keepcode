<?php

namespace App\Enum;

enum RentHourPeriods
{
    public const FOUR_HOUR = 4;
    public const EIGHT_HOUR = 8;
    public const TWELVE_HOUR = 12;
    public const TWENTY_FOUR_HOUR = 24;

    public static function getValues(): array
    {
        return [
            self::FOUR_HOUR,
            self::EIGHT_HOUR,
            self::TWELVE_HOUR,
            self::TWENTY_FOUR_HOUR,
        ];
    }
}
