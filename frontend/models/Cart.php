<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 01.10.2018
 * Time: 1:15
 */

namespace frontend\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{

    public function addToCart($product, $quantity = 1) {
        if (!isset($_SESSION['cart'][$product->id])) {
            //$image = $
            $_SESSION['cart'][$product->id] = [
                'id'           => $product->id,
                'name'         => $product->name,
                'image'        => $product->getImage(),
                'price'        => $product->price,
                'name_prod_tr' => $product->name_translit,
                'name_cat_tr'  => $product->categories->cat_name_translit,
                'quantity'     => $quantity
            ];
        }
        else {
            $_SESSION['cart'][$product->id]['quantity'] += $quantity;
        }
        $_SESSION['cart.quantity'] = isset($_SESSION['cart.quantity']) ? ($_SESSION['cart.quantity'] + $quantity) : $quantity;
        $_SESSION['cart.summ']     = isset($_SESSION['cart.summ']) ? ($_SESSION['cart.summ'] + ($product->price * $quantity)) : ($product->price * $quantity);
    }

    public function getCartItems() {
        $cartItems = [];
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart']) && isset($_SESSION['cart.summ']) && isset($_SESSION['cart.quantity'])) {
            $cartItems['cart']          = $_SESSION['cart'];
            $cartItems['cart.quantity'] = $_SESSION['cart.quantity'];
            $cartItems['cart.summ']     = $_SESSION['cart.summ'];
        }
        return $cartItems;
    }

    public function recalculateCart($id = '', $elements = [], $action = 'delete'){
        if (isset($_SESSION['cart']) && isset($_SESSION['cart.summ']) && isset($_SESSION['cart.quantity'])) {
            if ( $action === 'delete' ) {
                $summ = (int)$_SESSION['cart'][$id]['quantity'] * (int)$_SESSION['cart'][$id]['price'];
                $_SESSION['cart.quantity'] -= $_SESSION['cart'][$id]['quantity'];
                $_SESSION['cart.summ']     -= $summ;
                unset($_SESSION['cart'][$id]);
                if ( (int)$_SESSION['cart.quantity'] === 0 && (int)$_SESSION['cart.summ'] === 0 ) {
                    $this->clearCart();
                }
            }
            elseif ( $action === 'update' ) {
                $allSumm     = 0;
                $allQuantity = 0;
                $flag        = true; //флаг остановки рекалькуляции корзины ( отправлены не все данные о товарах имеющихся в корзине )
                foreach ($elements as $key => $elem) {
                    if ( isset($_SESSION['cart'][(int)$key]) ) {
                        $_SESSION['cart'][(int)$key]['quantity'] = $elem;
                        $_SESSION['cart'][(int)$key]['summ']     = $elem * $_SESSION['cart'][(int)$key]['price'];
                        $allQuantity                            += $_SESSION['cart'][(int)$key]['quantity'];
                        $allSumm                                += $_SESSION['cart'][(int)$key]['summ'];
                    }
                    else {
                        $flag = false;
                        break;
                    }
                }
                if ($flag) {
                    $_SESSION['cart.quantity'] = $allQuantity;
                    $_SESSION['cart.summ']     = $allSumm;
                }
            }
        }
    }

    public function clearCart() {
        if (isset($_SESSION['cart']) && isset($_SESSION['cart.summ']) && isset($_SESSION['cart.quantity'])) {
            unset($_SESSION['cart'], $_SESSION['cart.summ'], $_SESSION['cart.quantity']);
        }
    }

}