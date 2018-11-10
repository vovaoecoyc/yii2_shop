<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopProducts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-products-view">
    <? if (Yii::$app->session->hasFlash('createNewProduct')) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= Yii::$app->session->getFlash('createNewProduct') ?>
        </div>
    <? } ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Вы действительно хотите удалить товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?
        $imgSrc = Yii::$app->urlManagerFrontend->createUrl(['/img/catalog/' . $model->getImage()->filePath]);
        $size   = $model->getImage()->getSizesWhen('x300');
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'name_translit',
            'description:html',
            'price',
            'currency',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name;
                }
            ],
            [
                'attribute' => 'imageLoad',
                'value' => "<img width='{$size['width']}' height='{$size['height']}' src='{$imgSrc}'",
                'format' => 'html'
            ],
        ],
    ]) ?>

</div>
