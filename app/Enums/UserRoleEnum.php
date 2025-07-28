<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case Admin = 'admin';
    case Staff = 'staff';

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }
}