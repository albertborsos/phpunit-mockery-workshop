<?php

namespace store\services\offer;

use app\modules\base\components\Service;
use store\domains\offer\Offer;

class CreateOfferService extends Service
{
    public function execute()
    {
        $model = new Offer();
        $model->setAttributes($this->form->attributes);

        if ($model->save()) {
            return $model->id;
        }

        $this->form->addErrors($model->getErrors());

        return false;
    }
}
