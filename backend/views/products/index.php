<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новый товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Показаны позиции <b>{begin, number}-{end, number}</b> из <b>{totalCount, number}</b>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'name_translit',
            //'description:ntext',
            [
                'attribute' => 'description',
                'contentOptions' => ['style' => 'white-space: normal; max-width:300px; overflow:hidden;'],
                'value' => function($data) {
                    return StringHelper::truncate($data->description, 200, '...');
                },
                'format' => 'html'
            ],
            'price',
            'currency',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name;
                }
            ],
            //'image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
