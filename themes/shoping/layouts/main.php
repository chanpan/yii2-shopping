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
    <div>    
        <?php $this->render("header.php",['image'=>$image])?>
        <?= $this->render("menu-bar.php",['image'=>$image])?>
        
        <div class="breadcrumb-bg">
            <div class="container">
               <?php echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
        <?= $content;?>
        <?= $this->render("footer.php",['image'=>$image])?>
    </div>    
        
        
        
        
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage(); ?>