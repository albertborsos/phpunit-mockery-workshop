<?php

namespace billing\domains\invoice\ar;

use store\domains\offer\Offer;
use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property int $related_invoice_id
 * @property int $offer_id
 * @property string $serial_number
 * @property string $type
 * @property int $amount
 * @property string $item
 * @property string $comment
 *
 * @property Offer $offer
 * @property Invoice $relatedInvoice
 * @property Invoice[] $invoices
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['related_invoice_id', 'offer_id', 'amount'], 'integer'],
            [['serial_number', 'type', 'item', 'comment'], 'string', 'max' => 255],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::class, 'targetAttribute' => ['offer_id' => 'id']],
            [['related_invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::class, 'targetAttribute' => ['related_invoice_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'related_invoice_id' => 'Related Invoice ID',
            'offer_id' => 'Offer ID',
            'serial_number' => 'Serial Number',
            'type' => 'Type',
            'amount' => 'Amount',
            'item' => 'Item',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::class, ['id' => 'offer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelatedInvoice()
    {
        return $this->hasOne(Invoice::class, ['id' => 'related_invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::class, ['related_invoice_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \billing\domains\invoice\query\InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \billing\domains\invoice\query\InvoiceQuery(get_called_class());
    }
}
