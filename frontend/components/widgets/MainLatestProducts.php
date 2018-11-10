<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 06.11.2018
 * Time: 3:38
 */

namespace frontend\components\widgets;

use Yii;
use yii\base\Widget;
use frontend\models\ShopProducts;

class MainLatestProducts extends Widget
{

    public $latest_product;

    public function init(){
        parent::init();
    }

    public function run() {
        $latestProducts = ShopProducts::findAll($this->latest_product);
        return $this->render('latest-product', compact('latestProducts') );
    }

}