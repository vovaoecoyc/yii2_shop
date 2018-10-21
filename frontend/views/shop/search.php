<?php

use frontend\components\widgets\CatalogList;

?>
<div class="search-result">
    <div class="search-head">
        <h4>Результаты поиска для <q><?= $search_request?></q> :</h4>
    </div>
    <? if (!empty($search_products)) { ?>
        <div class="catalog-wrapper">
            <div class="catalog-head">
                <?//=CatalogMenuWidget::widget()?>
            </div>
            <div class="catalog-content">
                <?= CatalogList::widget([
                    'products' => $search_products,
                    'pages'    => $pages
                ])?>
            </div>
        </div>
    <? } else { ?>
        <div class="empty-result-search">
            По Вашему запросу ничего не найдено.
        </div>
    <? } ?>
</div>