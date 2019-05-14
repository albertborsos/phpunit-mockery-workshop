<?php

namespace app\tests\unit\modules\store\domains\offer;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use store\domains\offer\Offer;

class OfferTest extends TestCase
{
    public function deadlineProvider()
    {
        return [
        ];
    }

    /**
     * @dataProvider deadlineProvider
     * @param $customerViewedAt
     * @param $period
     * @param $expectedDeadline
     * @throws \yii\base\InvalidConfigException
     */
    public function testDiscountDeadlineIsCorrect($customerViewedAt, $period, $expectedDeadline)
    {
        $model = new Offer([
            'customer_viewed_at' => Carbon::parse($customerViewedAt)->timestamp,
            'discount_workdays_period' => $period,
        ]);

        $this->assertEquals($expectedDeadline, $model->getDiscountDeadline());
    }
}
