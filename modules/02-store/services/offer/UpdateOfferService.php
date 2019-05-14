<?php

namespace store\services\offer;

use app\modules\base\components\Service;
use store\domains\offer\Offer;
use store\services\offer\forms\UpdateOfferForm;

/**
 * Class UpdateOfferService
 * @package store\services\offer
 * @property UpdateOfferForm $form
 * @property Offer $model
 */
class UpdateOfferService extends Service
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
