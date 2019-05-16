<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
?>
<div class="invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'serial_number',
            [
                'header' => 'Related Invoice',
                'attribute' => 'relatedInvoice.serial_number',
            ],
            'type',
            'amount:currency',
            //'item',
            //'comment',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return \yii\helpers\Url::to(['/billing/invoice/create', 'offer' => $model->offer_id, 'invoice' => $model->id]);
                    }

                    return (new \yii\grid\ActionColumn())->createUrl($action, $model, $key, $index);
                },
            ],
        ],
    ]); ?>


</div>
