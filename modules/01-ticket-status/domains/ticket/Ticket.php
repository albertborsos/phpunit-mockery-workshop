<?php

namespace tickets\domains\ticket;

use yii\behaviors\BlameableBehavior;

class Ticket extends \tickets\domains\ticket\ar\Ticket
{
    const STATUS_OPEN = 1;
    const STATUS_UNDER_DEVELOPMENT = 2;
    const STATUS_SUSPENDED = 3;
    const STATUS_READY_TO_QA = 4;
    const STATUS_QA_REVIEW = 5;
    const STATUS_RESOLVED = 6;
    const STATUS_CLOSED = 7;

    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'owner_id',
                'updatedByAttribute' => false,
            ],
        ];
    }

    public static function statuses()
    {
        return [
            self::STATUS_OPEN              => 'Open',
            self::STATUS_UNDER_DEVELOPMENT => 'Under Development',
            self::STATUS_SUSPENDED         => 'Suspended',
            self::STATUS_READY_TO_QA       => 'Ready to QA',
            self::STATUS_QA_REVIEW         => 'QA Review',
            self::STATUS_RESOLVED          => 'Resolved',
            self::STATUS_CLOSED            => 'Closed',
        ];
    }

    /**
     * @param $currentStatus
     * @return array
     */
    public static function allowedStatuses($currentStatus)
    {
        // @TODO exercise: implement allowed statuses to pass tests
        return static::statuses();
    }
}
