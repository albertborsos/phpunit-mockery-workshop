<?php

namespace tickets\services\ticket;

use app\modules\base\components\Service;
use tickets\domains\ticket\Ticket;
use tickets\services\ticket\forms\UpdateTicketForm;

/**
 * Class UpdateTicketService
 * @package tickets\services\ticket
 * @property UpdateTicketForm $form
 * @property Ticket $model
 */
class UpdateTicketService extends Service
{
    public function execute()
    {
        $this->model->setAttributes($this->form->attributes);

        if ($this->model->save()) {
            return $this->model->id;
        }

        $this->form->addErrors($this->model->getErrors());

        return false;
    }
}
