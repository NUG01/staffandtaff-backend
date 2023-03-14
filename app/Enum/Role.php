<?php

namespace App\Enum;

enum Role: int
{
    case ADMIN = 1;
    case RECRUITER = 2;
    case SEEKER = 3;
}
