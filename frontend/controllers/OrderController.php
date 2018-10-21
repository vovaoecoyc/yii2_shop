<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Orders;
use frontend\models\OrderList;
use frontend\models\Cart;
use frontend\models\ShopDelivery;
use frontend\models\ShopPaysystem;

class OrderController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $cart       = new Cart();
        $order      = new Orders();
        $paysystem  = new ShopPaysystem();
        $delivery   = new ShopDelivery();
        if ($order->load(Yii::$app->request->post()) && $order->validate() &&
            $paysystem->load(Yii::$app->request->post()) && $delivery->load(Yii::$app->request->post())
        )
        {
            $orderList = new OrderList();
            $session = Yii::$app->session;
            $session->open();
            $cartItems = $cart->getCartItems();
            if ( empty($cartItems) ) return $this->redirect(['catalog/index']);
            $order->delivery_id  = Yii::$app->request->post('ShopDelivery')['id'];
            $order->paysystem_id = Yii::$app->request->post('ShopPaysystem')['id'];
            $order->quantity     = $cartItems['cart.quantity'];
            $order->summ         = $cartItems['cart.summ'];
            $order->save();
            $orderList->saveOrderList($cartItems['cart'], $order->id);
            $cart->clearCart();
            return $this->render('index', ['orderItems' => $cart->getCartItems(), 'orderSuccess' => true]);
        }
        else {
            $orderItems = $cart->getCartItems();
            if ( !empty($orderItems) ) {
                $delivery->id = '1';//checked 1 radio-item
                $paysystem->id = '1';//checked 1 radio-item
                return $this->render('index', compact('orderItems', 'order', 'paysystem', 'delivery'));
            }
            else {
                return $this->redirect(['catalog/index']);
            }


        }
    }

    public function actionOrderSuccess() {
        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('order-success');
        }
    }

}
