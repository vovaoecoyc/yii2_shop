<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Оформление заказа</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Найти товар</h2>
                    <form action="">
                        <input type="text" placeholder="Search products...">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Products</h2>
                    <div class="thubmnail-recent">
                        <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                        <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                        <div class="product-sidebar-price">
                            <ins>$700.00</ins> <del>$800.00</del>
                        </div>
                    </div>
                    <div class="thubmnail-recent">
                        <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                        <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                        <div class="product-sidebar-price">
                            <ins>$700.00</ins> <del>$800.00</del>
                        </div>
                    </div>
                    <div class="thubmnail-recent">
                        <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                        <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                        <div class="product-sidebar-price">
                            <ins>$700.00</ins> <del>$800.00</del>
                        </div>
                    </div>
                    <div class="thubmnail-recent">
                        <img src="img/product-thumb-1.jpg" class="recent-thumb" alt="">
                        <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                        <div class="product-sidebar-price">
                            <ins>$700.00</ins> <del>$800.00</del>
                        </div>
                    </div>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Recent Posts</h2>
                    <ul>
                        <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
                        <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
                        <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
                        <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
                        <li><a href="single-product.html">Sony Smart TV - 2015</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">

                <div class="product-content-right">
                    <div class="woocommerce">
                        <form id="login-form-wrap" class="login collapse" method="post">


                            <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>

                            <p class="form-row form-row-first">
                                <label for="username">Username or email <span class="required">*</span>
                                </label>
                                <input type="text" id="username" name="username" class="input-text">
                            </p>
                            <p class="form-row form-row-last">
                                <label for="password">Password <span class="required">*</span>
                                </label>
                                <input type="password" id="password" name="password" class="input-text">
                            </p>
                            <div class="clear"></div>


                            <p class="form-row">
                                <input type="submit" value="Login" name="login" class="button">
                                <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember me </label>
                            </p>
                            <p class="lost_password">
                                <a href="#">Lost your password?</a>
                            </p>

                            <div class="clear"></div>
                        </form>

                        <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                            <p class="form-row form-row-first">
                                <input type="text" value="" id="coupon_code" placeholder="Coupon code" class="input-text" name="coupon_code">
                            </p>

                            <p class="form-row form-row-last">
                                <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                            </p>

                            <div class="clear"></div>
                        </form>


                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <? if ( !empty($orderItems) ) { ?>
                                    <div class="woocommerce-billing-fields">
                                        <h3>Данные о заказе</h3>
                                        <? $form = ActiveForm::begin() ?>
                                            <?= $form->field($order, 'name') ?>
                                            <?= $form->field($order, 'email') ?>
                                            <?= $form->field($order, 'phone') ?>
                                            <?= $form->field($order, 'address')->textArea(['rows' => 4, 'cols' => 4]) ?>
                                        <h3 id="order_review_heading">Ваш заказ</h3>
                                            <table class="shop_table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Товар</th>
                                                        <th class="product-total">Цена</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <? foreach ( $orderItems['cart'] as $item ) { ?>
                                                    <tr class="cart_item">
                                                        <td class="product-name">
                                                            <?= $item['name'] ?> <strong class="product-quantity">× <?= $item['quantity']?></strong> </td>
                                                        <td class="product-total">
                                                            <span class="amount">&#8381; <?= number_format($item['price'], 2, ',', ' ') ?></span> </td>
                                                    </tr>
                                                <? } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="order-total">
                                                        <th>Итого × <?= $orderItems['cart.quantity'] ?></th>
                                                        <td><strong><span class="amount">&#8381; <?= number_format($orderItems['cart.summ'], 2, ',', ' ') ?></span></strong> </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <?= $form->field($delivery, 'id')->radioList(
                                                    ArrayHelper::map($delivery::find()->all(), 'id', 'name'),
                                                    [
                                                        'class' => 'radio-button',
                                                    ]
                                            )->label('<h3>Выберите способ доставки:</h3>')->hint(' ') ?>
                                            <?= $form->field($paysystem, 'id')->radioList(
                                                    ArrayHelper::map($paysystem::find()->all(), 'id', 'name'),
                                                    [
                                                        'class' => 'radio-button',
                                                    ]
                                            )->label('<h3>Выберите платежную систему:</h3>')->hint(' ') ?>
                                            <?= Html::submitButton('Оформить заказ', ['class' => 'order-button']) ?>
                                        <? ActiveForm::end() ?>
                                    </div>
                                    <? } else { ?>
                                        <h2 class="sidebar-title">Ваша корзина пуста</h2>
                                        <a id="catalog-href" data-order-success="<?= $orderSuccess ?>" data-load-modal="<?= Url::to(['order/order-success']) ?>" href="<?= Url::to(['catalog/index']) ?>">Перейи в каталог товаров</a>
                                    <? } ?>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
