<?

use yii\helpers\Url;

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 wrap text-center">
            <div class="page-header">
                <h2 class="sidebar-title">
                    Ваш заказ успешно оформлен!
                </h2>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <a href="<?= Url::to(['catalog/index']) ?>" class="add_to_cart_button">ОК</a>
        </div>
    </div>

</div>
