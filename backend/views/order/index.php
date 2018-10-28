<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
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

            'id',
            'user_id',
            'created_at',
            'updated_at',
            [
                'attribute' => 'delivery_id',
                'value' => function($data) {
                    return $data->delivery->name;
                }
            ],
            [
                'attribute' => 'paysystem_id',
                'value' => function($data) {
                    return $data->paySystem->name;
                },
                //'format' => 'html'
            ],
            'quantity',
            //'summ',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return ((int)$data->status === 0) ? '<span class="text-danger">Обрабатывается</span>' :
                        '<span class="text-success">Оплачен</span>';
                },
                'format' => 'html'
            ],
            //'name',
            //'email:email',
            //'phone',
            //'address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<script>
    window.onload = function(){
        $('.orders-index a[title=Delete]').data('confirm', 'Вы действительно хотите удалить заказ?')
    };
</script>

