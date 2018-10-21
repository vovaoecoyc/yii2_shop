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
        if (str != '') {
            return str_replace(Yii::$app->params['rusChars'], Yii::$app->params['enChars'], $str);
        }
        else {
            return '';
        }
    }
}