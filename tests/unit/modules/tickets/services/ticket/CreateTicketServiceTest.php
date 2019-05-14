<?php

namespace app\tests\unit\modules\tickets\services\ticket;

use PHPUnit\Framework\TestCase;
use tickets\domains\ticket\Ticket;
use tickets\services\ticket\CreateTicketService;
use tickets\services\ticket\forms\CreateTicketForm;

class CreateTicketServiceTest extends TestCase
{
    /**
     * Need to test:
     *  - only valid cases because form handles the invalid cases
     *  - service execution returns an id, not `false`
     *  - created model has the same values as in the form model
     */
    public function testCanSaveTicket()
    {
        $form = new CreateTicketForm([
            'name' => 'My first ticket',
            'description' => 'Description of my first ticket',
            'assignee_id' => 101,
            'status' => Ticket::STATUS_OPEN,
        ]);

        $service = new CreateTicketService($form);

        $ticketId = $service->execute();

        $this->assertNotFalse($ticketId);
        $ticket = Ticket::findOne($ticketId);
        $this->assertInstanceOf(Ticket::class, $ticket);
//        $this->assertEquals('My fist ticket', $ticket->name);
//        $this->assertEquals('Descripton of my first ticket', $ticket->description);
//        $this->assertEquals(100, $ticket->assignee_id);
        $this->assertEquals(Ticket::STATUS_OPEN, $ticket->status);
    }
}
