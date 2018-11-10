<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бренды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-brands-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'firstPageLabel' => 'Первая страница',
            'lastPageLabel'  => 'Последняя страница'
        ],
        'summary' => 'Показаны позиции <b>{begin, number}-{end, number}</b> из <b>{totalCount, number}</b>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'attribute' => 'imageBrand',
                'label' => 'Картинка',
                'value' => function($data) {
                    $imgSrc = Yii::$app->urlManagerFrontend->createUrl(['/img/catalog/' . $data->getImage()->filePath]);
                    $size   = $data->getImage()->getSizesWhen('x200');
                    return "<img width='{$size['width']}' height='{$size['height']}' src='{$imgSrc}' alt='{$data->name}'>";
                },
                'format' => 'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
