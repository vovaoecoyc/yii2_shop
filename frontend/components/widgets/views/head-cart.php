<?php
use yii\helpers\Url;
?>
<div class="shopping-item" data-refresh-url="<?= Url::to(['cart/refresh-head-cart']) ?>">
    <a href="<?= Url::to(['cart/show-cart']) ?>">Корзина - <span class="cart-amunt">&#8381;<?= $summ?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?= $quantity?></span></a>
</div>