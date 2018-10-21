<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

?>
<div class="modal-cart-wrapper">
    <div class="main-title">
        Товар успешно добавлен в корзину
    </div>
    <div class="head-cart-modal">
        <div class="title-modal-cart">
            <?= $product->name?>
        </div>
        <div class="image-modal-cart" style="background-image: url(<?= Yii::getAlias("@web/img/catalog/$product->image") ?>);"></div>
    </div>
    <div class="content-cart-modal">
        <div class="modal-price-block">
            <div class="price-title">
                Цена товара:
            </div>
            <div class="price">
                <?= $product->price ?>&nbsp;&#8381;
            </div>
        </div>
        <div class="modal-count-block">
            <div class="count-title">
                Количество:
            </div>
            <div class="count">
                <?= $quantity ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="<?= Url::to(['cart/show-cart']) ?>"><button class="add_to_cart_button" type="button">В корзину</button></a>
    </div>
</div>
