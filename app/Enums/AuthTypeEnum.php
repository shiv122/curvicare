<?php

namespace App\Enums;

enum AuthTypeEnum: string
{
    case NEW = 'new';
    case OLD = 'old';
    case NOT_FOUND = 'not_found';
}
