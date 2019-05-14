<?php

namespace app\tests\unit\modules\tickets\services\ticket;

use tests\unit\fixtures\ticket\UpdateTicketServiceFixture;
use tickets\domains\ticket\Ticket;
use tickets\services\ticket\CreateTicketService;
use tickets\services\ticket\forms\CreateTicketForm;
use tickets\services\ticket\forms\UpdateTicketForm;
use tickets\services\ticket\UpdateTicketService;

/**
 * Class UpdateTicketServiceTest
 * @package app\tests\unit\modules\tickets\services\ticket
 * @property \UnitTester $tester
 */
class UpdateTicketServiceTest extends \Codeception\Test\Unit
{

    public function _fixtures()
    {
        return [
            'tickets' => UpdateTicketServiceFixture::class,
        ];
    }

    /**
     * Need to test:
     *  - only valid cases because form handles the invalid cases
     *  - service execution returns an id, not `false`
     *  - modified attribute values are updated in the database
     *  - not modified attribute values are not updated in the database
     */
    public function testCanUpdateTicket()
    {
        $model = $this->mockTicket();

        $form = new UpdateTicketForm($model);
        $form->setAttributes([
            'name' => 'My updated first ticket',
            'description' => 'Updated description of my first ticket',
        ]);

        $service = new UpdateTicketService($form, $model);
        $ticketId = $service->execute();
        $this->assertNotFalse($ticketId);

        $ticket = Ticket::findOne($ticketId);
        $this->assertInstanceOf(Ticket::class, $ticket);

        // modified attributes has the updated values
        $this->assertEquals('My updated first ticket', $ticket->name);
        $this->assertEquals('Updated description of my first ticket', $ticket->description);
        // not modified attributes has the same values
        $this->assertEquals($model->id, $ticket->id);
        $this->assertEquals($model->assignee_id, $ticket->assignee_id);
        $this->assertEquals($model->owner_id, $ticket->owner_id);
        $this->assertEquals(Ticket::STATUS_OPEN, $ticket->status);
    }

    /**
     * @todo exercise: get ticket from fixtures
     * @return null|Ticket
     */
    private function mockTicket()
    {
        $form = new CreateTicketForm([
            'name' => 'My first ticket',
            'description' => 'Description of my first ticket',
            'assignee_id' => 101,
            'status' => Ticket::STATUS_OPEN,
        ]);

        $service = new CreateTicketService($form);

        return Ticket::findOne($service->execute());
    }
}
