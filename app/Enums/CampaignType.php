<?php

namespace App\Enums;

enum CampaignType: int
{
    case All            = 1;
    case COMPANY        = 2;
    case JOB_TITLE      = 3;
    case CONTACT        = 4;
}
