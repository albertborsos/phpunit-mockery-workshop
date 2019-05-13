<?php

namespace tickets\domains\ticket;

class Ticket extends \tickets\domains\ticket\ar\Ticket
{
    const STATUS_OPEN = 1;
    const STATUS_UNDER_DEVELOPMENT = 1;
    const STATUS_SUSPENDED = 1;
    const STATUS_READY_TO_QA = 1;
    const STATUS_RESOLVED = 1;

    public static function statuses()
    {
        return [
            self::STATUS_OPEN              => 'Open',
            self::STATUS_UNDER_DEVELOPMENT => 'Under Development',
            self::STATUS_SUSPENDED         => 'Suspended',
            self::STATUS_READY_TO_QA       => 'Ready to QA',
            self::STATUS_RESOLVED          => 'Resolved',
        ];
    }
}
