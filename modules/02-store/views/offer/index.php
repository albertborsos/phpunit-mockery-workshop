<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel store\domains\offer\search\SearchOffer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="offer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Offer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'price:currency',
            'discount:currency',
            'discount_workdays_period',
            'customer_viewed_at:datetime',
            'discountDeadline',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
