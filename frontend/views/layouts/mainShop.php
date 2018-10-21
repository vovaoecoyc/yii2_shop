<?php
use yii\helpers\Html;
use frontend\assets\ShopAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use common\widgets\Alert;
use frontend\widgets\WidgetMenu\HeaderMenu;
use frontend\components\widgets\HeaderCart;

ShopAsset::register($this);
?>
<?php
$this->beginPage();
?>
    <!doctype html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
            <?= Html::csrfMetaTags() ?>
            <title><?=Html::encode($this->title)?></title>
            <?$this->head()?>
        </head>
        <body>
        <?$this->beginBody()?>
        <div class="header-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">

                        <?
                        NavBar::begin([
                            'options' => [
                                'class' => 'user-menu'
                            ]
                        ]);
                        $menuItems = [
                            '<i class="fa fa-user"></i>',
                            ['label' => 'Мой аккаунт',  'url' => ['']],
                            '<i class="fa fa-heart"></i>',
                            ['label' => 'Предпочтения', 'url' => ['']],
                            '<i class="fa fa-user"></i>',
                            ['label' => 'Корзина',      'url' => [Yii::$app->urlManager->createUrl(['frontend/web/cart'])]],
                        ];
                        if(Yii::$app->user->isGuest){
                            $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => [Yii::$app->urlManagerBackend->createUrl([''])]];
                            $menuItems[] = ['label' => 'Войти', 'url' => [Yii::$app->urlManagerBackend->createUrl([''])]];
                        }
                        else{
                            $menuItems[] = '<li>'
                                . Html::beginForm([])
                                . Html::submitButton([
                                    'Logout(' .  Yii::$app->user->identity->username . ')',
                                    ['class' => '']
                                ])
                                . Html::endForm()
                                . '</li>';
                        }
                        echo Nav::widget([
                            'options' => ['class' => ''],
                            'items' => $menuItems
                        ]);

                        NavBar::end();
                        ?>
                    </div>
                </div>
            </div>
        </div> <!-- End header area -->

        <div class="site-branding-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo">
                            <h1><a href="<?= Url::to(['shop/index']) ?>">e<span>Auto</span></a></h1>
                        </div>
                    </div>

                    <div id="cart-header" class="col-sm-6">
                        <?= HeaderCart::widget();?>
                    </div>
                </div>
            </div>
        </div> <!-- End site branding area -->

        <div class="mainmenu-area">
            <div class="container">
                <div class="row">
                    <?HeaderMenu::begin()?>
                    <?HeaderMenu::end()?>
                    <?//=HeaderMenu::widget()?>
                </div>
            </div>
        </div> <!-- End mainmenu area -->
        <?=$content?>
        <div class="footer-top-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-about-us">
                            <h2>e<span>Electronics</span></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                            <div class="footer-social">
                                <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-menu">
                            <h2 class="footer-wid-title">User Navigation </h2>
                            <ul>
                                <li><a href="#">My account</a></li>
                                <li><a href="#">Order history</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Vendor contact</a></li>
                                <li><a href="#">Front page</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-menu">
                            <h2 class="footer-wid-title">Categories</h2>
                            <ul>
                                <li><a href="#">Mobile Phone</a></li>
                                <li><a href="#">Home accesseries</a></li>
                                <li><a href="#">LED TV</a></li>
                                <li><a href="#">Computer</a></li>
                                <li><a href="#">Gadets</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="footer-newsletter">
                            <h2 class="footer-wid-title">Newsletter</h2>
                            <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                            <div class="newsletter-form">
                                <form action="#">
                                    <input type="email" placeholder="Type your email">
                                    <input type="submit" value="Subscribe">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End footer top area -->

        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright">
                            <p>&copy; 2015 eElectronics. All Rights Reserved. Coded with <i class="fa fa-heart"></i> by <a href="http://wpexpand.com" target="_blank">WP Expand</a></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="footer-card-icon">
                            <i class="fa fa-cc-discover"></i>
                            <i class="fa fa-cc-mastercard"></i>
                            <i class="fa fa-cc-paypal"></i>
                            <i class="fa fa-cc-visa"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End footer bottom area -->
        <!--   modal windows start    -->
<!--        <div id="modalCart"></div>-->
        <!--   modal windows end      -->
        <?$this->endBody()?>
        </body>
    </html>
<?
$this->endPage();
?>
