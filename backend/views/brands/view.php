<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ShopBrands */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Бренды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-brands-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить бренд?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'brandImage',
                'value' => function($data) {
                    $imgSrc = Yii::$app->urlManagerFrontend->createUrl(['/img/catalog/' . $data->getImage()->filePath]);
                    $size   = $data->getImage()->getSizesWhen('x250');
                    return "<img src='{$imgSrc}' width='{$size['width']}' height='{$size['height']}'>";
                },
                'format' => 'html'
            ]
        ],
    ]) ?>

</div>
