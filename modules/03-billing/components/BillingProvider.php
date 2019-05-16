<?php

namespace billing\components;

use yii\base\Component;
use yii\base\Exception;
use yii\helpers\FileHelper;

class BillingProvider extends Component
{
    const PATH = '@runtime/billing/last-invoice-number.log';

    public function init()
    {
        parent::init();
        if (YII_ENV === 'test') {
            throw new Exception('Billing API is not accessible from tests!');
        }
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function createInvoice()
    {
        return 'INV-' . str_pad($this->getInvoiceSerialNumber(), 6, '0', STR_PAD_LEFT);
    }

    /**
     * @return int
     * @throws \yii\base\Exception
     */
    private function getInvoiceSerialNumber(): int
    {
        $path = \Yii::getAlias(self::PATH);
        FileHelper::createDirectory(dirname($path));
        $lastInvoiceSerialNumber = is_file($path) ? file_get_contents($path) : 0;
        $newInvoiceSerialNumber = intval($lastInvoiceSerialNumber) + 1;
        file_put_contents($path, $newInvoiceSerialNumber);

        return $newInvoiceSerialNumber;
    }
}
