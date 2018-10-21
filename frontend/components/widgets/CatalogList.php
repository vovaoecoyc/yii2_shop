<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 27.09.2018
 * Time: 22:52
 */

namespace frontend\components\widgets;

use yii\base\Widget;

class CatalogList extends Widget
{

    public $template;
    public $products;
    public $pages;

    public function init() {
        parent::init();
        if ($this->template === null || $this->template === '' || $this->template === 'default') {
            $this->template = 'catalog-list';
        }
        elseif ($this->template === 'related') {
            $this->template = 'catalog-related';
        }
        if ($this->pages === null || $this->pages === '') {
            $this->pages = [];
        }

    }

    public function run() {
        return $this->render(
            $this->template,
            [
                'products'      => $this->products,
                'pages'         => $this->pages
            ]
        );
    }
}