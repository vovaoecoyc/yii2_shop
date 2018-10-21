<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;


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
    <?= Html::csrfMetaTags() ?>
    <title><?=Html::encode($this->title)?></title>
    <?$this->head()?>
</head>
<body>
<?$this->beginBody()?>

<?$this->endBody()?>
</body>
</html>
<?
$this->endPage();
?>
