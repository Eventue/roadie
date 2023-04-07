<?php

namespace App\Domain\User;

enum Roles: string
{
    case ADMIN = 'admin';
    case ORGANIZER = 'organizer';
    case USER = 'user';

    public static function all(): array
    {
        return [
            self::ADMIN->value,
            self::ORGANIZER->value,
            self::USER->value,
        ];
    }
}
