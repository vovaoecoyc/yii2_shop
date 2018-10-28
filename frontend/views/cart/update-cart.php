<?
use yii\helpers\Url;
?>
<!--<pre>--><?//print_r($cartItems)?><!--</pre>-->
<?
ob_clean();
ob_start();
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
                <input name="<?= $item['id'] ?>" type="number" size="4" class="input-text qty text" title="Qty" value="<?= $item['quantity']?>" min="0" step="1">
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
        <input data-href-update="<?= Url::to(['cart/update-cart']) ?>" type="submit" value="Обновить корзину" name="update_cart" class="button">
        <input data-href-order="<?= Url::to(['order/index']) ?>" type="submit" value="Оформить заказ" name="proceed" class="checkout-button button alt wc-forward">
    </td>
</tr>
<?
$html[] = ob_get_contents();
ob_end_clean();
ob_start();
?>

    <tr class="cart-subtotal">
        <th>Количество</th>
        <td><span class="amount"><?= $cartItems['cart.quantity'] ?></span></td>
    </tr>

    <tr class="order-total">
        <th>Сумма</th>
        <td><strong><span class="amount"><?= $cartItems['cart.summ'] ?> &#8381;</span></strong> </td>
    </tr>

<?
$html[] = ob_get_contents();
ob_end_clean();
echo json_encode($html);
die();
?>