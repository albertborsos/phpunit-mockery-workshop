<?php
namespace tests\unit\fixtures\ticket;

class UpdateTicketServiceFixture extends \yii\test\ActiveFixture
{
    public $modelClass = \tickets\domains\ticket\Ticket::class;

    public $dataFile = '@tests/unit/fixtures/ticket/data/update-ticket-service.php';
}
