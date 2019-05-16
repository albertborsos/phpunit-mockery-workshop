<?php

namespace store\domains\offer\ar;

use billing\domains\invoice\Invoice;
use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $discount
 * @property int $discount_workdays_period
 * @property int $customer_viewed_at
 * @property int $status
 *
 * @property Invoice[] $invoices
 */
abstract class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'discount', 'discount_workdays_period', 'customer_viewed_at', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'discount' => 'Discount',
            'discount_workdays_period' => 'Discount Period (in workdays)',
            'customer_viewed_at' => 'Customer Viewed At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::class, ['offer_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \store\domains\offer\query\OfferQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \store\domains\offer\query\OfferQuery(get_called_class());
    }
}
