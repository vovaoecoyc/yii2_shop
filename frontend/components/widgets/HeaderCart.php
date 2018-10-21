<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 14.10.2018
 * Time: 18:38
 */

namespace frontend\components\widgets;

use Yii;
use yii\base\Widget;

class HeaderCart extends Widget
{
    public function init() {
        parent::init();
    }

    public function run() {
        $session = Yii::$app->session;
        $session->open();
        $quantity = $session->get('cart.quantity') ? $session->get('cart.quantity') : '0';
        $summ     = $session->get('cart.summ') ? $session->get('cart.summ') : '0';
        return $this->render('head-cart', compact('quantity', 'summ'));
    }
}