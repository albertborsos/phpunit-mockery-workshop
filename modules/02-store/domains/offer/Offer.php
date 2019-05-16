<?php

namespace store\domains\offer;

use billing\domains\invoice\Invoice;
use Carbon\Carbon;
use store\Module;

class Offer extends \store\domains\offer\ar\Offer
{
    const STATUS_OFFER = 0;
    const STATUS_ORDERED = 1;

    public $discount_deadline;

    public static function periods()
    {
        $periods = [];
        for ($i = 1; $i <= 8; $i++) {
            $periods[$i] = \Yii::t('app', '{period, plural, one {# workday} other {# workdays}}', [
                'period' => $i,
            ]);
        }

        return $periods;
    }

    public static function statuses()
    {
        return [
            self::STATUS_OFFER => 'Offer',
            self::STATUS_ORDERED => 'Ordered',
        ];
    }

    public function getDiscountDeadline()
    {
        return $this->calculateDeadline();
    }

    private function calculateDeadline()
    {
        $dayOfWeekWhenCustomerSawOffer = Carbon::parse($this->customer_viewed_at)->dayOfWeekIso;
        $numberOfDiscountWorkdays = intval($this->discount_workdays_period);

        $endDayNum = $dayOfWeekWhenCustomerSawOffer + 1;
        $endDayNum = $endDayNum > 7 ? 1 : $endDayNum;

        $counter = 1;
        while ($counter < $numberOfDiscountWorkdays || ($counter >= $numberOfDiscountWorkdays && $endDayNum >= 7)) {
            if (Module::CLOSE_AT_BY_DAY_NUM[$endDayNum] === null) {
                //  if it is not a workday, then increase days of the offer
                $numberOfDiscountWorkdays++;
            }
            //  increase day of the week
            $endDayNum++;
            if ($endDayNum > 7) {
                $endDayNum = 1;
            }
            $counter++;
        }

        return Carbon::parse($this->customer_viewed_at)->addDays($numberOfDiscountWorkdays)->setTimeFromTimeString(Module::CLOSE_AT_BY_DAY_NUM[$endDayNum])->format('Y-m-d H:i');
    }

    public function getMaxBillableAmount()
    {
        if (empty($this->invoices)) {
            return $this->price;
        }

        return $this->price - $this->getInvoices()->sum('amount');
    }

    public function hasDepositInvoice()
    {
        return $this->getInvoices()->where(['type' => Invoice::TYPE_DEPOSIT])->exists();
    }
}
