<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = Yii::$app->params['order'] . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                }
            ],
            //'quantity',
            //'summ',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return ((int)$data->status === 0) ? '<span class="text-danger">Обрабатывается</span>' :
                        '<span class="text-success">Оплачен</span>';
                },
                'format' => 'html'
            ],
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>
    <h3 class="text-center">Список товаров в заказе:</h3>

        <table class="table text-center table-striped table-bordered order-items">
        <tbody>
        <? foreach ($model->orderList as $item) { ?>
            <tr>
                <td class="col-md-2">
                    <div class="item-image" style="background-image: url(<?= Yii::getAlias('@front/img/catalog/' . $item->product->image) ?>)"></div>
                </td>
                <td class="col-md-6">
                    <div class="item-name">
                        <h4><a href="<?= Yii::$app->urlManagerFrontend->createUrl(['catalog/product', 'cat' => $item->product->categories->cat_name_translit, 'prod' => $item->product->name_translit]) . '/' ?>">
                                <?= $item->prod_name ?></a>
                        </h4>
                    </div>
                </td>
                <td class="col-md-4">
                    &#8381;<?= $item->price ?>
                </td>
            </tr>
        <? } ?>
        <tr>
            <td style="visibility: hidden;"></td>
            <td colspan="2"><h4>Итого</h4></td>
        </tr>
        <tr>
            <td style="visibility: hidden;"></td>
            <td>Всего товаров</td>
            <td><?= $model->quantity ?></td>
        </tr>
        <tr>
            <td style="visibility: hidden;"></td>
            <td>На сумму</td>
            <td>&#8381;<?= $model->summ ?></td>
        </tr>
        </tbody>
        </table>

</div>
