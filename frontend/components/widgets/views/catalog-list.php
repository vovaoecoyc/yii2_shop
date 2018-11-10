<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<?
    /* перенос на следующую строку */
    $i = 0;
?>
<?foreach ($products as $prod) { ?>
    <? if ($i % 3 === 0) { ?>
        <div class="row">
    <? } ?>
        <div class="col-md-4 col-sm-6">
            <div class="single-shop-product">
                <div class="product-upper" style="background-image: url(<?= Yii::getAlias('@front/img/catalog/') . $prod->getImage()->filePath ?>);">
                    <a class="src-image" href="<?= Url::to([
                        'catalog/product',
                        'prod' => $prod['name_translit'],
                        'cat'  => $prod['categories']['cat_name_translit']
                    ]) ?>"></a>
    <!--                <img src="img/product-2.jpg" alt="">-->
                </div>
                <h2>
                    <a href="<?= Url::to([
                        'catalog/product',
                        'prod' => $prod['name_translit'],
                        'cat'  => $prod['categories']['cat_name_translit']
                    ]) ?>"><?= $prod['name']?></a>
                </h2>

                <div class="product-carousel-price">
                    <ins>&nbsp;&#8381;<?= number_format($prod['price'], 2, ',', ' ')?></ins>
    <!--                <del>$999.00</del>-->
                </div>

                <div class="product-option-shop">
                    <a class="add_to_cart_button" data-quantity="1" data-id="<?= $prod['id'] ?>" rel="nofollow" href="<?= Url::to(['cart/add']) ?>">В корзину</a>
                </div>
            </div>
        </div>
    <? $i++; ?>
    <? if ( ($i % 3 === 0) || (count($products) === $i) ) { ?>
        </div>
    <? } ?>
<? } ?>
<? if ((int)count($products) > 0) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="product-pagination text-center">
                <?echo LinkPager::widget([
                    'pagination' => $pages,
                ]);?>
            </div>
        </div>
    </div>
<? } ?>