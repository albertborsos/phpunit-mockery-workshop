<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model store\domains\offer\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'discount_workdays_period')->dropDownList(\store\domains\offer\Offer::periods(), ['prompt' => 'No discount period selected']) ?>

    <?= $form->field($model, 'customer_viewed_at')->widget(\nkovacs\datetimepicker\DateTimePicker::class, [
        'type' => \nkovacs\datetimepicker\DateTimePicker::TYPE_DATE,
        'format' => 'php:Y-m-d',
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(\store\domains\offer\Offer::statuses()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
