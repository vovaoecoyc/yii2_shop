<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 08.09.2018
 * Time: 1:08
 */

namespace frontend\widgets\WidgetMenu;

use Yii;
use yii\helpers\Html;
use yii\base\Widget;
use app\models\MainMenu;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

class HeaderMenu extends Widget
{

    private $dbData;
    private $menuItems = [];

    private function getMenuData() {

        $this->dbData = MainMenu::find()->orderBy(['SORT' => SORT_ASC])->all();

        NavBar::begin([
            'options' => [
                'class' => 'user-menu',
            ],
        ]);
        foreach ($this->dbData as $item) {
            if (stripos($item->URL, 'catalog')) {
                $this->menuItems[] = ['label' => $item->NAME, 'url' => ['catalog/index']];
            }
            else {
                $this->menuItems[] = ['label' => $item->NAME, 'url' => ['shop' . $item->URL]];
            }
        }
        echo Nav::widget([
            'options' => ['class' => ''],
            'items'   => $this->menuItems
        ]);
        NavBar::end();
    }

    public function run() {
        $menu = $this->getMenuData();
        return $menu;
    }
}