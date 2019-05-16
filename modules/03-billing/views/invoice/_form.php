<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model billing\domains\invoice\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ]); ?>

    <?= \yii\bootstrap\Html::errorSummary($model)?>

    <?= $form->field($model, 'type')->dropDownList(\billing\domains\invoice\Invoice::types(), ['prompt' => 'Choose...']) ?>

    <?= $form->field($model, 'amount')->textInput(['class' => 'form-control text-right']) ?>

    <?= $form->field($model, 'item')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
