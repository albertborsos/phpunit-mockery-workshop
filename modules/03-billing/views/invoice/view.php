<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model billing\domains\invoice\Invoice */
?>
<div class="invoice-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'type',
            'amount:currency',
            [
                'label' => 'Items',
                'format' => 'raw',
                'value' => implode('<br />', array_merge(\yii\helpers\ArrayHelper::getColumn($model->invoices, function ($item) {
                    return $item->serial_number . ' ' . $item->item . ' (' . \billing\domains\invoice\Invoice::types()[$item->type] . ' Invoice)';
                }), [$model->item])),
            ],
            'comment',
        ],
    ]) ?>
</div>
