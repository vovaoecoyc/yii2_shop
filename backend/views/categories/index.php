<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории интернет-магазина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать новую категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Показаны позиции <b>{begin, number}-{end, number}</b> из <b>{totalCount, number}</b>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'cat_name_translit',
            [
                'attribute' => 'parent_section',
                'value' => function($data) {
                    return $data->categories->name ? $data->categories->name : Yii::$app->params['rootSection'];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
