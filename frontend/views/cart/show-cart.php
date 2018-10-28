<?
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Корзина";
?>

<?//=dirname(__FILE__)?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Корзина</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Найти товар</h2>
                    <form action="<?= Url::to(['shop/search']) ?>" method="GET">
                        <input name="q" type="text" placeholder="Найти...">
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
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <? if (!empty($cartItems)) { ?>
                        <form id="cart-form" method="post" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Название</th>
                                    <th class="product-price">Цена</th>
                                    <th class="product-quantity">Количество</th>
                                    <th class="product-subtotal">Скидка</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                if ( isset($isAjax) && $isAjax && !empty($cartItems)) {
                                    ob_clean();
                                    ob_start();
                                }
                                ?>
                                <? foreach ($cartItems['cart'] as $item) { ?>
                                    <tr id="<?= $item['id'] ?>" class="cart_item">
                                        <td class="product-remove">
                                            <a data-id="<?= $item['id'] ?>" title="Remove this item" class="remove" href="javascript:void(0)">×</a>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="<?= Url::to(['catalog/product', 'prod' => $item['name_prod_tr'], 'cat' => $item['name_cat_tr']]) ?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?= Yii::getAlias("@front/img/catalog/".$item['image'])?>"></a>
                                        </td>

                                        <td class="product-name">
                                            <a href="<?= Url::to(['catalog/product', 'prod' => $item['name_prod_tr'], 'cat' => $item['name_cat_tr']]) ?>"><?= $item['name'] ?></a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">&#8381; <?= $item['price'] ?></span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <input type="button" class="minus" value="-">
                                                <input name="<?= $item['id'] ?>" type="number" size="4" class="input-text qty text" title="Qty" value="<?= $item['quantity']?>" min="1" step="1">
                                                <input type="button" class="plus" value="+">
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">Нет</span>
                                        </td>

                                    </tr>
                                <? } ?>

                                <tr>
                                    <td class="actions" colspan="6">
<!--                                        <div class="coupon">-->
<!--                                            <label for="coupon_code">Coupon:</label>-->
<!--                                            <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">-->
<!--                                            <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">-->
<!--                                        </div>-->
                                        <input data-href-update="<?= Url::to(['cart/update-cart']) ?>" type="submit" value="Обновить корзину" name="update_cart" class="button">
                                        <input data-href-order="<?= Url::to(['order/index']) ?>" type="submit" value="Оформить заказ" name="proceed" class="checkout-button button alt wc-forward">
                                    </td>
                                </tr>
                                <?
                                if ( isset($isAjax) && $isAjax && !empty($cartItems) ) {
                                    $html[] = ob_get_contents();
                                    ob_end_clean();
                                    //echo $html;
                                    //die();
                                }
                                ?>
                                </tbody>
                            </table>
                        </form>
                        <? } else { ?>
                            <h2 class="sidebar-title">Ваша корзина пуста</h2>
                        <? } ?>

                        <div class="cart-collaterals">
                            <div class="cart_totals <? if (empty($cartItems)) { ?> hide <? } ?> ">
                                <h2>Итого</h2>

                                <table cellspacing="0">
                                    <?
                                    if ( isset($isAjax) && $isAjax && !empty($cartItems)) {
                                        ob_clean();
                                        ob_start();
                                    }
                                    ?>
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Количество</th>
                                        <td><span class="amount"><?= $cartItems['cart.quantity'] ?></span></td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Сумма</th>
                                        <td><strong><span class="amount"><?= $cartItems['cart.summ'] ?> &#8381;</span></strong> </td>
                                    </tr>
                                    </tbody>
                                    <?
                                    if ( isset($isAjax) && $isAjax && !empty($cartItems) ) {
                                        $html[] = ob_get_contents();
                                        ob_end_clean();
                                        echo json_encode($html);
                                        die();
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
