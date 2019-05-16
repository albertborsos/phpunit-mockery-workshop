<?php

namespace billing\services\invoice;

use app\modules\base\components\Service;
use billing\components\BillingProvider;
use billing\domains\invoice\Invoice;
use billing\services\invoice\forms\CreateInvoiceForm;
use yii\di\Instance;

/**
 * Class CreateInvoiceService
 * @package billing\services\invoice
 * @property CreateInvoiceForm $form
 */
class CreateInvoiceService extends Service
{
    /**
     * @return bool|int
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function execute()
    {
        $model = new Invoice();

        $model->setAttributes($this->form->attributes);

        /** @var BillingProvider $billingApi */
        $billingApi = Instance::ensure('billingApi', BillingProvider::class);
        $model->serial_number = $billingApi->createInvoice();

        if ($model->save()) {
            $this->updateRelatedInvoices($model);

            return $model->id;
        }

        $this->form->addErrors($model->getErrors());

        return false;
    }

    /**
     * @param CreateInvoiceForm $form
     * @return false|null|string
     */
    private function getRelatedInvoiceId(CreateInvoiceForm $form)
    {
        if ($form->type === Invoice::TYPE_FINAL) {
            return Invoice::find()->select('id')->where([
                'offer_id' => $form->offer_id,
                'type' => Invoice::TYPE_DEPOSIT,
            ])->scalar();
        }

        return null;
    }

    private function updateRelatedInvoices(Invoice $model)
    {
        if ($model->type !== Invoice::TYPE_FINAL) {
            return;
        }

        $invoices = Invoice::find()->where([
            'offer_id' => $model->offer_id,
            'type' => Invoice::TYPE_DEPOSIT,
        ])->all();

        foreach ($invoices as $invoice) {
            $invoice->related_invoice_id = $model->id;
            $invoice->save();
        }
    }
}
