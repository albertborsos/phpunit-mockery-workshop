<?php

namespace app\tests\unit\modules\tickets\services\ticket\forms;

use PHPUnit\Framework\TestCase;
use tickets\domains\ticket\Ticket;
use tickets\services\ticket\forms\UpdateTicketForm;

/**
 * Class UpdateTicketFormTest
 * @package app\tests\unit\modules\tickets\services\ticket\forms
 * @property \UnitTester $tester
 */
class UpdateTicketFormTest extends TestCase
{
    public function testCanUpdateStatusFromOpenToUnderDevelopment()
    {
        $model = new Ticket([
            'id' => 1,
            'name' => 'My first ticket',
            'description' => 'Description of my first ticket',
            'assignee_id' => 100,
            'status' => Ticket::STATUS_OPEN,
        ]);

        $form = new UpdateTicketForm($model);

        $this->assertTrue($form->load(['status' => Ticket::STATUS_UNDER_DEVELOPMENT], ''));
        $this->assertTrue($form->validate());
    }

    // @todo exercise: add valid test cases

    /**
     * Need to test:
     *  - form validation returns `true`
     *  - errors attribute of the form is empty
     */
    public function testShouldPassValidation()
    {

    }

    // @todo exercise: add invalid test cases

    /**
     * Need to test
     *  - form validation returns `false`
     *  - form has an error message for the expected attribute
     *  - form has only 1 error
     */
    public function testShouldNotPassValidation()
    {

    }
}
