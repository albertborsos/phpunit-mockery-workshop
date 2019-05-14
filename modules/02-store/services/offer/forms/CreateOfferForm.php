<?php

namespace store\services\offer\forms;

use app\modules\base\components\validators\HtmlPurifierFilter;
use Carbon\Carbon;
use yii\base\Model;

class CreateOfferForm extends Model
{
    public $name;
    public $price;
    public $discount;
    public $discount_workdays_period;
    public $customer_viewed_at;
    public $status;

    public function rules()
    {
        return [
            [['name', 'price', 'discount', 'discount_workdays_period', 'customer_viewed_at', 'status'], HtmlPurifierFilter::class],
            [['name', 'price', 'discount', 'discount_workdays_period', 'customer_viewed_at', 'status'], 'trim'],
            [['name', 'price', 'discount', 'discount_workdays_period', 'customer_viewed_at', 'status'], 'default'],

            [['name', 'price', 'status'], 'required'],

            [['name'], 'string'],
            [['price', 'discount', 'discount_workdays_period', 'status'], 'integer'],
            [['customer_viewed_at'], 'date', 'format' => 'php:Y-m-d'],

            [['discount', 'discount_workdays_period'], 'required', 'when' => function () {
                return !empty($this->discount) || !empty($this->discount_workdays_period);
            }],

            [['customer_viewed_at'], 'required', 'when' => function () {
                return !empty($this->discount) || !empty($this->discount_workdays_period);
            }],

            [['customer_viewed_at'], 'convertToTimestamp'],
        ];
    }

    public function convertToTimestamp($attribute)
    {
        $this->$attribute = Carbon::parse($this->$attribute)->timestamp;
    }
}
