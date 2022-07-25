<?php
namespace App\Enums;

enum Status: int
{
    case Pending        = 0;
    case Draft          = 1;
    case Activated      = 2;
    case Deleted        = 3;
}
