<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 25.09.2018
 * Time: 16:35
 */

namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\web\Cookie;

class SubClass extends Component
{
    public $str;


    public function init() {
        parent::init();
    }

    /**
     * @param string $str
     * @return mixed|string
     */
    public function transliterate($str = '')
    {
        //$this->str = $str;
        if ($str != '') {
            return str_replace(Yii::$app->params['rusChars'], Yii::$app->params['enChars'], $str);
        }
        else {
            return '';
        }
    }


    /**
     * @param $product_id
     * @param int $countShowProduct - количество выводимых товаров в блоке
     */
    public function addLatestProduct( $product_id, $countShowProduct = 10 ) {
        /* обработка cookies с последними просмотренными товарами */
        $cookieRequest = Yii::$app->request->cookies;
        if ( $cookieRequest->get('latestProduct') !== null ) {
            $latestProduct = $this->cookiesValidationCheck($cookieRequest->get('latestProduct'));
            if ( count($latestProduct) >= $countShowProduct ) {
                array_shift($latestProduct);
                $latestProduct[] = $product_id;
            }
            else {
                $latestProduct[] = $product_id;
            }
            $latestProduct  = implode(',', array_values($latestProduct));
        }
        else {
            $latestProduct = (string)$product_id;
        }
        /* / */
        $cookiesResponse = Yii::$app->response->cookies;
        $cookiesResponse->add(new Cookie([
            'name'  => 'latestProduct',
            'value' => $latestProduct
        ]));
    }

    /**
     * @param $cookies
     * @return array|string
     */
    public function cookiesValidationCheck($cookies) {
        $latestProduct  = htmlspecialchars(strip_tags($cookies));
        $latestProduct  = array_unique(explode(',', $latestProduct));
        foreach ($latestProduct as $key => &$item) {
            if (!(int)$item) {
                unset($item);
            }
        }
        return $latestProduct;
    }

}