<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ShopProducts;
use frontend\models\Cart;

class CartController extends \yii\web\Controller
{
    public function actionAdd()
    {
        if (Yii::$app->request->isAjax) {
            $id       = Yii::$app->request->get('id');
            $quantity = Yii::$app->request->get('quantity');
            //$product = ShopProducts::findOne($id);
            $product = ShopProducts::find()
                            ->where(['id' => $id])
                            ->with('categories')
                            ->limit(1)
                            ->one();
            if (empty($product)) return false;
            $session = Yii::$app->session;
            $session->open();
            $cart = new Cart();
            //unset($_SESSION['cart'], $_SESSION['cart.quantity'], $_SESSION['cart.summ']);
            $cart->addToCart($product, $quantity);
            return $this->renderPartial('add', compact('product', 'quantity'));
        }
        //throw new \yii\web\BadRequestHttpException('Bad request!');
    }

    public function actionShowCart() {
        $cartItems = [];
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
//        unset($_SESSION['cart'], $_SESSION['cart.quantity'], $_SESSION['cart.summ']);
        if ( Yii::$app->request->isAjax && Yii::$app->request->post('del') && Yii::$app->request->post('id') !== null) {
            $cartItems = [];
            $id = Yii::$app->request->post('id');
            $isAjax = true;
            $cart->recalculateCart($id);
            $cartItems = $cart->getCartItems();
            return $this->renderPartial('show-cart', compact('isAjax', 'cartItems'));
        }
        else {
            //unset($_SESSION['cart'], $_SESSION['cart.quantity'], $_SESSION['cart.summ']);
            $cartItems = $cart->getCartItems();
            return $this->render('show-cart', compact('cartItems'));
        }

    }

    public function actionRefreshHeadCart() {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('refresh-head-cart');
        }
    }

    public function actionUpdateCart() {
        if ( Yii::$app->request->isAjax ) {
            $session = Yii::$app->session;
            $session->open();
            $cart = new Cart();
            $post = Yii::$app->request->post();
            $cart->recalculateCart('', $post, 'update');
            $cartItems = $cart->getCartItems();
            return $this->renderPartial('update-cart', compact('cartItems'));
        }
    }

}
