<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 11.09.2018
 * Time: 0:08
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container-form">
    <? if ($success) { ?>
        <p style="color: red;">Ваше сообщение отправлено!</p>
    <? } else { ?>
        <?$form = ActiveForm::begin();?>
            <?= $form->field($model, 'name');?>
            <?= $form->field($model, 'email')->input('email');?>
            <?= $form->field($model, 'phone');?>
            <?= $form->field($model, 'text')->textArea(['rows' => 4, 'cols' => 10]);?>
            <?= Html::submitButton('Отправить сообщение');?>
        <? ActiveForm::end();?>
        <? if ($error) { ?>
            <p style="color: red;">Произошла ошибка при добавлении!</p>
        <? } ?>
    <? } ?>
</div>