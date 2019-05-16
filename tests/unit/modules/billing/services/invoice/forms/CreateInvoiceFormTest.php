<?php

namespace app\tests\unit\modules\billing\services\invoice\forms;

use PHPUnit\Framework\TestCase;

class CreateInvoiceFormTest extends TestCase
{

    // @todo exercise: add valid test cases
    public function validProvider()
    {
        return [];
    }

    /**
     * Need to test:
     *  - form validation returns `true`
     *  - errors attribute of the form is empty
     */
    /**
     * @dataProvider validProvider
     */
    public function testShouldPassValidation()
    {

    }

    // @todo exercise: add invalid test cases
    public function invalidProvider()
    {
        return [];
    }

    /**
     * Need to test
     *  - form validation returns `false`
     *  - form has an error message for the expected attribute
     *  - form has only 1 error
     */
    /**
     * @dataProvider invalidProvider
     */
    public function testShouldNotPassValidation()
    {

    }
}
