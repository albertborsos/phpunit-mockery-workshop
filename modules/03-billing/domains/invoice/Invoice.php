<?php

namespace billing\domains\invoice;

class Invoice extends \billing\domains\invoice\ar\Invoice
{
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_FINAL = 'final';
    const TYPE_FULL = 'full';

    public static function types()
    {
        return [
            self::TYPE_DEPOSIT => 'Deposit',
            self::TYPE_FINAL => 'Final',
            self::TYPE_FULL => 'Full',
        ];
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['serial_number'], 'required'],
        ]);
    }
}
