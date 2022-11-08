<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserRoleEnum extends Enum
{
    public const STUDENT = 1;

    public static function getArrayView(): array
    {
        return [
            'Student'  => self::STUDENT,
        ];
    }
}
