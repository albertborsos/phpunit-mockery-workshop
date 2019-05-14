<?php
return [
    'ticket1' => [
        'id' => 1,
        'name' => 'My first ticket',
        'description' => 'Description of my first ticket',
        'assignee_id' => 101,
        'owner_id' => 100,
        'status' => \tickets\domains\ticket\Ticket::STATUS_OPEN,
    ],
];
