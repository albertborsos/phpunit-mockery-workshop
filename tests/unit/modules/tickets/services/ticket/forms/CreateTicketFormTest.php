<?php

namespace app\tests\unit\modules\tickets\services\ticket\forms;

use PHPUnit\Framework\TestCase;
use tickets\domains\ticket\Ticket;
use tickets\services\ticket\forms\CreateTicketForm;

class CreateTicketFormTest extends TestCase
{
    /** @test */
    public function canSaveWithOpenStatus()
    {
        $form = new CreateTicketForm([
            'name' => 'My first ticket',
            'description' => 'Description of my first ticket',
            'assignee_id' => 100,
            'status' => Ticket::STATUS_OPEN,
        ]);

        $this->assertTrue($form->validate());
    }

    // @todo exercise: add valid test cases
    // @todo exercise: add invalid test cases
}
