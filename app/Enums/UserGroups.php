<?php

declare(strict_types=1);

namespace App\Enums;

enum UserGroups: int
{
    case VALIDATING = 1;
    case GUEST = 2;
    case USER = 3;
    case ADMINISTRATOR = 4;
    case BANNED = 5;
    case MODERATOR = 6;
    case UPLOADER = 7;
    case TRUSTEE = 8;
    case BOT = 9;
    case OWNER = 10;
    case POWERUSER = 11;
    case SUPERUSER = 12;
    case EXTREMEUSER = 13;
    case INSANEUSER = 14;
    case LEECH = 15;
    case VETERAN = 16;
    case SEEDER = 17;
    case ARCHIVIST = 18;
    case INTERNAL = 19;
    case DISABLED = 20;
    case PRUNED = 21;
}