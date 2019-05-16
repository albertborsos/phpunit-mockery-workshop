<?php

namespace tickets\services\ticket;

use app\modules\base\components\Service;
use tickets\domains\ticket\Ticket;
use tickets\services\ticket\forms\CreateTicketForm;

/**
 * Class CreateTicketService
 * @package tickets\services\ticket
 * @property CreateTicketForm $form
 */
class CreateTicketService extends Service
{
    public function execute()
    {
        $model = new Ticket();

        $model->setAttributes($this->form->attributes);

        if ($model->save()) {
            return $model->id;
        }

        $this->form->addErrors($model->getErrors());

        return false;
    }
}
