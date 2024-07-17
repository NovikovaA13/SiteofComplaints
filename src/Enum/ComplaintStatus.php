<?php

namespace App\Enum;

enum ComplaintStatus: string
{
    case INWAITING = 'inwaiting';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function getLabel(): string
    {
        return match ($this) {
            self::INWAITING => 'In waiting',
            self::ACCEPTED => 'Accepted',
            self::REJECTED => 'Rejected',
        };
    }
}
