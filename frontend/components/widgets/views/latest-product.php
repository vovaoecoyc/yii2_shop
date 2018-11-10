<?php

use yii\helpers\Url;

?>

<div class="latest-product">
    <h2 class="section-title">Последние просмотренные товары</h2>
    <div class="product-carousel">
        <? foreach ( $latestProducts as $item ) { ?>
        <div class="single-product">
            <div class="product-f-image">
                <?//= Html::img('@front/img/product-1.jpg')?>
                <img src="<?= Yii::getAlias("@front/img/catalog/{$item->getImage()->filePath}") ?>" alt="">
                <div data-id="<?= $item->id?>" class="product-hover">
                    <a href="<?= Url::to(['cart/add', 'id' => $item->id, 'quantity' => 1]) ?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> В корзину</a>
                    <a href="<?= Url::to(['catalog/product', 'prod' => $item->name_translit, 'cat' => $item->categories->cat_name_translit]) ?>" class="view-details-link"><i class="fa fa-link"></i> Подробнее</a>
                </div>
            </div>

            <h2><a href="<?= Url::to(['catalog/product', 'cat' => $item->categories->cat_name_translit, 'prod' => $item->name_translit ]) ?>"><?= $item->name ?></a></h2>

            <div class="product-carousel-price">
                <ins>&#8381;<?= $item->price ?></ins>
            </div>
        </div>
    <? } ?>
    </div>
</div>
