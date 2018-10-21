<?php

use yii\helpers\Url;
use frontend\components\widgets\CatalogMenuWidget;
use frontend\components\widgets\CatalogList;
use yii\widgets\Breadcrumbs;

$this->title = $product->name;
$this->params['breadcrumbs'][] = [
    'label' => $product->categories->name,
    'url'   => Url::to(['catalog/index', 'section' => $product->categories->cat_name_translit])
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
//    'url'   => ['catalog/index']
];
?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Найти товар</h2>
                    <form id="search" action="<?= Url::to(['shop/search']) ?>" method="GET">
                        <input type="text" placeholder="Найти..." name="q">
                        <input type="submit" value="Поиск">
                    </form>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Катеории продуктов</h2>
                    <?= CatalogMenuWidget::widget() ?>
                </div>

                <div class="single-sidebar">
                    <h2 class="sidebar-title">Recent Posts</h2>
                    <ul>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                        <li><a href="">Sony Smart TV - 2015</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <?= Breadcrumbs::widget([
                            'homeLink' => [
                                'label' => 'Главная',
                                'url'   => Yii::$app->homeUrl
                            ],
                            'links'   => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                        ]); ?>
                    </div>
                    <? if ( isset($quickView) && $quickView === 'Y' ) {
                        ob_clean();
                        ob_start();
                    } ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img" style="background-image: url(<?= Yii::getAlias("@web/img/catalog/$product->image")?>);">
                                </div>

                                <div class="product-gallery">
                                    <img src="img/product-thumb-1.jpg" alt="">
                                    <img src="img/product-thumb-2.jpg" alt="">
                                    <img src="img/product-thumb-3.jpg" alt="">
                                    <img src="img/product-thumb-4.jpg" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?= $product->name ?></h2>
                                <div class="product-inner-price">
                                    <ins><?= $product->price ?>&nbsp;&#8381;</ins> <del></del>
                                </div>

                                <form name="ADD_TO_CART" action="<?= Url::to(['cart/add']) ?>" class="cart" method="GET">
                                    <input type="hidden" name="id" value="<?= $product->id?>">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" type="submit">В корзину</button>
                                </form>

                                <div class="product-inner-category">
                                    <p>Категория: <a href="<?= Url::to([
                                            'catalog/index',
                                            'section' => $product->categories->cat_name_translit
                                        ]) ?>"><?= $product->categories->name?></a>. Теги: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Описание</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Отзывы</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Описание <?= $product->name ?></h2>
                                             <p>
                                                 <?= $product->description ?>
                                             </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?
                    if ( isset($quickView) && $quickView === 'Y' ) {
                        $html = ob_get_contents();
                        ob_end_clean();
                        echo $html;
                        die();
                    }
                    ?>
                </div>
            </div>

            <div class="related-products-wrapper">
                <div class="related-head-section">
                    <h2 class="related-products-title">Рекомендуемые товары</h2>
                    <div class="related-navigation">
                        <div class="related-item-next"></div>
                        <div class="related-item-prev"></div>
                    </div>
                </div>
                <div class="related-catalog-slider swiper-container">
                    <div class="swiper-wrapper">
                        <?= CatalogList::widget([
                            'template' => 'related',
                            'products' => $related_products
                        ])?>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
