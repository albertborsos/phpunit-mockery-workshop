<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form \billing\services\invoice\forms\CreateInvoiceForm */
/* @var $model billing\domains\invoice\Invoice */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Create Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4">
        <div class="invoice-create">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $form,
            ]) ?>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('index', [
                    'dataProvider' => $dataProvider,
                ]) ?>
            </div>
        </div>
        <?php if ($model): ?>
            <div class="row">
                <div class="col-md-12">
                    <h2><?= $model->serial_number ?> Invoice</h2>
                    <?= $this->render('view', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
