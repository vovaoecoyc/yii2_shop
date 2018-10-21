<?php

use yii\helpers\Url;

?>

<? foreach ($products as $prod) { ?>
<div class="single-product swiper-slide">
    <div class="product-f-image">
        <div class="related-item-image slider-image" style="background-image: url('<?= Yii::getAlias("@web/img/catalog/$prod->image")?>');">
        </div>
        <div data-id="<?= $prod->id?>" class="product-hover">
            <a href="<?= Url::to(['cart/add', 'id' => $prod->id, 'quantity' => 1]) ?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Добавить в корзину</a>
            <a href="<?= Url::to(['catalog/product', 'prod' => $prod->name_translit, 'cat' => $prod->categories->cat_name_translit]) ?>" class="view-details-link"><i class="fa fa-link"></i> Быстрый просмотр</a>
        </div>
    </div>

    <h2><a href=""><?= $prod->name ?></a></h2>

    <div class="product-carousel-price">
        <ins><?= $prod->price?>&nbsp;&#8381;</ins>
<!--            <del>$800.00</del>-->
    </div>
</div>
<? } ?>
