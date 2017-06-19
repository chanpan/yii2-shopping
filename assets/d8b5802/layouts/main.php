<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\ShopingAsset;

$image = \Yii::getAlias('@storageUrl') . "/web/image/";
$images = \Yii::getAlias('@storageUrl') . "/web/images/";
ShopingAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
    </head>

    <body>
<?php $this->beginBody() ?>
    <?= $this->render("menu-top.php",['image'=>$image])?>
    <?= $this->render("header.php",['image'=>$image])?>
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage(); ?>