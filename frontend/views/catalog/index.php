<?php
/* @var $this yii\web\View */

use frontend\components\widgets\CatalogMenuWidget;
use frontend\components\widgets\CatalogList;

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'url'   => ['catalog/index']
];
?>

<div class="catalog-wrapper">
    <div class="catalog-head">
        <?=CatalogMenuWidget::widget()?>
    </div>
    <div class="catalog-content">
        <div class="product-big-title-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-bit-title text-center">
                            <h2><?= $category_name ?>(<?= $count ?>)</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-product-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                    <?= CatalogList::widget([
                        'products' => $products,
                        'pages'    => $pages
                    ]);?>
            </div>
        </div>
    </div>
</div>