<?php

use frontend\components\widgets\CatalogList;
use yii\helpers\Url;

?>
<div class="search-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Найти товар</h2>
                    <form id="search" action="<?= Url::to(['shop/search']) ?>" method="GET">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" placeholder="Найти..." name="q">
                            </div>
                            <div class="col-md-3">
                                <input type="submit" value="Поиск">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="catalog-wrapper">
            <div class="catalog-content">
                <div class="container">
                    <div class="search-head">
                        <h4>Результаты поиска для <q><?= $search_request?></q> :</h4>
                    </div>
                </div>
                <? if (!empty($search_products)) { ?>

                    <div class="single-product-area">
                        <div class="zigzag-bottom"></div>
                        <div class="container">
                            <?= CatalogList::widget([
                                'products' => $search_products,
                                'pages'    => $pages
                            ]);?>
                        </div>
                    </div>
                <? } else { ?>
                    <div class="empty-result-search">
                        По Вашему запросу ничего не найдено.
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
</div>


