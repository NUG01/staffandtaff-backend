<?php

namespace App\Enum;

enum UserRoleEnum: int
{
    case ADMIN = 1;
    case RECRUITER = 2;
    case SEEKER = 3;
}
