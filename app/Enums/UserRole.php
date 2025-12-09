<?php

namespace App\Enums;

enum UserRole: string
{
    case Client = 'client';
    case Administrator = 'administrator';
    case Trucker = 'trucker';
}
