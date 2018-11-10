<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_translit')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'description')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);*/?>

    <?= $form->field($model, 'description')->widget(CKEditor::class, [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
    ]);?>

    <?= $form->field($model, 'price')->textInput() ?>

    <? //TODO добавить в БД таблицу с валютами ?>
    <?= $form->field($model, 'currency')->dropDownList(['rub' => 'Rouble', 'usd' => 'USD']) ?>
    <? /*TODO start Фильруем категории. Берем только листья в дереве категорий. Вынести логику в отдельны  метод модели */ ?>
    <?
        $keys = array_diff(array_keys(ArrayHelper::map($categories, 'parent_section', '')), ['']);
    ?>
    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(array_filter($categories, function($item, $id) use($keys) {
            if ( $item['parent_section'] === null || in_array((int)$id, $keys) ) {
                return false;
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH), 'id', 'name')
    ) ?>
    <? /* TODO end */ ?>
    <?= $form->field($model, 'imageLoad')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
