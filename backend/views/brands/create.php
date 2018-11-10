<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ShopBrands */

$this->title = 'Добавить новый бренд';
$this->params['breadcrumbs'][] = ['label' => 'Shop Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-brands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
