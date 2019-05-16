<?php

namespace billing\services\invoice\forms;

use app\modules\base\components\validators\HtmlPurifierFilter;
use billing\domains\invoice\Invoice;
use store\domains\offer\Offer;
use yii\base\Model;
use yii\db\ActiveQuery;

class CreateInvoiceForm extends Model
{
    public $offer_id;
    public $type;
    public $amount;
    public $item;
    public $comment;

    /** @var Offer */
    protected $offer;

    public function __construct(Offer $offer, array $config = [])
    {
        parent::__construct($config);
        $this->offer_id = $offer->id;
        $this->item = $offer->name;
        $this->amount = $offer->getMaxBillableAmount();

        $this->offer = $offer;
    }

    public function rules()
    {
        return [
            [['offer_id', 'type', 'amount', 'item', 'comment'], HtmlPurifierFilter::class],
            [['offer_id', 'type', 'amount', 'item', 'comment'], 'trim'],
            [['offer_id', 'type', 'amount', 'item', 'comment'], 'default'],

            [['offer_id', 'type', 'amount', 'item'], 'required'],

            [['item', 'comment'], 'string'],
            [['type'], 'in', 'range' => array_keys(Invoice::types())],

            [['type'], 'unique', 'targetClass' => Invoice::class, 'targetAttribute' => 'type', 'filter' => function ($query) {
                /** @var ActiveQuery $query */
                return $query->andWhere(['offer_id' => $this->offer_id]);
            }, 'when' => function () {
                return $this->type === Invoice::TYPE_FINAL;
            }],
            [['type'], 'checkInvoiceTypeIsAllowed'],

            [['amount'], 'number', 'min' => 0, 'max' => $this->offer->getMaxBillableAmount(), 'when' => function () {
                return $this->type !== Invoice::TYPE_FULL;
            }],
            [['amount'], 'number', 'min' => $this->offer->getMaxBillableAmount(), 'max' => $this->offer->getMaxBillableAmount(), 'when' => function () {
                return $this->type === Invoice::TYPE_FULL;
            }],

            [['offer_id'], 'exist', 'targetClass' => Offer::class, 'targetAttribute' => 'id'],
        ];
    }

    public function checkInvoiceTypeIsAllowed()
    {
        if ($this->type === Invoice::TYPE_FINAL && !$this->offer->hasDepositInvoice()) {
            $this->addError('type', 'You must create a deposit invoice first');
        }
    }
}
